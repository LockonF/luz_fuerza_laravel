<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\App;
use JWTAuth;
use Psy\Exception\FatalErrorException;
use Tymon\JWTAuth\Exceptions;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use App\Models\Idioma;

class IdiomaUsuarioController extends Controller
{
    /**
     * Función para mostrar todos los idiomas del usuario
     */
    public function showAll()
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

        $user->load('Idiomas');
        return response()->json([
            'idiomas'=> $user->Idiomas->toArray()
        ],200);

    }

    /**
     * Función para grabar un nuevo registro de Idioma
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

        $requestData = $request->all();
        $requestData['idUser'] =$user->id;
        $idiomas = User::whereHas('Idiomas', function ($q) use ($requestData) {
            $q->where('idIdioma',$requestData['idIdioma'])
            ->where('idEmpleado',$requestData['idUser']);
        })->get();


        if($idiomas->isEmpty())
        {
            $user->Idiomas()->save(Idioma::find($requestData['idIdioma']),$request->all());
            return response()->json(['success'],200);
        }
        else
        {
            return response()->json(['Idioma Ya Existente'],500);
        }


    }

    /**
     * Función para actualizar un registro de idioma
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

        $requestData = $request->all();
        $requestData['idUser'] =$user->id;
        $idiomas = User::whereHas('Idiomas', function ($q) use ($requestData) {
            $q->where('idIdioma',$requestData['idIdioma'])
                ->where('idEmpleado',$requestData['idUser']);
        })->get();
        if($idiomas->isEmpty())
        {
            return response()->json(['Idioma no Existente'],500);
        }
        else{
            $user->Idiomas()->updateExistingPivot($requestData['idIdioma'],$request->all());
            return response()->json(['success'],200);
        }
    }

    /**
     * Función Para Eliminar un Registro de Idioma de Usuario
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

        $requestData ['idIdioma'] = $id;
        $requestData['idUser'] =$user->id;
        $idiomas = User::whereHas('Idiomas', function ($q) use ($requestData) {
            $q->where('idIdioma',$requestData['idIdioma'])
                ->where('idEmpleado',$requestData['idUser']);
        })->get();
        if($idiomas->isEmpty())
        {
            return response()->json(['Idioma no Existente'],500);
        }
        else{
            $user->Idiomas()->detach($requestData['idIdioma']);
            return response()->json(['success'],200);
        }
    }

}
