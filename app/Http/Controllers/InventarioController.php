<?php

namespace App\Http\Controllers;

use App\Models\ClasificadorEspecifico;
use App\Models\Inventario;
use Illuminate\Contracts\Validation\UnauthorizedException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Requests;
use Validator;
use Tymon\JWTAuth\Exceptions;
use App\Http\Controllers\Controller;

class InventarioController extends Controller
{
    /**
     * @var array
     */
    private  $validationRules = [
        'Estado' => 'required|in:Obsoleto,Malas Condiciones,Aceptable,Bueno,Excelente',
        'Cantidad' => 'required|Integer',
        'Valor'=>'required|Numeric',
        'Marca' => 'required',
        'Modelo' => 'required',
        'FechaDeAdquisicion' => 'required|Date',
    ];


    public function show()
    {
        try {
            TokenAuthController::checkUser('Supervisor');
            $inventario = Inventario::all();
            return response()->json(['Inventario'=>$inventario]);

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
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function inventarioByClasificadorEspecifico($id)
    {
        try {
            TokenAuthController::checkUser('Supervisor');
            $clasificadorEspecifico = ClasificadorEspecifico::find($id);
            if($clasificadorEspecifico==null)
                return response()->json(['message'=>'clasificador_especifico_not_found']);
            $inventario = $clasificadorEspecifico->Inventario()->get();
            return response()->json(['Inventario'=>$inventario]);

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
    public function store(Request $request){
        try {
            TokenAuthController::checkUser('Supervisor');
            $validator = Validator::make($request->all(), $this->validationRules);
            if($validator->fails())
            {
                return response()->json($validator->errors(),422);
            }

            $inventario = new Inventario();
            $inventario->fill($request->all());
            $inventario->save();
            return response()->json($inventario);
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
    public function update(Request $request,$id){
        try {
            TokenAuthController::checkUser('Supervisor');
            $inventario = Inventario::find($id);
            if($inventario==null)
            {
                return response()->json(['message'=>'inventario_not_found'],404);

            }

            $validator = Validator::make($request->all(), $this->validationRules);
            if($validator->fails())
            {
                return response()->json($validator->errors(),422);
            }
            $inventario->fill($request->all());
            $inventario->save();
            return response()->json($inventario);
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
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id){
        try {
            TokenAuthController::checkUser('Supervisor');
            $inventario = Inventario::find($id);
            if($inventario==null)
            {
                return response()->json(['message'=>'inventario_not_found'],404);

            }
            $inventario->delete();
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
