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
        return $this->hasMany('App\Models\EntidadFederativa','idEntidadFederativa');
    }

    public function Logro()
    {
        return $this->hasMany('\App\Models\Logro','idEntidadFederativa');
    }


    public function Municipios()
    {
        return $this->hasMany('App\Models\Municipio','idEstado');
    }



}
