<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/cartelera');
});
Route::get('/home', function () {
    return redirect('/cartelera');
});
Auth::routes();
Route::group(['middleware' => ['auth']],function(){
	Route::get('/cartelera', 'HomeController@index');


    /**
     * Tasks routes
     */
    Route::get('/tareas/usuario');
	/**
	*Department Routes
	*/
	Route::get('/departamentos/registrar', 'DepartmentController@showDataForm');
	Route::get('/departamentos/editar/{id}', 'DepartmentController@showUpdateForm');
	Route::post('/departamentos/editar/{id}', 'DepartmentController@update');
	Route::post('/departamentos/registrar', 'DepartmentController@register');
	Route::get('/departamentos/listar', 'DepartmentController@index');
	Route::get('/departamentos', function(){ return redirect('/departamentos/listar');});

	/**
	*User Routes
	*/
	Route::get('/usuarios/registrar', 'UserController@showDataForm');
	Route::get('/usuarios/editar/{id}', 'UserController@showUpdateForm');
	Route::post('/usuarios/editar/{id}', 'UserController@update');
	Route::post('/usuarios/registrar', 'UserController@register');
	Route::get('/usuarios/listar', 'UserController@index');
	Route::get('/usuarios', function(){ return redirect('/usuarios/listar');});
	Route::post('/usuarios/desactivar', 'UserController@desactivate');
	Route::post('/usuarios/eliminar', 'UserController@delete');
	Route::post('/usuarios/reactivar', 'UserController@reactivate');

	/**
	*Calendar Routes
	*/
	Route::get('/calendario/actualizar', 'CalendarController@showDataForm');
	Route::post('/calendario/actualizar', 'CalendarController@update');
	Route::get('/calendario/ver', 'CalendarController@show');
	Route::get('/calendario', function(){ return redirect('/calendario/ver');});
});
Route::get('/about-us', 'HomeController@about');
