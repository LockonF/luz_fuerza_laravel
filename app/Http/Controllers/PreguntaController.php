<?php

namespace App\Http\Controllers;

use App\Models\Pregunta;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class PreguntaController extends Controller
{
   public function showAll()
   {
       $preguntas = Pregunta::get();
       return response()->json($preguntas,200);
   }

    public function showStats($id)
    {
        $stats = DB::table('Cuestionario')
            ->join('Pregunta', 'Cuestionario.idPregunta', '=', 'Pregunta.id')
            ->join('PreguntaValor', function($join){
                $join->on('Pregunta.id', '=', 'PreguntaValor.idPregunta')->on('Cuestionario.Value','=','PreguntaValor.Valor');
            })
            ->select(DB::raw('COUNT(Cuestionario.id) as Numero'), 'PreguntaValor.Significado')
            ->where('Cuestionario.idPregunta',$id)
            ->groupBy('Cuestionario.value')
            ->get();

        foreach($stats as $stat)
        {
            $data['Values'][] = $stat->Numero;
            $data['Labels'][] = $stat->Significado;

        }

        return response()->json($data);
    }
}
