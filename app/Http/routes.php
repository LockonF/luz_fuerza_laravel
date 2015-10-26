<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

use Illuminate\Routing\Router;


Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'cors','prefix' => 'api'], function(Router $router){

    Route::post('authenticate', 'TokenAuthController@authenticate');
    Route::get('authenticate', 'TokenAuthController@getAuthenticatedUser');
    Route::post('register', 'TokenAuthController@register');

    //Campos de Experiencia
    Route::get('CampoDeExperiencia/{id}',"CampoDeExperienciaController@show");
    Route::get('CampoDeExperiencia',"CampoDeExperienciaController@showAll");
    //Paises
    Route::get('Pais','PaisController@index');
    Route::get('Pais/{id}',"PaisController@show");
    Route::post('Pais',"PaisController@store");
    Route::put('Pais/{id}',"PaisController@update");
    Route::delete('Pais/{id}',"PaisController@destroy");


    //Datos Personales de Usuario
    Route::get('DatosPersonales/{id}','DatosPersonalesController@show');
    Route::get('DatosPersonales','DatosPersonalesController@showMyData');
    Route::put('DatosPersonales','DatosPersonalesController@update');
    Route::post('DatosPersonales','DatosPersonalesController@store');
    Route::delete('DatosPersonales','DatosPersonalesController@destroy');

    //Direccion de Usuario
    Route::get('Direccion/{id}','DireccionesController@showOne');
    Route::get('Direccion','DireccionesController@show');
    Route::put('Direccion','DireccionesController@update');
    Route::post('Direccion','DireccionesController@store');
    Route::delete('Direccion','DireccionesController@destroy');


    //Experiencia Laboral
    Route::get('ExperienciaLaboral','ExperienciaLaboralController@show');
    Route::get('ExperienciaLaboral/{id}','ExperienciaLaboralController@showOne');
    Route::put('ExperienciaLaboral/{id}','ExperienciaLaboralController@update');
    Route::post('ExperienciaLaboral','ExperienciaLaboralController@store');
    Route::delete('ExperienciaLaboral/{id}','ExperienciaLaboralController@destroy');

    //Certificacion
    Route::get('Certificacion','CertificacionController@show');
    Route::get('Certificacion/{id}','CertificacionController@showOne');
    Route::put('Certificacion/{id}','CertificacionController@update');
    Route::post('Certificacion','CertificacionController@store');
    Route::delete('Certificacion/{id}','CertificacionController@destroy');

    //Escolaridad
    Route::get('Escolaridad','EscolaridadController@show');
    Route::get('Escolaridad/{id}','EscolaridadController@showOne');
    Route::put('Escolaridad/{id}','EscolaridadController@update');
    Route::post('Escolaridad','EscolaridadController@store');
    Route::delete('Escolaridad/{id}','EscolaridadController@destroy');

    //Entidad Federativa
    Route::get('EntidadFederativa',"EntidadFederativaController@index");
    Route::get('EntidadFederativa/{id}',"EntidadFederativaController@show");
    Route::get('EntidadFederativa/All/{id}',"EntidadFederativaController@showWithLocalidades");
    Route::get('EntidadFederativa/Municipios/{id}',"EntidadFederativaController@showMunicipios");

    //Municipios
    Route::get('Municipio/{id}',"MunicipioController@show");
    Route::get('Municipio/Estado/{id}',"MunicipioController@showByEstado");

    //Carrera
    Route::get('Carrera',"CarreraController@index");
    Route::get('Carrera/{id}',"CarreraController@show");
    Route::get('Carrera/Area/{id}',"CarreraController@showByArea");
    Route::get('Carrera/Nivel/{id}',"CarreraController@showByLevel");

    //InstitucionEducativa
    Route::get('InstitucionEducativa/{id}',"InstitucionEducativaController@show");
    Route::get('InstitucionEducativa/Nivel/{id}',"InstitucionEducativaController@showByLevel");
    Route::get('InstitucionEducativa/Escolaridad/{id}',"InstitucionEducativaController@showByArea");


    //Idiomas del Usuario
    Route::get('IdiomaUsuario','IdiomaUsuarioController@showAll');
    Route::post('IdiomaUsuario','IdiomaUsuarioController@store');
    Route::put('IdiomaUsuario/{id}','IdiomaUsuarioController@update');
    Route::delete('IdiomaUsuario/{id}','IdiomaUsuarioController@destroy');


    //Estadisticas
    Route::post('Estadisticas/Edades','EstadisticasController@usersByAge');
    Route::post('Estadisticas/Ubicacion','EstadisticasController@usersByLocation');


    //Logros
    Route::get('Logro','LogroController@show');
    Route::get('Logro/{id}','LogroController@showOne');
    Route::put('Logro/{id}','LogroController@update');
    Route::post('Logro','LogroController@store');
    Route::delete('Logro/{id}','LogroController@destroy');

    //Idiomas
    Route::get('Idioma','IdiomaController@showAll');
    Route::get('Idioma/{id}','IdiomaController@show');

});