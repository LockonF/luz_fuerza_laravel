<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Escolaridad extends Model
{
    protected $table = 'Escolaridad';
    protected $fillable =
        ['idUsuario','idPais','idCarrera','idInstitucionEducativa','NivelDeEstudios','GradoDeAvance','CedulaProfesional',
        'FechaDeInicio','FechaDeTermino'];


    public function Usuario(){
        return $this->belongsTo('\App\User','idUsuario');
    }

    public function Pais(){
        return $this->belongsTo('\App\Model\Pais','idPais');
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
