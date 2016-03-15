<?php

namespace App\Http\Controllers;

use App\Models\EntidadFederativa;
use App\Models\Escolaridad;
use App\Models\ExperienciaLaboral;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions;
use App\Exceptions\UnauthorizedException;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\DatosPersonales;


use Illuminate\Database\Query;
use Illuminate\Support\Facades\DB;

class EstadisticasController extends Controller
{
    public function usersByAge(Request $request)
    {
        try{

        TokenAuthController::checkUser('Admin');
        $thisYear = intval(date('Y'));

        $ranges = $request->all();


        foreach($ranges as $range)
        {
            $users['data'][] = DatosPersonales::whereYear('FechaNacimiento','>=',$thisYear-$range['maxRange'])->whereYear('FechaNacimiento','<=',$thisYear-$range['minRange'])->count();
            if($range['maxRange']<99)
            {
                $users['labels'][] = 'De '.$range['minRange'].' a '.$range['maxRange'].' años';
            }
            else{
                $users['labels'][] = 'De '.$range['minRange'].' años en adelante';
            }

        }

        return response()->json($users,200);
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


    public function usersByAgeProjection(Request $request)
    {
        try{

        TokenAuthController::checkUser('Admin');
        $thisYear = intval(date('Y'))+$request->Offset;
        $ranges = $request->Ranges;

        foreach($ranges as $range)
        {
            $users['data'][] = DatosPersonales::whereYear('FechaNacimiento','>=',$thisYear-$range['maxRange'])->whereYear('FechaNacimiento','<',$thisYear-$range['minRange'])->count();
            if($range['maxRange']<99)
            {
                $users['labels'][] = 'De '.$range['minRange'].' a '.$range['maxRange'].' años';
            }
            else{
                $users['labels'][] = 'De '.$range['minRange'].' años en adelante';
            }

        }

        return response()->json($users,200);
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

    public function usersBySex()
    {
        try{
        TokenAuthController::checkUser('Admin');
        $hombres = DatosPersonales::where('Sexo','H')->count();
        $mujeres = DatosPersonales::where('Sexo','M')->count();
        $data['Labels'][]='Hombres';
        $data['Labels'][]='Mujeres';
        $data['Values'][]=$hombres;
        $data['Values'][]=$mujeres;
        return response()->json($data);
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



    public function usersByLocation(Request $request)
    {
        try{

        TokenAuthController::checkUser('Admin');
        $entidades = EntidadFederativa::where('idPais',1)->lists();
        $result = array();


            $tempResult =DB::table('Direccion')
                ->join('Municipio', 'Municipio.id', '=', 'Direccion.idMunicipio')
                ->join('EntidadFederativa', 'EntidadFederativa.id', '=', 'Municipio.idEstado')
                ->select(DB::raw('COUNT(Direccion.id) as Data, EntidadFederativa.Abrev as Labels'))
                ->whereIn('EntidadFederativa.id', $entidades)
                ->groupBy('Direccion')
                ->order()
                ->get();






            return response()->json($result,200);
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


    public function usersByFieldExperience(Request $request,$id)
    {
        try{

        TokenAuthController::checkUser('Admin');
        $result['users'] = DB::table('ExperienciaLaboral')
            ->join('ExperienciaEspecifica','ExperienciaLaboral.idExperienciaEspecifica','=','ExperienciaEspecifica.id')
            ->join('AreaDeExperiencia','ExperienciaEspecifica.idAreaDeExperiencia','=','AreaDeExperiencia.id')
            ->join('CampoDeExperiencia','AreaDeExperiencia.idCampoDeExperiencia','=','CampoDeExperiencia.id')
            ->select('ExperienciaLaboral.id')
            ->where('CampoDeExperiencia.id',$id)->count();

        return response()->json($result,200);
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

    public function usersByAreaExperience(Request $request,$id)
    {
        try{

        TokenAuthController::checkUser('Admin');
        $result['users'] = DB::table('ExperienciaLaboral')
            ->join('ExperienciaEspecifica','ExperienciaLaboral.idExperienciaEspecifica','=','ExperienciaEspecifica.id')
            ->join('AreaDeExperiencia','ExperienciaEspecifica.idAreaDeExperiencia','=','AreaDeExperiencia.id')
            ->join('CampoDeExperiencia','AreaDeExperiencia.idCampoDeExperiencia','=','CampoDeExperiencia.id')
            ->select('ExperienciaLaboral.id')
            ->where('AreaDeExperiencia.id',$id)->count();

        return response()->json($result,200);

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
    public function usersBySpecificExperience(Request $request,$id)
    {
        $result['data'] = DB::table('ExperienciaLaboral')
            ->join('ExperienciaEspecifica','ExperienciaLaboral.idExperienciaEspecifica','=','ExperienciaEspecifica.id')
            ->join('AreaDeExperiencia','ExperienciaEspecifica.idAreaDeExperiencia','=','AreaDeExperiencia.id')
            ->join('CampoDeExperiencia','AreaDeExperiencia.idCampoDeExperiencia','=','CampoDeExperiencia.id')
            ->select('ExperienciaLaboral.id')
            ->where('ExperienciaEspecifica.id',$id)->count();

        return response()->json($result,200);

    }

    public function usersByEducation(Request $request)
    {
        try{
            TokenAuthController::checkUser('Admin');
            $escolaridades = Escolaridad::select(DB::raw('count(id) as usuarios, NivelDeEstudios'))
                ->groupBy('NivelDeEstudios')
                ->orderBy('usuarios','desc')
                ->get();

            $result =array();
            foreach($escolaridades as $escolaridad)
            {
                //Aqui asigno el Label
                switch($escolaridad->NivelDeEstudios)
                {
                    case 1:
                        $label = "Sin Instruccion";
                        break;
                    case 2:
                        $label = "Sabe Leer y Escribir";
                        break;
                    case 3:
                        $label = "Primaria";
                        break;
                    case 4:
                        $label = "Secundaria";
                        break;
                    case 5:
                        $label = "Bachillerato";
                        break;
                    case 6:
                        $label = "Licenciatura";
                        break;
                    case 7:
                        $label = "Maestría";
                        break;
                    case 8:
                        $label = "Doctorado";
                        break;
                }
                $result['labels'][]=$label;
                $result['data'][]=$escolaridad->usuarios;
            }
            return response()->json($result,200);
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


    public function userStats()
    {
        try{
            TokenAuthController::checkUser('Admin');
            $count['Registrados'] = User::whereNotNull('username')->count();
            $count['DatosPersonales'] = DatosPersonales::count();
            $count['Escolaridad'] = Escolaridad::count();
            $count['ExperienciaLaboral'] = ExperienciaLaboral::distinct('idUsuario')->count('idUsuario');
            $count['Encuesta'] = User::where('encuesta',5)->count();
            return response()->json($count,200);
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



    public function combinedStats(Request $request){
        try{
            TokenAuthController::checkUser('Admin');
            $stats = DB::table('ExperienciaLaboral');
            if($request->Combined=='true')
            {
                $stats->join('Direccion', 'ExperienciaLaboral.idUsuario', '=', 'Direccion.idUsuario')
                    ->join('Municipio','Direccion.idMunicipio','=','Municipio.id')
                    ->join('EntidadFederativa','Municipio.idEstado','=','EntidadFederativa.id');
                switch($request->Specificity)
                {
                    case 'campo':
                        $stats
                            ->join('AreaDeExperiencia','ExperienciaLaboral.idAreaDeExperiencia','=','AreaDeExperiencia.id')
                            ->select(DB::raw('COUNT(idAreaDeExperiencia) as Numero'),'AreaDeExperiencia.Nombre')
                            ->where('ExperienciaLaboral.idCampoDeExperiencia',$request->id)
                            ->where('EntidadFederativa.id',$request->idEntidadFederativa)
                            ->groupBy('ExperienciaLaboral.idAreaDeExperiencia');
                        break;
                    case 'area':
                        $stats
                            ->join('ExperienciaEspecifica','ExperienciaLaboral.idExperienciaEspecifica','=','ExperienciaEspecifica.id')
                            ->select(DB::raw('COUNT(idExperienciaEspecifica) as Numero'),'ExperienciaEspecifica.Nombre')
                            ->where('ExperienciaLaboral.idAreaDeExperiencia',$request->id)
                            ->where('EntidadFederativa.id',$request->idEntidadFederativa)
                            ->groupBy('ExperienciaLaboral.idExperienciaEspecifica');
                        break;
                }

            }
            else
            {
                switch($request->Specificity)
                {
                    case 'campo':
                        $stats
                            ->join('AreaDeExperiencia','ExperienciaLaboral.idAreaDeExperiencia','=','AreaDeExperiencia.id')
                            ->select(DB::raw('COUNT(idAreaDeExperiencia) as Numero'),'AreaDeExperiencia.Nombre')
                            ->where('ExperienciaLaboral.idCampoDeExperiencia',$request->id)
                            ->groupBy('ExperienciaLaboral.idAreaDeExperiencia');
                        break;
                    case 'area':
                        $stats
                            ->join('ExperienciaEspecifica','ExperienciaLaboral.idExperienciaEspecifica','=','ExperienciaEspecifica.id')
                            ->select(DB::raw('COUNT(idExperienciaEspecifica) as Numero'),'ExperienciaEspecifica.Nombre')
                            ->where('ExperienciaLaboral.idAreaDeExperiencia',$request->id)
                            ->groupBy('ExperienciaLaboral.idExperienciaEspecifica');
                        break;
                }

            }
            $data = $stats->get();
            foreach($data as $stat)
            {
                $newStat['Values'][] = $stat->Numero;
                $newStat['Labels'][] = $stat->Nombre;
            }
            return response()->json($newStat);
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


    public function countMissing()
    {
        try {
            TokenAuthController::checkUser('Admin');
            $count['Faltantes'] = User::whereNull('username')->count();
            return response()->json($count);
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

    public function usersByRegister($id)
    {
        try{
            TokenAuthController::checkUser('Admin');
            $query = DB::table('Usuario')
                ->leftJoin('ExperienciaLaboral','Usuario.id','=','ExperienciaLaboral.idUsuario')
                ->leftJoin('DatosPersonales','Usuario.id','=','DatosPersonales.idUsuario')
                ->leftJoin('IdiomaUsuario','Usuario.id','=','IdiomaUsuario.idEmpleado')
                ->leftJoin('Escolaridad','Usuario.id','=','Escolaridad.idUsuario')
                ->select('Usuario.id','Usuario.username','DatosPersonales.Nombre','DatosPersonales.ApellidoP','DatosPersonales.ApellidoM',
                    'Usuario.encuesta as Encuesta','ExperienciaLaboral.id as ExperienciaLaboral','IdiomaUsuario.idIdioma','Escolaridad.id as Escolaridad');
            if(!is_numeric($id))
            {
                $query = $query->where('DatosPersonales.Nombre','LIKE','%'.$id.'%')
                    ->orWhere('DatosPersonales.ApellidoP','LIKE','%'.$id.'%')
                    ->orWhere('DatosPersonales.ApellidoM','LIKE','%'.$id.'%')
                    ->groupBy('Usuario.id')
                    ->get();
            }
            else
            {
                $query= $query->where('Usuario.id','LIKE',$id.'%')
                    ->groupBy('Usuario.id')
                    ->get();
            }
            return response()->json(['Registros'=>$query]);

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
