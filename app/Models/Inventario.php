<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    protected $table = 'Inventario';
    protected $fillable = ['Marca', 'Modelo', 'Descripcion',
        'Cantidad','Valor' ,'Estado', 'Observaciones', 'FechaDeAdquisicion',
        'idUbicacion', 'idClasificadorEspecifico'];

    public function Ubicacion()
    {
        return $this->belongsTo('App\Models\Ubicacion','idUbicacion');
    }

    public function ClasificadorEspecifico(){
        return $this->belongsTo('App\Models\ClasificadorEspecifico','idClasificadorEspecifico');
    }

}
