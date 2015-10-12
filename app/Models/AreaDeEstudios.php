<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AreaDeEstudios extends Model
{
    protected $table = 'AreaDeEstudios';
    protected $fillable = ['Nombre'];


    public function Carrera()
    {
        return $this->hasMany('App\Models\Carrera','idAreaDeEstudios');
    }
}
