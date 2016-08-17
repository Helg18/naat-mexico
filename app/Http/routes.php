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
    });

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



});
