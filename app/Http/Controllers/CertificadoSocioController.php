<?php

namespace App\Http\Controllers;

use App\Models\CertificadoSocio;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Exceptions;
use Illuminate\Contracts\Validation\UnauthorizedException;


class CertificadoSocioController extends Controller
{
    public function indexBySocio($idUsuario){
        try {
            TokenAuthController::checkUser('Supervisor');
            return response()->json(CertificadoSocio::where('idUsuario',$idUsuario)->get());


        } catch (QueryException $e) {
            return response()->json(['message' => 'server_error', 'exception' => $e->getMessage()], 500);
        } catch (Exceptions\TokenExpiredException $e) {
            return response()->json(['token_expired'], $e->getStatusCode());
        } catch (Exceptions\TokenInvalidException $e) {
            return response()->json(['token_invalid'], $e->getStatusCode());
        } catch (UnauthorizedException $e) {
            return response()->json(['unauthorized'], $e->getStatusCode());
        } catch (Exceptions\JWTException $e) {
            return response()->json(['token_absent'], $e->getStatusCode());
        }
    }


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
        try {
            TokenAuthController::checkUser('Supervisor');
            $certificado_socio = new CertificadoSocio();
            $certificado_socio->fill($request->all());
            $certificado_socio->save();
            return response()->json($certificado_socio);
        } catch (QueryException $e) {
            return response()->json(['message' => 'server_error', 'exception' => $e->getMessage()], 500);
        } catch (Exceptions\TokenExpiredException $e) {
            return response()->json(['token_expired'], $e->getStatusCode());
        } catch (Exceptions\TokenInvalidException $e) {
            return response()->json(['token_invalid'], $e->getStatusCode());
        } catch (UnauthorizedException $e) {
            return response()->json(['unauthorized'], $e->getStatusCode());
        } catch (Exceptions\JWTException $e) {
            return response()->json(['token_absent'], $e->getStatusCode());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        try {
            TokenAuthController::checkUser('Supervisor');
            $certificado_socio = CertificadoSocio::find($id);
            if($certificado_socio==null)
            {
                return response()->json(['message'=>'inventario_not_found'],404);

            }
            $certificado_socio->delete();
            return response()->json(['message'=>'success']);
        } catch (QueryException $e) {
            return response()->json(['message' => 'server_error', 'exception' => $e->getMessage()], 500);
        } catch (Exceptions\TokenExpiredException $e) {
            return response()->json(['token_expired'], $e->getStatusCode());
        } catch (Exceptions\TokenInvalidException $e) {
            return response()->json(['token_invalid'], $e->getStatusCode());
        } catch (UnauthorizedException $e) {
            return response()->json(['unauthorized'], $e->getStatusCode());
        } catch (Exceptions\JWTException $e) {
            return response()->json(['token_absent'], $e->getStatusCode());
        }
    }
}
