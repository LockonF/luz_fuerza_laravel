<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AreaDeExperiencia extends Model
{
    protected $table = 'AreaDeExperiencia';
    protected $fillable = ['Nombre','idCampoDeExperiencia'];

    public function CampoDeExperiencia()
    {
        return $this->belongsTo('App\Models\AreaDeExperiencia','idCampoDeExperiencia');
    }

    public function ExperienciaEspecifica()
    {
        return $this->hasMany('App\Models\ExperienciaEspecifica','idAreaDeExperiencia');
    }
}
