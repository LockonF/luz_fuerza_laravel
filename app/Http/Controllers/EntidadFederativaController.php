<?php

namespace App\Http\Controllers;

use App\Models\EntidadFederativa;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class EntidadFederativaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $entidades = \App\Models\EntidadFederativa::get();
        return response()->json(
            [
                "msg"=>"success",
                "entidades"=>$entidades->toArray()
            ],200);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $entidadFederativa = EntidadFederativa::where('id',$id)->first();
        if(!is_null($entidadFederativa))
        {
            return response()->json(
                [
                    "msg"=>"success",
                    "entidadFederativa"=>$entidadFederativa->toArray()
                ],200);
        }
        else{
            return request()->json('entidad_federativa_not_found',404);
        }
    }

    /**
     * Muestra Los Municipios asociados a la EntidadFederativa
     */

    public function showMunicipios($id)
    {
        $entidadFederativa = EntidadFederativa::where('id',$id)->first();
        $entidadFederativa->load('Municipios');
        if(!is_null($entidadFederativa))
        {
            return response()->json(
                [
                    "msg"=>"success",
                    "entidadFederativa"=>$entidadFederativa->toArray()
                ],200);
        }
        else{
            return response()->json('entidad_federativa_not_found',404);
        }

    }

    /**
     * Muestra La Informacion con Localidades
     */
    public function showWithLocalidades($id)
    {
       $entidadFederativa = EntidadFederativa::with('Municipio')->where('id',$id)->first();



        return response()->json(['msg'=>'success','entidadFederativa'=>$entidadFederativa->toArray()]);
    }


}
