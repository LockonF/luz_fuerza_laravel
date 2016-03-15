<?php

namespace App\Http\Controllers;



use App\Models\Cuestionario;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use JWTAuth;
use Psy\Exception\FatalErrorException;
use Tymon\JWTAuth\Exceptions;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\DatosPersonales;

class CuestionarioController extends Controller
{
    public function reset()
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

        try{
            DB::transaction(function ()use($user){
                Cuestionario::where('idUsuario',$user->id)->delete();
                $user->encuesta = 0;
                $user->save();
            });
        }catch (QueryException $e)
        {
            return response()->json('error',500);
        }


    }


    public function show()
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

        return response()->json(["nivel"=>$user->encuesta],200);
    }

    /**
     *
     * Función para grabar el cuestionario
     */

    public function store(Request $request)
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

        $preguntas = [];
        foreach($request->preguntas as $pregunta)
        {
            $preguntas[] = new Cuestionario($pregunta);
        }

        try{
            $commitData ['preguntas']=$preguntas;
            $commitData ['user']=$user;
            $commitData ['encuesta']=$request->encuesta;
            DB::transaction(function ()use($commitData){
                $commitData['result']= $commitData['user']->Cuestionario()->saveMany($commitData['preguntas']);
                $commitData['user']->encuesta = $commitData['encuesta'];
                $commitData['user']->save();
            });
            return response()->json($commitData['preguntas'],200);



        }catch (QueryException $e)
        {
            $response="fail";
            return response()->json('insert_error',500);
        }


    }




}
