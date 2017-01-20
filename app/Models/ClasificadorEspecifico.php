<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClasificadorEspecifico extends Model
{
    protected $table = 'ClasificadorEspecifico';
    protected $fillable = ['Nombre','Descripcion','idClasificador'];

    public function Clasificador()
    {
        return $this->belongsTo('App\Models\Clasificador','idClasificador');
    }

    public function Inventario(){
        return $this->hasMany('App\Models\Inventario','idClasificadorEspecifico');
    }
}
