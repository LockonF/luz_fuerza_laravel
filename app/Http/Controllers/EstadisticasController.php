<?php

namespace App\Http\Controllers;

use App\Models\ExperienciaLaboral;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\DatosPersonales;
use App\Http\Controllers\DB;


use Illuminate\Database\Query;

class EstadisticasController extends Controller
{
    public function usersByAge(Request $request)
    {
        $thisYear = intval(date('Y'));

        $ranges = $request->all();


        foreach($ranges as $range)
        {
            $users[] = DatosPersonales::whereYear('FechaNacimiento','>=',$thisYear-$range['maxRange'])->whereYear('FechaNacimiento','<=',$thisYear-$range['minRange'])->count();
        }

        return response()->json($users,200);
    }

    public function usersByLocation(Request $request)
    {

        foreach($request->all() as $id)
        {

            $result[] =\DB::table('Direccion')
                ->join('Municipio', 'Municipio.id', '=', 'Direccion.idMunicipio')
                ->join('EntidadFederativa', 'EntidadFederativa.id', '=', 'Municipio.idEstado')
                ->select('Direccion.id')
                ->where('EntidadFederativa.id', $id)->count();
        }
        return response()->json($result,200);

    }


    public function usersByFieldExperience(Request $request,$id)
    {
        $result['users'] = \DB::table('ExperienciaLaboral')
            ->join('ExperienciaEspecifica','ExperienciaLaboral.idExperienciaEspecifica','=','ExperienciaEspecifica.id')
            ->join('AreaDeExperiencia','ExperienciaEspecifica.idAreaDeExperiencia','=','AreaDeExperiencia.id')
            ->join('CampoDeExperiencia','AreaDeExperiencia.idCampoDeExperiencia','=','CampoDeExperiencia.id')
            ->select('ExperienciaLaboral.id')
            ->where('CampoDeExperiencia.id',$id)->count();

        return response()->json($result,200);

    }

    public function usersByAreaExperience(Request $request,$id)
    {
        $result['users'] = \DB::table('ExperienciaLaboral')
            ->join('ExperienciaEspecifica','ExperienciaLaboral.idExperienciaEspecifica','=','ExperienciaEspecifica.id')
            ->join('AreaDeExperiencia','ExperienciaEspecifica.idAreaDeExperiencia','=','AreaDeExperiencia.id')
            ->join('CampoDeExperiencia','AreaDeExperiencia.idCampoDeExperiencia','=','CampoDeExperiencia.id')
            ->select('ExperienciaLaboral.id')
            ->where('AreaDeExperiencia.id',$id)->count();

        return response()->json($result,200);

    }
    public function usersBySpecificExperience(Request $request,$id)
    {
        $result['users'] = \DB::table('ExperienciaLaboral')
            ->join('ExperienciaEspecifica','ExperienciaLaboral.idExperienciaEspecifica','=','ExperienciaEspecifica.id')
            ->join('AreaDeExperiencia','ExperienciaEspecifica.idAreaDeExperiencia','=','AreaDeExperiencia.id')
            ->join('CampoDeExperiencia','AreaDeExperiencia.idCampoDeExperiencia','=','CampoDeExperiencia.id')
            ->select('ExperienciaLaboral.id')
            ->where('ExperienciaEspecifica.id',$id)->count();

        return response()->json($result,200);

    }


}
