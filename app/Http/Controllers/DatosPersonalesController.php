<?php

namespace App\Http\Controllers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use JWTAuth;
use Psy\Exception\FatalErrorException;
use Tymon\JWTAuth\Exceptions;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\DatosPersonales;

class DatosPersonalesController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try {

            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }

        }

        catch (Exceptions\TokenExpiredException $e) {

            return response()->json(['token_expired'], $e->getStatusCode());

        } catch (Exceptions\TokenInvalidException $e) {

            return response()->json(['token_invalid'], $e->getStatusCode());

        } catch (Exceptions\JWTException $e) {

            return response()->json(['token_absent'], $e->getStatusCode());

        }


        $datosPersonales = DatosPersonales::where('idUsuario',$user->id)->first();
        if($datosPersonales==null)
        {
            $datosPersonales = new DatosPersonales($request->all());
            return $user->DatosPersonales()->save($datosPersonales);
        }
        return response()->json('Solo se permite un registro',500);



    }

    /**
     * Display the specified resource
     *
     */

    public function showMyData()
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

            $datosPersonales = DatosPersonales::where('idUsuario',$user->id)->first();
            if(!is_null($datosPersonales))
            {
                return response()->json([
                    'datosPersonales'=> $datosPersonales->toArray()
                ],200);

            }
            else
            {
                return response()->json([
                    'datos_personales_not_found'
                ],404);

            }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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

        if($user->tipo=='Admin')
        {

            $datosPersonales = DatosPersonales::where('idUsuario',$id)->first();
            if(!is_null($datosPersonales))
            {
                return response()->json([
                    'datosPersonales'=> $datosPersonales->toArray()
                ],200);

            }
            else
            {
                return response()->json([
                    'datos_personales_not_found'
                ],404);

            }
        }
        else
        {
            return response()->json([
                'Forbidden, only Admin'
            ],403);

        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
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



        DatosPersonales::where('idUsuario',$user->id)->update($request->all());

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
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
            $datosPersonales = $user->load('DatosPersonales');
            $datosPersonales->DatosPersonales->delete();
            return response()->json('success',200);

        }catch (FatalErrorException $e)
        {
            return response()->json('Internal Server Error',500);
        }
    }
}
