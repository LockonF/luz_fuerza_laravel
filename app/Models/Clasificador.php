<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clasificador extends Model
{
    protected $table = 'Clasificador';
    protected $fillable = ['Nombre','Descripcion'];

    public function ClasificadorEspecifico()
    {
        return $this->hasMany('App\Models\ClasificadorEspecifico','idClasificador');
    }

}
