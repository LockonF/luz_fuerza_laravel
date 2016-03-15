<?php

namespace App\Http\Controllers;

use App\Models\AreaDeExperiencia;
use App\Models\ExperienciaEspecifica;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class AreaDeExperienciaController extends Controller
{
    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */

    public function show($id)
    {
        return response()->json(AreaDeExperiencia::where('idCampoDeExperiencia',$id)->get());
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */

    public function showExperienciasEspecificas($id)
    {
        return response()->json(ExperienciaEspecifica::where('idAreaDeExperiencia',$id)->get());
    }


}
