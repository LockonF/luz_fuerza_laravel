<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ubicacion extends Model
{
    protected $table = 'Ubicacion';
    protected $fillable = ['Nombre', 'Descripcion','Direccion' ,'Longitud', 'Latitud'];

    public function Inventario()
    {
        return $this->hasMany('App\Models\Inventario','idUbicacion');
    }
}
