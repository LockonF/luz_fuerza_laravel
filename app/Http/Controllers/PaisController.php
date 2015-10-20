<?php

namespace App\Http\Controllers;

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
        $paises = \App\Models\Pais::with('EntidadesFederativas')->get();

        $paises->load(['EntidadesFederativas.Municipios'=>function($q) use (&$Municipios){
            $Municipios = $q->get()->unique();
        }]);return response()->json(
            [
                "msg"=>"success",
                "paises"=>$paises->toArray()
            ],200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $pais = Pais::find($id);
        $pais->load(['EntidadesFederativas.Municipios'=>function($q) use (&$Municipios){
            $Municipios = $q->get()->unique();
    }]);
        return response()->json(
            [
                "msg"=>"success",
                "pais"=>$pais->toArray()
            ],200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
