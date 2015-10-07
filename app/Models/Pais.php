<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
    //Tabla a usar

    protected $table = 'Pais';
    protected $fillable = ['nombre'];

    public function EntidadesFederativas()
    {
       return $this->hasMany('App\Models\EntidadFederativa','idPais');
    }

}
