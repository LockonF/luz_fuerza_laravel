<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Direccion extends Model
{
    //
    protected $table = 'Direccion';
    protected $fillable = ['Calle','NumeroExt','NumeroInt','Departamento','CodigoPostal','idMunicipio','Colonia'];
    protected $hidden = ['created_at','updated_at'];


    public function Municipio()
    {
        return $this->belongsTo('\App\Models\Municipio','idMunicipio');
    }

    public function Usuario()
    {
        return $this->belongsTo('\App\Usuario','idUsuario');
    }
}
