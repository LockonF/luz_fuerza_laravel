<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CampoDeExperiencia extends Model
{
    protected $table = 'CampoDeExperiencia';
    protected $fillable = ['Nombre'];

    public function AreaDeExperiencia()
    {
        return $this->hasMany('App\Models\AreaDeExperiencia','idCampoDeExperiencia');
    }

}
