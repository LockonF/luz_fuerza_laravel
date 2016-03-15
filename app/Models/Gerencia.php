<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gerencia extends Model
{
    //

    protected $table = 'Gerencia';
    protected $fillable = ['Nombre','idSubdireccion'];
    protected $hidden = ['created_at','updated_at'];

    public function Subdireccion()
    {
        return $this->belongsTo('\App\Models\Subdireccion','idSubdireccion');
    }
}
