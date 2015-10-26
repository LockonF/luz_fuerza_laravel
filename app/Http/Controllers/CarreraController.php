<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Carrera;

class CarreraController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carrera= \App\Models\Carrera::get();
        return response()->json(
            [
                "msg"=>"success",
                "carrera"=>$carrera->toArray()
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

        $carrera = \App\Models\Carrera();
        $carrera->nombre = $request->nombre;
        $carrera->tipo = $request->tipo;
        $carrera->area = $request->area;
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

        $carrera = Carrera::find($id);

        return response()->json(
            [
                "msg"=>"success",
                "carrera"=>$carrera->toArray()
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
                $carreras = Carrera::where('Tipo','Tecnicas')->get();
                break;
            case "6":
                $carreras = Carrera::where('Tipo','Profesional')->get();
                break;
            case "7":
                $carreras = Carrera::where('Tipo','Posgrado')->get();
                break;
            default:
                return response()->json('nivel_not_found',404);
                break;
        }
        return response()->json([
            'Carrera'=>$carreras->toArray()
        ],200);

    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showAreas($id)
    {
        $carrera = EntidadFederativa::where('id',$id)->first();
        $carrera->load('Area');
        if(!is_null($carrera))
        {
            return response()->json(
                [
                    "msg"=>"success",
                    "carrera"=>$carrera->toArray()
                ],200);
        }
        else{
            return response()->json('carrera_not_found',404);
        }
    }

}
