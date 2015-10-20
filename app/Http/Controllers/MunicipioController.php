<?php

namespace App\Http\Controllers;

use App\Models\Municipio;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class MunicipioController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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
        $municipio = Municipio::find($id);
        if(!is_null($municipio))
        {
            return response()->json([
                'msg'=>'success',
                'municipio'=>$municipio->toArray()
            ],200);
        }
        else
        {
            return response()->json([
                'msg'=>'municipio_not_found',
            ],400);
        }
    }

    /**
     * Muestra los Municipios Por Estado
     *
     */
    public function showByEstado($id)
    {
        $municipios = Municipio::where('idEstado',$id)->get();
        if(!$municipios->isEmpty())
        {
            return response()->json([
               'msg'=>'success',
                'municipios'=>$municipios->toArray()
            ],200);
        }
        else
        {
            return response()->json([
                'msg'=>'municipios_not_found',
            ],400);
        }
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
