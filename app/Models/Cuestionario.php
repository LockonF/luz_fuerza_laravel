<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cuestionario extends Model
{
    protected $table = 'Cuestionario';
    protected $fillable = ['idUsuario','idPregunta','value','other'];

    public function User()
    {
        return $this->belongsTo('App\User','idUsuario');
    }
}
