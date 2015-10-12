<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InstitucionEducativa extends Model
{
    protected $table = 'InstitucionEducativa';
    protected $fillable =
        ['Nombre','Siglas','Tipo'];

    protected $hidden = ['id'];

    public function Escolaridad(){
        return $this->hasMany('App\Models\Escolaridad','idInstitucionEducativa');
    }


}
