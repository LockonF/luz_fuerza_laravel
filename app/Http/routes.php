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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'api'], function()
{
    Route::post('authenticate', 'TokenAuthController@authenticate');
    Route::get('authenticate/user', 'TokenAuthController@getAuthenticatedUser');
    Route::post('register', 'TokenAuthController@register');
    Route::get('Pais','PaisController@index');
    Route::get('Pais/{id}',"PaisController@show");
    Route::post('Pais',"PaisController@store");
    Route::put('Pais/{id}',"PaisController@update");
    Route::delete('Pais/{id}',"PaisController@destroy");


    //Datos Personales de Usuario
    Route::get('DatosPersonales','DatosPersonalesController@show');
    Route::put('DatosPersonales','DatosPersonalesController@update');
    Route::post('DatosPersonales','DatosPersonalesController@store');
    Route::delete('DatosPersonales','DatosPersonalesController@destroy');

    //Direccion de Usuario
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


    Route::get('EntidadFederativa',"EntidadFederativaController@index");
});

