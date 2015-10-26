<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\InstitucionEducativa;

class InstitucionEducativaController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $institucionEducativa= InstitucionEducativa::with('id')->get();
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

        $institucionEducativa = InstitucionEducativa();
        $institucionEducativa->nombre = $request->nombre;
        $institucionEducativa->siglas = $request->siglas;
        $institucionEducativa->tipo = $request->tipo;
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
     * ShowByLevel
     *
     */
    public function showByLevel($id)
    {

        switch($id)
        {
            case "5":
                $instituciones = InstitucionEducativa::where('Tipo','Tecnicas')->get();
                break;
            case "6":
                $instituciones = InstitucionEducativa::where('Tipo','Profesional')->get();
                break;
            case "7":
                $instituciones = InstitucionEducativa::where('Tipo','Posgrado')->get();
                break;
            default:
                return response()->json('nivel_not_found',404);
                break;
        }
        return response()->json([
            'InstitucionEducativa'=>$instituciones->toArray()
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
