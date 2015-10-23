<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certificacion extends Model
{
    protected $table = 'Certificacion';
    protected $fillable =
        ['idEmpleado','Nombre','Area','Tipo','Descripcion','InstitucionCertificadora'];

    public function Usuario(){
        return $this->belongsTo('\App\User','idEmpleado');
    }


}
