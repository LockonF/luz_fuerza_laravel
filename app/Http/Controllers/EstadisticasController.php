<?php

namespace App\Http\Controllers;

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

        $ranges = $request->all()['array'];


        foreach($ranges as $range)
        {
            $users[] = DatosPersonales::whereYear('FechaNacimiento','>=',$thisYear-$range['maxRange'])->whereYear('FechaNacimiento','<=',$thisYear-$range['minRange'])->count();
        }

        return response()->json(['users'=>$users],200);
    }

    public function usersByLocation(Request $request)
    {

        foreach($request->all() as $id)
        {

            $result[] =\DB::table('Direccion')
                ->join('Localidad', 'Direccion.idLocalidad', '=', 'Localidad.id')
                ->join('Municipio', 'Municipio.id', '=', 'Localidad.idMunicipio')
                ->join('EntidadFederativa', 'EntidadFederativa.id', '=', 'Municipio.idEstado')
                ->select('Direccion.id')
                ->where('EntidadFederativa.id', $id)->count();
        }
        return response()->json(['users'=>$result],200);

    }
}
