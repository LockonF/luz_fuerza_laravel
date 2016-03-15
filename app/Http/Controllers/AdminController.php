<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use App\Models\DatosPersonales;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Exceptions;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Exceptions\UnauthorizedException;
use App\Http\Controllers\TokenAuthController;


class AdminController extends Controller
{
    public function checkRegistry($id)
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
        if($user->tipo!='Admin')
            return response()->json(['server_error'],500);
        $datos = DatosPersonales::where('idUsuario','like',$id.'%')->get();
        if($datos!=null)
            return response()->json(['Users'=>$datos],200);
        return response()->json(['user_not_found'],404);
    }

    public function getAllRegistries()
    {
        try {

            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }

        } catch (Exceptions\TokenExpiredException $e) {

            return response()->json(['token_expired'], $e->getStatusCode());

        } catch (Exceptions\TokenInvalidException $e) {

            return response()->json(['token_invalid'], $e->getStatusCode());

        } catch (Exceptions\JWTException $e) {

            return response()->json(['token_absent'], $e->getStatusCode());

        }
        if ($user->tipo != 'Admin')
            return response()->json(['server_error'], 500);
        $datos = DatosPersonales::get();
        return response()->json($datos, 200);

    }

    public function lookupByCareer($id)
    {
        try{
            TokenAuthController::checkUser('Admin');
            $results =DB::table('Usuario')
                ->join('Escolaridad','Usuario.id','=','Escolaridad.idUsuario')
                ->join('DatosPersonales','Usuario.id','=','DatosPersonales.idUsuario')
                ->join('Carrera','Carrera.id','=','Escolaridad.idCarrera')
                ->select('Usuario.id','DatosPersonales.Nombre','DatosPersonales.ApellidoP',
                    'DatosPersonales.ApellidoM','Carrera.NombreCarrera','Escolaridad.GradoDeAvance',
                    'Escolaridad.NivelDeEstudios')
                ->where('Carrera.id',$id)
                ->get();
            return response()->json(['Registros'=>$results]);


                /*
                 * SELECT Usuario.id, DatosPersonales.Nombre, DatosPersonales.ApellidoP,
                 * DatosPersonales.ApellidoM, Carrera.NombreCarrera, Escolaridad.GradoDeAvance
                 * FROM Usuario JOIN Escolaridad ON Usuario.id = Escolaridad.idUsuario
                 * JOIN DatosPersonales on DatosPersonales.idUsuario = Usuario.id
                 * JOIN Carrera on Carrera.id = Escolaridad.idCarrera
                 * WHERE Escolaridad.idCarrera=1887;
                 */

        }catch (QueryException $e)
        {
            return response()->json(['message'=>'server_error','exception'=>$e->getMessage()],500);
        }catch (Exceptions\TokenExpiredException $e) {
            return response()->json(['token_expired'], $e->getStatusCode());
        } catch (Exceptions\TokenInvalidException $e) {
            return response()->json(['token_invalid'], $e->getStatusCode());
        }catch(UnauthorizedException $e)
        {
            return response()->json(['unauthorized'], $e->getStatusCode());
        }
        catch (Exceptions\JWTException $e) {
            return response()->json(['token_absent'], $e->getStatusCode());
        }
    }

}
