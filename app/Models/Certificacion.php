<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certificacion extends Model
{
    protected $table = 'Certificacion';
    protected $fillable =
        ['idEmpleado','Nombre','Area','Tipo','Descripcion','InstitucionCertificadora'];

    protected $hidden = ['id'];

    public function Usuario(){
        return $this->belongsTo('\App\User','idUsuario');
    }


}
