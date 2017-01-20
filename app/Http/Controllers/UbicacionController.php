<?php

namespace App\Http\Controllers;

use App\Models\Ubicacion;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Exceptions;

class UbicacionController extends Controller
{
    public function show()
    {
        try {
            TokenAuthController::checkUser('Supervisor');
            $ubicacion = Ubicacion::all();
            return response()->json(['Ubicacion'=>$ubicacion]);

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
