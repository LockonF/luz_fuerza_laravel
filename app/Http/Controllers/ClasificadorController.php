<?php

namespace App\Http\Controllers;

use App\Exceptions\UnauthorizedException;
use App\Models\Clasificador;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Requests;
use Tymon\JWTAuth\Exceptions;
use App\Http\Controllers\Controller;

class ClasificadorController extends Controller
{
    public function getClasificadores()
    {
        try {
            TokenAuthController::checkUser('Supervisor');
            $clasificadores = Clasificador::all();
            return response()->json(['Clasificador' => $clasificadores]);
        } catch (UnauthorizedException $e) {
            return response()->json(['message' => 'unauthorized'], 500);
        }
    }

    /**
     * @param $idClasificador
     * @return \Illuminate\Http\JsonResponse
     * @throws \Tymon\JWTAuth\Exceptions\JWTException
     * @throws \Tymon\JWTAuth\Exceptions\TokenExpiredException
     * @throws \Tymon\JWTAuth\Exceptions\TokenInvalidException
     *
     * @var Clasificador $clasificador
     */

    public function getClasificadoresEspecificos($idClasificador)
    {
        try {
            TokenAuthController::checkUser('Supervisor');
            $clasificador = Clasificador::find($idClasificador);
            if ($clasificador == null)
                return response()->json(['message' => 'clasificador_not_found'], 404);
            return response()->json(['ClasificadorEspecifico' => $clasificador->ClasificadorEspecifico()->get()]);
        } catch (UnauthorizedException $e) {
            return response()->json(['message' => 'unauthorized'], 500);
        }
    }

    public function addClasificador(Request $request)
    {
        try {
            TokenAuthController::checkUser('Supervisor');
            $clasificador = new Clasificador($request->all());
            $clasificador->save();
            return response()->json($clasificador);

        } catch (QueryException $e) {
            return response()->json(['message' => 'server_error', 'exception' => $e->getMessage()], 500);
        } catch (Exceptions\TokenExpiredException $e) {
            return response()->json(['token_expired'], $e->getStatusCode());
        } catch (Exceptions\TokenInvalidException $e) {
            return response()->json(['token_invalid'], $e->getStatusCode());
        } catch (UnauthorizedException $e) {
            return response()->json(['unauthorized'], $e->getStatusCode());
        } catch (Exceptions\JWTException $e) {
            return response()->json(['token_absent'], $e->getStatusCode());
        }

    }


    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @var Clasificador $clasificador
     */
    public function updateClasificador(Request $request, $id)
    {
        try {
            TokenAuthController::checkUser('Supervisor');

            $clasificador = Clasificador::find($id);
            if($clasificador==null)
                return response()->json(['message'=>'clasificador_not_found'],404);

            $clasificador->fill($request->all());
            $clasificador->save();

            return response()->json($clasificador);

        } catch (QueryException $e) {
            return response()->json(['message' => 'server_error', 'exception' => $e->getMessage()], 500);
        } catch (Exceptions\TokenExpiredException $e) {
            return response()->json(['token_expired'], $e->getStatusCode());
        } catch (Exceptions\TokenInvalidException $e) {
            return response()->json(['token_invalid'], $e->getStatusCode());
        } catch (UnauthorizedException $e) {
            return response()->json(['unauthorized'], $e->getStatusCode());
        } catch (Exceptions\JWTException $e) {
            return response()->json(['token_absent'], $e->getStatusCode());
        }
    }


    public function deleteClasificador($id)
    {
        try {
            TokenAuthController::checkUser('Supervisor');

            $clasificador = Clasificador::find($id);
            $clasificador->delete();

            return response()->json(['message'=>'success']);

        } catch (QueryException $e) {
            return response()->json(['message' => 'server_error', 'exception' => $e->getMessage()], 500);
        } catch (Exceptions\TokenExpiredException $e) {
            return response()->json(['token_expired'], $e->getStatusCode());
        } catch (Exceptions\TokenInvalidException $e) {
            return response()->json(['token_invalid'], $e->getStatusCode());
        } catch (UnauthorizedException $e) {
            return response()->json(['unauthorized'], $e->getStatusCode());
        } catch (Exceptions\JWTException $e) {
            return response()->json(['token_absent'], $e->getStatusCode());
        }
    }


}
