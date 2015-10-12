<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Escolaridad extends Model
{
    protected $table = 'Escolaridad';
    protected $fillable =
        ['idUsuario','idEntidadFederativa','idCarrera','idInstitucionEducativa','NivelDeEstudios','GradoDeAvance','CedulaProfesional',
        'FechaDeInicio','FechaDeTermino'];

    protected $hidden = ['id'];

    public function Usuario(){
        return $this->belongsTo('\App\User','idUsuario');
    }

    public function EntidadFederativa(){
        return $this->belongsTo('\App\Model\EntidadFederativa','idEntidadFederativa');
    }

    public function Carrera()
    {
        return $this->belongsTo('\App\Model\Carrera','idCarrera');
    }
    public function InstitucionEducativa()
    {
        return $this->belongsTo('\App\Model\InstitucionEducativa','idInstitucionEducativa');
    }





}
