<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Localidad extends Model
{
    protected $table = 'Localidad';
    protected $fillable = ['idMunicipio','Clave','Nombre','Latitud','Longitud','Altitud'];
    protected $hidden = ['Latitud','Longigut','Altitud','created_at','updated_at'];

    public function Municipio()
    {
        return $this->belongsTo('App\Model\Municipio','idMunicipio');
    }
}
