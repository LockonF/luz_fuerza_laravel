<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Logro extends Model
{
    protected $table = 'Logro';
    protected $fillable = ['Logro','Descripcion','DocumentoAval','Fecha','idPais','idEmpleado'];

    public function User(){
        return $this->belongsTo('\App\User','idEmpleado');
    }

    public function Pais()
    {
        return $this->belongsTo('\App\Models\Pais','idPais');
    }
}
