<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Direccion extends Model
{
    //
    protected $table = 'Direccion';
    protected $fillable = ['Calle','NumeroExt','NumeroInt','Departamento','CodigoPostal','idLocalidad'];

    public function Usuario()
    {
        return $this->belongsTo('\App\Usuario','idUsuario');
    }
}
