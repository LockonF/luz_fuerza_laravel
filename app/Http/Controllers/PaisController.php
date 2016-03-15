<?php

namespace App\Http\Controllers;

use App\Models\EntidadFederativa;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Pais;

class PaisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paises = Pais::with('EntidadesFederativas')->get();

        $paises->load(['EntidadesFederativas.Municipios' => function ($q) use (&$Municipios) {
            $Municipios = $q->get()->unique();
        }]);
        return response()->json(
            [
                "msg" => "success",
                "paises" => $paises->toArray()
            ], 200);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */

    public function showEntidades($id)
    {
        $pais = EntidadFederativa::where('idPais',$id)->get();
        return response()->json($pais);

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $pais = \App\Models\Pais();
        $pais->nombre = $request->nombre;
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $pais = Pais::find($id);
        $pais->load(['EntidadesFederativas.Municipios' => function ($q) use (&$Municipios) {
            $Municipios = $q->get()->unique();
        }]);
        return response()->json(
            [
                "msg" => "success",
                "pais" => $pais->toArray()
            ], 200);
    }

}
