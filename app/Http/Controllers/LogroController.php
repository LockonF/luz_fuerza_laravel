<?php

namespace App\Http\Controllers;

use App\Models\Logro;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Exceptions;
use JWTAuth;

class LogroController extends Controller
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

        $logro = new Logro($request->all());
        return $user->Logro()->save($logro);

    }

    /**
     * Muestra el logro de un usuario dado por el parámetro $id
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

        $logro = Logro::where('idEmpleado',$id)->get();

        if(!$logro->isEmpty())
        {
            return response()->json([
                'logro'=>$logro->toArray()
            ],200);
        }
        return response()->json(['user_not_found'], 404);




    }



    /**
     * Display the specified resource.
     *
     * Muestra los logros
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

        $logros = Logro::where('idEmpleado',$user->id)->get();

        return response()->json([
            'logro'=>$logros->toArray()
        ],200);
        //
    }


    /**
     * Update the specified resource in storage.
     *Actualiza el logro de un usuario dado por el parámetro $id
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


        $success = Logro::where('idEmpleado',$user->id)->where('id',$id)->update($request->all());
        if($success)
        {
            return response()->json(['success'],200);
        }
        else{
            return response()->json(['logro_not_found'], 404);

        }


    }

    /**
     * Remove the specified resource from storage.
     * Elimina el logro de un usuario dado por el parámetro $id
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


        $logro = Logro::where('idEmpleado',$user->id)->where('id',$id)->first();

        if(!is_null($logro))
        {
            $logro->delete();
            return response()->json('success',200);
        }
        else return response()->json('logro_not_found',404);


    }
}
