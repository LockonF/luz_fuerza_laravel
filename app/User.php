<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'Usuario';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id','username', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function DatosPersonales()
    {
        return $this->hasOne('App\Models\DatosPersonales','idUsuario');
    }

    public function Direccion()
    {
        return $this->hasOne('App\Models\Direccion','idUsuario');
    }

    /**
     *
     */
    public function ExperienciaLaboral()
    {
        return $this->hasMany('App\Models\ExperienciaLaboral','idUsuario');
    }
    /**
     *
     */
    public function Certificacion()
    {
        return $this->hasMany('App\Models\Certificacion','idEmpleado');
    }
    /**
     *
     */
    public function Logro()
    {
        return $this->hasMany('\App\Models\Logro','idEmpleado');
    }


    /**
     *
     */
    public function Escolaridad()
    {
        return $this->hasMany('App\Models\Escolaridad','idUsuario');
    }

    /**
     *
     */

    public function Idiomas()
    {
        return $this->belongsToMany('App\Models\Idioma', 'IdiomaUsuario', 'idEmpleado', 'idIdioma')->withPivot('NivelRedaccion','NivelConversacion','NivelLectura','DocumentoAcredita','Materno');

    }

    /**
     *
     */
    public function Cuestionario()
    {
        return $this->hasMany('App\Models\Cuestionario','idUsuario');
    }

}
