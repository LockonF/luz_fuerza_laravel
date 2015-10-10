<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Idioma extends Model
{
    protected $table = 'Idioma';
    protected $fillable = ['NombreIdioma','Abreviatura'];

    public function Usuarios(){
        return $this->belongsToMany('App\User', 'IdiomaUsuario', 'idIdioma', 'idEmpleado')->withPivot('NivelRedaccion','NivelConversacion','NivelLectura','DocumentoAcredita','Materno');
    }
}
