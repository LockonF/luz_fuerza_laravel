<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subdireccion extends Model
{
    //

    protected $table = 'Subdireccion';
    protected $fillable = ['Nombre'];
    protected $hidden = ['created_at','updated_at'];
    public function  Gerencia()
    {
        return $this->hasMany('\App\Models\Gerencia','idSubdireccion');
    }
}
