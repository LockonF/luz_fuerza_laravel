<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    protected $table = 'Municipio';
    protected $fillable = ['Clave','Nombre','Sigla','idEstado'];

    public function EntidadFederativa()
    {
        return $this->belongsTo('App\Model\EntidadFederativa','idEstado');
    }

    public function Localidades()
    {
        return $this->hasMany('App\Model\Localidad','idMunicipio');
    }
}
