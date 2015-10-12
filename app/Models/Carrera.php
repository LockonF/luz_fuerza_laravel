<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carrera extends Model
{
    protected $table = 'Carrera';
    protected $fillable =
        ['NombreCarrera','Tipo','Area'];

    protected $hidden = ['id'];

    public function Escolaridad(){
        return $this->hasMany('App\Models\Escolaridad','idCarrera');
    }
    public function AreaDeEstudios()
    {
        return $this->belongsTo('App\Models\AreaDeEstudios','idAreaDeEstudio');
    }
}
