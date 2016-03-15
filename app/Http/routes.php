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


    //Validaciones
    Route::post('authenticate', 'TokenAuthController@authenticate');
    Route::post('validate', 'TokenAuthController@validateUsernameHash');
    Route::get('authenticate', 'TokenAuthController@getAuthenticatedUser');
    Route::post('register', 'TokenAuthController@register');

    //Campos de Experiencia

    Route::get('CampoDeExperiencia/Simple','CampoDeExperienciaController@showSimple');

    Route::get('CampoDeExperiencia/{id}',"CampoDeExperienciaController@show");
    Route::get('CampoDeExperiencia',"CampoDeExperienciaController@showAll");

    //Areas de Experiencia

    Route::get('CampoDeExperiencia/Areas/{id}','AreaDeExperienciaController@show');

    //ExperienciaEspecifico
    Route::get('AreaDeExperiencia/Especifico/{id}','AreaDeExperienciaController@showExperienciasEspecificas');


    //Paises
    Route::get('Pais','PaisController@index');
    Route::get('Pais/{id}',"PaisController@show");
    Route::get('Pais/EntidadFederativa/{id}','PaisController@showEntidades');




    //Datos Personales de Usuario
    Route::get('DatosPersonales/{id}','DatosPersonalesController@show');
    Route::get('DatosPersonales','DatosPersonalesController@showMyData');
    Route::post('DatosPersonales','DatosPersonalesController@store');
    Route::post('DatosPersonales/Update','DatosPersonalesController@update');
    Route::get('DatosPersonales/Delete','DatosPersonalesController@destroy');

    //Direccion de Usuario
    Route::get('Direccion/{id}','DireccionesController@showOne');
    Route::get('Direccion','DireccionesController@show');
    Route::post('Direccion','DireccionesController@store');
    Route::post('Direccion/Update','DireccionesController@update');
    Route::get('Direccion/Delete','DireccionesController@destroy');


    //Experiencia Laboral (lista)
    Route::get('ExperienciaLaboral','ExperienciaLaboralController@show');
    Route::post('ExperienciaLaboral','ExperienciaLaboralController@store');
    Route::get('ExperienciaLaboral/Show/{id}','ExperienciaLaboralController@showOne');
    Route::post('ExperienciaLaboral/{id}/Update','ExperienciaLaboralController@update');
    Route::get('ExperienciaLaboral/{id}/Delete','ExperienciaLaboralController@destroy');

    //Certificacion (lista)
    Route::get('Certificacion','CertificacionController@show');
    Route::get('Certificacion/{id}','CertificacionController@showOne');
    Route::post('Certificacion','CertificacionController@store');
    Route::post('Certificacion/{id}/Update','CertificacionController@update');
    Route::get('Certificacion/{id}/Delete','CertificacionController@destroy');

    //Escolaridad
    Route::get('Escolaridad','EscolaridadController@show');
    Route::post('Escolaridad','EscolaridadController@store');
    Route::post('Escolaridad/Update','EscolaridadController@update');
    Route::get('Escolaridad/Delete','EscolaridadController@destroy');

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


    //Idiomas del Usuario (lista)
    Route::get('IdiomaUsuario','IdiomaUsuarioController@showAll');
    Route::post('IdiomaUsuario','IdiomaUsuarioController@store');
    Route::post('IdiomaUsuario/{id}/Update','IdiomaUsuarioController@update');
    Route::get('IdiomaUsuario/{id}/Delete','IdiomaUsuarioController@destroy');


    //Estadisticas
    Route::get('Estadisticas/Campo/{id}','EstadisticasController@usersByFieldExperience');
    Route::get('Estadisticas/Area/{id}','EstadisticasController@usersByAreaExperience');
    Route::get('Estadisticas/Experiencia/{id}','EstadisticasController@usersBySpecificExperience');
    Route::post('Estadisticas/Edades','EstadisticasController@usersByAge');
    Route::post('Estadisticas/Proyeccion','EstadisticasController@usersByAgeProjection');
    Route::get('Estadisticas/Ubicacion','EstadisticasController@usersByLocation');
    Route::get('Estadisticas/Educacion','EstadisticasController@usersByEducation');
    Route::get('Estadisticas/Registros','EstadisticasController@userStats');
    Route::get('Estadisticas/Sexo','EstadisticasController@usersBySex');
    Route::get('Estadisticas/Faltantes','EstadisticasController@countMissing');
    Route::get('Estadisticas/RegistroDatos/{id}','EstadisticasController@usersByRegister');


    Route::post('Estadisticas/Combinado','EstadisticasController@combinedStats');

    //Logros (lista)
    Route::get('Logro','LogroController@show');
    Route::get('Logro/{id}','LogroController@showOne');
    Route::post('Logro/{id}/Update','LogroController@update');
    Route::post('Logro','LogroController@store');
    Route::get('Logro/{id}/Delete','LogroController@destroy');

    //Idiomas
    Route::get('Idioma','IdiomaController@showAll');
    Route::get('Idioma/{id}','IdiomaController@show');

    //Subdirecciones y Gerencias SME
    Route::get('Subdireccion/','SubdireccionController@index');

    //Cuestionario
    Route::get('Cuestionario','CuestionarioController@show');
    Route::get('Cuestionario/Reset','CuestionarioController@reset');
    Route::post('Cuestionario','CuestionarioController@store');


    //Admin
    Route::get('Admin/User/{id}','AdminController@checkRegistry');
    Route::get('Admin/User','AdminController@getAllRegistries');
    Route::get('Admin/Carrera/{id}','AdminController@lookupByCareer');

    //Preguntas
    Route::get('Pregunta','PreguntaController@showAll');
    Route::get('Pregunta/{id}','PreguntaController@showStats');

});