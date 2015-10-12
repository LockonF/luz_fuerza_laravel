<?php

namespace App\Http\Controllers;

use App\Models\InstitucionEducativa;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Pais;

class InstitucionEducativaController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $institucionEducativa= \App\Models\InstitucionEducativa::with('id')->get();
        return response()->json(
            [
                "msg"=>"success",
                "institucionEducativa"=>$institucionEducativa->toArray()
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

        $institucionEducativa = \App\Models\InstitucionEducativa();
        $institucionEducativa->nombre = $request->nombre;
        $institucionEducativa->siglas = $request->siglas;
        $institucionEductiva->tipo = $request->tipo;
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

        $institucionEducativa = InstitucionEducativa::find($id);

        return response()->json(
            [
                "msg"=>"success",
                "institucionEducativa"=>$institucionEducativa->toArray()
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
