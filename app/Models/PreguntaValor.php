<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PreguntaValor extends Model
{
    protected $table = 'PreguntaValor';
    protected $fillable = ['idPregunta','Valor','Significado'];

    public function Pregunta()
    {
        return $this->belongsTo('App\Models\Pregunta','idPregunta');
    }

}
