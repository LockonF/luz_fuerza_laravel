<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExperienciaEspecifica extends Model
{
    protected $table = 'ExperienciaEspecifica';
    protected $fillable = ['Nombre','idAreaDeExperiencia'];

    public function AreaDeExperiencia()
    {
        return $this->belongsTo('App\Models\AreaDeExperiencia','idCampoDeExperiencia');
    }

    public function ExperienciaLaboral()
    {
        return $this->hasMany('App\Models\ExperienciaLaboral','idExperienciaEspecifica');
    }
}
