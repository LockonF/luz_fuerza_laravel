<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pregunta extends Model
{
    protected $table = 'Pregunta';
    protected $fillable = ['Oracion'];

    public function Valor()
    {
        return $this->hasMany('App\Models\PreguntaValor','idPregunta');
    }
}
