<?php

namespace App\Http\Controllers;

use App\Exceptions\UnauthorizedException;
use App\Models\ClasificadorEspecifico;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Exceptions;

class ClasificadorEspecificoController extends Controller
{
    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try {
            TokenAuthController::checkUser('Supervisor');

            $clasificador = ClasificadorEspecifico::find($id);
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

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        try {
            TokenAuthController::checkUser('Supervisor');
            $clasificador = new ClasificadorEspecifico($request->all());
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
     */
    public function update(Request $request, $id)
    {
        try {
            TokenAuthController::checkUser('Supervisor');

            $clasificador = ClasificadorEspecifico::find($id);
            if($clasificador==null)
                return response()->json(['message'=>'clasificador_especifico_not_found'],404);

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



}
