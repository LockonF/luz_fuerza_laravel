<?php

namespace App\Http\Controllers;

use App\Models\ExperienciaLaboral;
use Illuminate\Http\Request;
use App\Http\Requests;
use JWTAuth;
use App\User;
use Tymon\JWTAuth\Exceptions;

use App\Http\Controllers\Controller;

class ExperienciaLaboralController extends Controller
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

        } catch (Exceptions\TokenExpiredException $e) {

            return response()->json(['token_expired'], $e->getStatusCode());

        } catch (Exceptions\TokenInvalidException $e) {

            return response()->json(['token_invalid'], $e->getStatusCode());

        } catch (Exceptions\JWTException $e) {

            return response()->json(['token_absent'], $e->getStatusCode());

        }

        $experienciaLaboral = new ExperienciaLaboral($request->all());
        return $user->ExperienciaLaboral()->save($experienciaLaboral);

    }

    /**
     * Muestra la experiencia laboral de un usuario dado por el parámetro $id
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */

    public function showOne($id)
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

        $experienciaLaboral = ExperienciaLaboral::where('idUsuario',$id)->get();

        if(!$experienciaLaboral->isEmpty())
        {
            return response()->json([
                'msg'=>'Success',
                'experienciaLaboral'=>$experienciaLaboral->toArray()
            ],200);
        }
        return response()->json(['user_not_found'], 404);




    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

        $experienciasLaborales = ExperienciaLaboral::where('idUsuario',$user->id)->get();

        return response()->json([
           'msg'=>'Success',
            'experienciaLaboral'=>$experienciasLaborales->toArray()
        ],200);
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
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


        $success = ExperienciaLaboral::where('idUsuario',$user->id)->where('id',$id)->update($request->all());
        if($success)
        {
            return response()->json(['success'],200);
        }
        else{
            return response()->json(['experiencia_laboral_not_found'], 404);

        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
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


        $experienciaLaboral = ExperienciaLaboral::where('idUsuario',$user->id)->where('id',$id)->first();

        if(!is_null($experienciaLaboral))
        {
            $experienciaLaboral->delete();
            return response()->json('success',200);
        }
        else return response()->json('experiencia_laboral_not_found',404);


    }
}
