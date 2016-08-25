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

Route::auth();

Route::get('/','HomeController@index');

Route::get('/home', 'HomeController@index');


Route::post('angular/question/{id}/images', 'AngularController@images');
Route::post('angular/question/{id}/sonido', 'AngularController@sonidos');
Route::group(['prefix' => 'angular'], function () {
    Route::get('quiz/{id}/questions', 'AngularController@questions');
    Route::get('group/{id}/emails', 'AngularController@emails');
});


Route::get('angular/{id}/user-detail', 'AngularController@user_detail');
Route::controllers([
    'angular'           =>  'AngularController',
    'report'            =>  'ReportController',
]);



Route::group(['prefix' => 'nse'], function () {
    Route::get('quiz', 'NseController@index');

    Route::resource('level', 'NseLevelController');
});

Route::group(['prefix' => 'config'], function () {
    Route::resource('user', 'UserController');
    Route::get('user/{id}/status', 'UserController@status');

    Route::resource('plan', 'PlanController');
    Route::get('plan/{id}/status', 'PlanController@status');
});

Route::resource('companies', 'CompanyController');
Route::get('companies/{id}/status', 'CompanyController@status');
Route::get('companies/{id}/plan-info', 'CompanyController@plan');


Route::group(['prefix' => 'company'], function () {
    Route::resource('user', 'UserController');
    Route::get('user/{id}/status', 'UserController@status');

    Route::resource('quiz', 'QuizController');
    Route::get('quiz/{id}/status', 'QuizController@status');

    Route::resource('group', 'GroupController');
    //Route::get('quiz/{id}/status', 'QuizController@status');

});


Route::group(['prefix' => 'api', 'middleware' => ['jsonify']], function () {

    Route::delete('v1/{id}/quiz', 'Api\V1Controller@quiz_delete');
    Route::controllers([
        'v1'           =>  'Api\V1Controller',
    ]);
});


/**
 * Rutas para login a traves de API
 */
Route::group(['prefix' => 'api'], function(){

    //Login
    Route::post('login', [
        'as' => 'API_login',
        'uses' => 'Api\V1Controller@login'
        ]);

    //Registro
    Route::post('register', [
        'as' => 'API_register',
        'uses' => 'Api\V1Controller@register'
        ]);

    //Recuperar contraseña
    Route::post('postRecoverPassword', [
        'as' => 'postRecoverPassword',
        'uses' => 'Api\V1Controller@postRecoverPassword'
        ]);


    Route::group(['middleware' => 'jwt-auth'], function(){
        //Obtener las reglas del juego
        Route::POST('reglasdeljuego', [
            'as' => 'API_reglasdeljuego',
            'uses' => 'Api\V1Controller@reglasdeljuego'
            ]);

        //Obtener las fechas
        Route::POST('fechas', [
            'as' => 'API_fechas',
            'uses' => 'Api\V1Controller@fechas'
            ]);

        //Obtener los premios
        Route::POST('premios', [
            'as' => 'API_premios',
            'uses' => 'Api\V1Controller@premios'
            ]);

        //Obtener las categorias y subcategorias
        Route::POST('categorias', [
            'as' => 'API_categorias',
            'uses' => 'Api\V1Controller@categorias'
            ]);
        
        //Obtener las iniciativas
        Route::POST('iniciativas', [
            'as' => 'API_iniciativas',
            'uses' => 'Api\V1Controller@iniciativas'
            ]);        
        
        //Guardar_iniciativas
        Route::POST('guardar_iniciativas', [
            'as' => 'API_guardar_iniciativas',
            'uses' => 'Api\V1Controller@guardar_iniciativas'
            ]);        
        
        //Listar decalogos
        Route::POST('decalogos', [
            'as' => 'API_decalogos',
            'uses' => 'Api\V1Controller@decalogos'
            ]);

        //listar tips
        Route::POST('tips', [
            'as' => 'API_tips',
            'uses' => 'Api\V1Controller@tips'
            ]);

        //listar tips
        Route::POST('guardar_tips', [
            'as' => 'API_guardar_tips',
            'uses' => 'Api\V1Controller@guardar_tips'
            ]);

        //Guardar votaciones
        Route::POST('guardar_votaciones', [
            'as' => 'API_guardar_votaciones',
            'uses' => 'Api\V1Controller@guardar_votaciones'
            ]);

        //Mostrar votaciones
        Route::POST('listar_votaciones', [
            'as' => 'API_listar_votaciones',
            'uses' => 'Api\V1Controller@listar_votaciones'
            ]);

    });//fin de grupo de rutas para el middleware Auth

});


/**
 * Fin de rutas para login a traves de API
 */



Route::group(['prefix' => 'admin', 'middleware'=> 'auth'], function(){
    Route::resource('usuarios', 'UsuariosController');
    
    //rutas de Reglasdeljuego
    Route::resource('reglas', 'ReglasdeljuegoController');

    //rutas para las fechas
    Route::resource('fechas', 'FechasController');

    //rutas para los premios
    Route::resource('premios', 'PremiosController');

    //Rutas para las categorias
    Route::resource('categorias','CategoriasController');
    
    //Rutas para las subcategorias
    Route::resource('subcategoria','SubcategoriasController');
    Route::get('subcategoria/creates/{id}', [
        'as'=>'admin.subcategorias.create',
        'uses'=>'SubcategoriasController@create'
        ]);

    //Rutas para las iniciativas
    Route::resource('iniciativas','IniciativaController');

    //Rutas para los Decalogos
    Route::resource('decalogos','DecalogoController');

});
