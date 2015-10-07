<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EntidadFederativa extends Model
{
    protected $table = 'EntidadFederativa';
    protected $fillable = ['Clave','Nombre','Abrev'];

    public function Paises()
    {
        return $this->belongsTo('App\Models\Pais','idPais');
    }

    public function ExperienciaLaboral()
    {
        return $this->hasOne('App\Models\EntidadFederativa','idEntidadFederativa');
    }
}
