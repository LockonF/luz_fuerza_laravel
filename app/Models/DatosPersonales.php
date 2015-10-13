<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DatosPersonales extends Model
{
    protected $table = 'DatosPersonales';
    protected $fillable = ['Nombre','ApellidoP','ApellidoM','RFC','CURP','Sexo','FechaNacimiento','EstadoCivil','CorreoElectronico'];
    protected $hidden = ['created_at','updated_at'];

    public function Usuario(){
        return $this->belongsTo('\App\User','idUsuario');
    }



}
