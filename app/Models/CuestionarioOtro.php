<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CuestionarioOtro extends Model
{
    protected $table = 'CuestionarioOtros';
    protected $fillable = ['idCuestionario','Respuesta'];
}
