<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExperienciaLaboral extends Model
{
    protected $table = 'ExperienciaLaboral';
    protected $fillable =
        ['idEmpleado','idEntidadFederativa','NombreInstitucion','CampoDeExperiencia','AreaDeExperiencia','Jerarquia',
        'NombreDelPuesto','RemuneracionBrutaMensual','FechaInicio','FechaTermino','NombreSuperiorInmediato','ApellidoPSuperiorInmediato',
        'ApellidoMSuperiorInmediato','TelefonoSuperiorInmediato'];

    protected $hidden = ['id'];

    public function Usuario(){
        return $this->belongsTo('\App\User','idUsuario');
    }

    public function EntidadFederativa(){
        return $this->belongsTo('\App\Model\EntidadFederativa','idEntidadFederativa');
    }





}
