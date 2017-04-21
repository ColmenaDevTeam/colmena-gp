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
	dd(App\Calendar::checkYear());
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
	Route::get('/roles/editar/{id}', 'RoleController@showUpdateForm');
	Route::post('/roles/editar/{id}', 'RoleController@update');
	Route::post('/roles/registrar', 'RoleController@register');
	Route::get('/roles/listar', 'RoleController@index');
	Route::get('/roles', function(){ return redirect('/roles/listar');});

    /**
     * Tasks routes
     */
	 Route::get('/tareas/registrar', 'TaskController@showDataForm');
	 Route::get('/tareas/editar/{id}', 'TaskController@showUpdateForm');
	 Route::post('/tareas/editar/{id}', 'TaskController@update');
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
	 Route::get('/actividades-recurrentes/registrar', 'RecurringActivityController@showDataForm');
	 Route::get('/actividades-recurrentes/editar/{id}', 'RecurringActivityController@showUpdateForm');
	 Route::post('/actividades-recurrentes/editar/{id}', 'RecurringActivityController@update');
	 Route::post('/actividades-recurrentes/registrar', 'RecurringActivityController@register');
	 Route::get('/actividades-recurrentes/listar', 'RecurringActivityController@index');
	 Route::get('/actividades-recurrentes', function(){ return redirect('/actividades-recurrentes/listar');});
	 Route::get('/actividades-recurrentes/{id}/ver', 'RecurringActivityController@view');
	 Route::post('/actividades-recurrentes/eliminar', 'RecurringActivityController@delete');

	/**
	*Department Routes
	*/
	Route::get('/departamentos/registrar', 'DepartmentController@showDataForm');
	Route::get('/departamentos/editar/{id}', 'DepartmentController@showUpdateForm');
	Route::post('/departamentos/editar/{id}', 'DepartmentController@update');
	Route::post('/departamentos/registrar', 'DepartmentController@register');
	Route::get('/departamentos/listar', 'DepartmentController@index');
	Route::get('/departamentos', function(){ return redirect('/departamentos/listar');});
	Route::get('/departamentos/{id}/listado', 'DepartmentController@indexUsers');

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
	Route::get('/ausencias/editar/{id}', 'AbsenceController@showUpdateForm');
	Route::post('/ausencias/editar/{id}', 'AbsenceController@update');
	Route::post('/ausencias/eliminar', 'AbsenceController@delete');
	Route::get('/ausencias/{id}/ver', 'AbsenceController@view');
	Route::post('/ausencias/registrar', 'AbsenceController@register');
	Route::get('/ausencias/listar', 'AbsenceController@index');
	Route::get('/ausencias/todas', 'AbsenceController@indexAll');
	Route::get('/ausencias', function(){ return redirect('/ausencias/listar');});

});
Route::get('/acerca-de', 'HomeController@about');
