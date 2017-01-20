<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CertificadoSocio extends Model
{
    protected $table = 'CertificadoSocio';
    protected $fillable = ['idUsuario','idCertificado'];
}
