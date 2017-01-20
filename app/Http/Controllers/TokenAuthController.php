<?php
/**
 * Created by PhpStorm.
 * User: lockonDaniel
 * Date: 10/4/15
 * Time: 10:08 PM
 */
namespace App\Http\Controllers;

use App\Exceptions\UnauthorizedException;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;


class TokenAuthController extends Controller
{


    /**
     * @return \Illuminate\Http\JsonResponse
     * @throws AccessDeniedHttpException
     * @throws Exceptions\JWTException
     */
    public function refreshToken()
    {
        $token = JWTAuth::getToken();
        if(!$token){
            throw new Exceptions\JWTException('Token not provided');
        }
        try{
            $token = JWTAuth::refresh($token);
        }catch(TokenInvalidException $e){
            throw new AccessDeniedHttpException('The token is invalid');
        }
        return response()->json(['token'=>$token]);
    }

    /**
     * @return null
     * @throws Exceptions\JWTException
     * @throws Exceptions\TokenExpiredException
     * @throws Exceptions\TokenInvalidException
     * @throws \Exception
     */

    public static function checkUser($permissions)
    {

        $admin = ['Admin'];
        $supervisor = ['Admin','Supervisor'];
        $userPermissions = ['Admin','Supervisor','User'];

        try {

            if (! $user = JWTAuth::parseToken()->authenticate()) {
                throw new Exceptions\JWTException;
            }
            if($permissions!=null)
            {
                switch($permissions)
                {
                    case 'User':
                        $validatePermissions= $userPermissions;
                        break;
                    case 'Supervisor':
                        $validatePermissions= $supervisor;
                        break;
                    case 'Admin':
                        $validatePermissions = $admin;
                        break;
                    default :
                        $validatePermissions = $userPermissions;
                        break;

                }
                if(!in_array($user->tipo,$validatePermissions))
                    throw new UnauthorizedException;
            }
            return $user;
        } catch (Exceptions\TokenExpiredException $e) {
            throw $e;
        } catch (Exceptions\TokenInvalidException $e) {
            throw $e;
        } catch (Exceptions\JWTException $e) {
            throw $e;
        }
    }



    public function validateUsernameHash(Request $request)
    {
        $user = User::where('id',$request->id)->where('hash',$request->hash)->first();
        if($user==null)
        {
            return response()->json(['error'=>'user_not_found'],404);
        }
        return response()->json('success',200);
    }


    public function authenticate(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if($credentials['username'] =='' or $credentials['password']=='')
        {
            return response()->json(['error' => 'invalid_credentials'], 401);
        }

        try {
            // verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        // if no errors are encountered we can return a JWT
        return response()->json(compact('token'));
    }

    public function getAuthenticatedUser()
    {
        try {

            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }

        } catch (Exceptions\TokenExpiredException $e) {

            return response()->json(['token_expired'], $e->getStatusCode());

        } catch (Exceptions\TokenInvalidException $e) {

            return response()->json(['token_invalid'], $e->getStatusCode());

        } catch (Exceptions\JWTException $e) {

            return response()->json(['token_absent'], $e->getStatusCode());

        }


        // the token is valid and we have found the user via the sub claim
        return response()->json(compact('user'));
    }

    public function changePassword(Request $request)
    {

        $user =User::where('id',$request->id)->where('hash',$request->hash)->first();
        if($user==null)
        {
            return response()->json(['error'=>'user_not_found'],404);
        }

        try{
            $success = $user->save();
            if($success)
            {
                return response()->json('success',200);
            }
            else
            {
                return response()->json(['error'=>'update_error'],500);
            }

        }catch (QueryException $e)
        {
            return response()->json(['error'=>$e->getMessage()],500);
        }
    }


    public function register(Request $request)
    {

        $user =User::where('id',$request->id)->where('hash',$request->hash)->first();

        if($user==null)
        {
            return response()->json(['error'=>'user_not_found'],404);
        }
        $user->username = $request->username;
        $user->password = Hash::make($request->input('password'));


       // try{
            $success = $user->save();
            if($success)
            {
                return response()->json('success',200);
            }
            else
            {
                return response()->json(['error'=>'update_error'],500);
            }

        /*}catch (QueryException $e)
        {
            return response()->json(['error'=>$e->getMessage()],500);
        }*/



    }
}
