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
/**
 * Template routes
 */
Route::get('/charts', function(){
	return view('tmp.charts');
});
Route::get('/forms', function(){
	return view('tmp.forms');
});
Route::get('/icons', function(){
	return view('tmp.icons');
});
Route::get('/panels', function(){
	return view('tmp.panels');
});
Route::get('/tables', function(){
	return view('tmp.tables');
});
Route::get('/widgets', function(){
	return view('tmp.widgets');
});

Route::get('/test', function(){
	dd(\Auth::user()->accessList());
});
/**
 * Error routes
 */
	 Route::get('/401', function () {
	     return view('errors.401');
	 });
 /**
  * Home routes
  */
Route::get('/', function () {
    return redirect('/cartelera');
});
Route::get('/home', function () {
    return redirect('/cartelera');
});

 /**
  * Auth routes
  */
Auth::routes();
Route::get('/logout', function () {
    Auth::logout(); #Esto no deberia existir, corregir.
	return redirect('/');
});

Route::group(['middleware' => ['auth']],function(){
	Route::get('/cartelera', 'HomeController@index');

	/**
 	 * Role system Routes
	 **/
	Route::get('/roles/registrar', 'RoleController@showDataForm');
	Route::get('/roles/modificar/{id}', 'RoleController@showUpdateForm');
	Route::get('/roles/ver/{id}', 'RoleController@view');
	Route::post('/roles/modificar/{id}', 'RoleController@update');
	Route::post('/roles/registrar', 'RoleController@register');
	Route::get('/roles/listar', 'RoleController@index');
	Route::get('/roles', function(){ return redirect('/roles/listar');});

    /**
     * Tasks routes
     */
	 Route::get('/tareas/registrar', 'TaskController@showDataForm');
	 Route::get('/tareas/modificar/{id}', 'TaskController@showUpdateForm');
	 Route::post('/tareas/modificar/{id}', 'TaskController@update');
	 Route::post('/tareas/registrar', 'TaskController@register');
	 Route::get('/tareas/listar', 'TaskController@index');
	 Route::get('/tareas/todas', 'TaskController@indexAll');
	 Route::get('/tareas', function(){ return redirect('/tareas/listar');});
	 Route::get('/tareas/{id}/ver', 'TaskController@view');
	 Route::post('/tareas/tramitar', 'TaskController@transact');
	 Route::post('/tareas/eliminar', 'TaskController@delete');

	 /**
	  * Recurring Activities routes
	  */
	 Route::get('/actividadesrecurrentes/registrar', 'RecurringActivityController@showDataForm');
	 Route::get('/actividadesrecurrentes/modificar/{id}', 'RecurringActivityController@showUpdateForm');
	 Route::post('/actividadesrecurrentes/modificar/{id}', 'RecurringActivityController@update');
	 Route::post('/actividadesrecurrentes/registrar', 'RecurringActivityController@register');
	 Route::get('/actividadesrecurrentes/listar', 'RecurringActivityController@index');
	 Route::get('/actividadesrecurrentes', function(){ return redirect('/actividadesrecurrentes/listar');});
	 Route::get('/actividadesrecurrentes/{id}/ver', 'RecurringActivityController@view');
	 Route::post('/actividadesrecurrentes/eliminar', 'RecurringActivityController@delete');
	 Route::post('/actividadesrecurrentes/reactivar', 'RecurringActivityController@reactivate');
	 Route::post('/actividadesrecurrentes/desactivar', 'RecurringActivityController@desactivate');

	/**
	*Department Routes
	*/
	Route::get('/departamentos/registrar', 'DepartmentController@showDataForm');
	Route::get('/departamentos/modificar/{id}', 'DepartmentController@showUpdateForm');
	Route::post('/departamentos/modificar/{id}', 'DepartmentController@update');
	Route::post('/departamentos/registrar', 'DepartmentController@register');
	Route::get('/departamentos/listar', 'DepartmentController@index');
	Route::get('/departamentos', function(){ return redirect('/departamentos/listar');});
	Route::get('/departamentos/{id}/listado', 'DepartmentController@indexUsers');

	/**
	*User Routes
	*/
	Route::get('/usuarios/registrar', 'UserController@showDataForm');
	Route::get('/usuarios/modificar/{id}', 'UserController@showUpdateForm');
	Route::post('/usuarios/modificar/{id}', 'UserController@update');
	Route::post('/usuarios/registrar', 'UserController@register');
	Route::get('/usuarios/listar', 'UserController@index');
	Route::get('/usuarios', function(){ return redirect('/usuarios/listar');});
	Route::post('/usuarios/desactivar', 'UserController@desactivate');
	Route::post('/usuarios/eliminar', 'UserController@delete');
	Route::post('/usuarios/reactivar', 'UserController@reactivate');
	Route::get('/usuarios/perfil/{id}', 'UserController@showProfile');
	Route::post('/usuarios/actualizar-perfil', 'UserController@updateData');
	Route::post('/usuarios/actualizar-clave', 'UserController@updatePassword');

	/**
	*Calendar Routes
	*/
	Route::get('/calendario/actualizar', 'CalendarController@showDataForm');
	Route::post('/calendario/actualizar', 'CalendarController@update');
	Route::get('/calendario/ver', 'CalendarController@show');
	Route::get('/calendario/sin-datos', 'CalendarController@showNoDataInfo');
	Route::get('/calendario', function(){ return redirect('/calendario/ver');});

	/**
	*Absences Routes
	*/
	Route::get('/ausencias/registrar', 'AbsenceController@showDataForm');
	Route::get('/ausencias/modificar/{id}', 'AbsenceController@showUpdateForm');
	Route::post('/ausencias/modificar/{id}', 'AbsenceController@update');
	Route::post('/ausencias/eliminar', 'AbsenceController@delete');
	Route::get('/ausencias/{id}/ver', 'AbsenceController@view');
	Route::post('/ausencias/registrar', 'AbsenceController@register');
	Route::get('/ausencias/listar', 'AbsenceController@index');
	Route::get('/ausencias/todas', 'AbsenceController@indexAll');
	Route::get('/ausencias', function(){ return redirect('/ausencias/listar');});

	/**
	*Reports Routes
	*/
	Route::get('/reportes', 'ReportController@index');
	Route::post('/reportes/generar', 'ReportController@generate');
	Route::get('/reportes/cintillo', 'ReportController@showHeader');
	Route::post('/reportes/cintillo', 'ReportController@loadHeader');


	/**
	*Steganography Routes
	*/

	Route::get('/seguridad/elegir-imagen', 'SteganographyController@showDataForm');
	Route::post('/seguridad/elegir-imagen', 'SteganographyController@save');

	Route::get('/secureimages/base/{filename}', 'SteganographyController@loadBaseImage')->name('baseimage');
	Route::get('/secureimages/users/{filename}', 'SteganographyController@loadUserImage')->name('userimage');

});
Route::get('/acerca-de', 'HomeController@about');
