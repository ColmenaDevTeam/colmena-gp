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
 * Misc routes
 */
Route::get('/calendario/sin-datos', 'CalendarController@showNoDataInfo');
Route::get('/acerca-de', 'HomeController@about');

 /**
  * Auth routes
  */
Auth::routes();
Route::get('/logout', function () {
    Auth::logout(); #Logout
	return redirect('/');
});

Route::group(['middleware' => ['auth', 'rbac']],function(){
	/**
 	 * Dashboard Routes
	 **/
	Route::get('/cartelera', 'HomeController@index')->name('dashboard.view');

	/**
 	 * Role system Routes
	 **/
	Route::group(['prefix' => '/roles'], function(){

		Route::get('/registrar', 'RoleController@showDataForm')->name('roles.create');
		Route::post('/registrar', 'RoleController@register')->name('roles.create');
		Route::get('/modificar/{id}', 'RoleController@showUpdateForm')->name('roles.update');
		Route::post('/modificar/{id}', 'RoleController@update')->name('roles.update');
		Route::get('/ver/{id}', 'RoleController@view')->name('roles.list');
		Route::get('/listar', 'RoleController@index')->name('roles.list');
		Route::get('/', function(){ return redirect('/roles/listar');})->name('roles.list');
		Route::post('/eliminar', 'RoleController@delete')->name('role.delete');
	});

    /**
     * Tasks routes
     */
	 Route::group(['prefix' => '/tareas'], function(){
		 Route::get('/registrar', 'TaskController@showDataForm')->name('tasks.create');
		 Route::post('/registrar', 'TaskController@register')->name('tasks.create');
		 Route::get('/modificar/{id}', 'TaskController@showUpdateForm')->name('tasks.update');
		 Route::post('/modificar/{id}', 'TaskController@update')->name('tasks.update');
		 Route::get('/listar', 'TaskController@index')->name('tasks.list');
		 Route::get('/todas', 'TaskController@indexAll')->name('tasks.list_all');
		 Route::get('/', function(){ return redirect('/tareas/listar');})->name('tasks.list');
		 Route::get('/{id}/ver', 'TaskController@view')->name('tasks.view');
		 Route::get('/transacciones', 'TaskController@getLogs')->name('tasks.view');
		 Route::post('/tramitar', 'TaskController@transact')->name('tasks.transact');
		 Route::post('/eliminar', 'TaskController@delete')->name('tasks.delete');
	 });
	 /**
	  * Recurring Activities routes
	  */
	 Route::group(['prefix' => '/actividades-recurrentes'], function(){
		 Route::get('/registrar', 'RecurringActivityController@showDataForm')->name('recurring_activities.create');
		 Route::post('/registrar', 'RecurringActivityController@register')->name('recurring_activities.create');
		 Route::get('/modificar/{id}', 'RecurringActivityController@showUpdateForm')->name('recurring_activities.update');
		 Route::post('/modificar/{id}', 'RecurringActivityController@update')->name('recurring_activities.update');
		 Route::get('/listar', 'RecurringActivityController@index')->name('recurring_activities.list');
		 Route::get('/todas', 'RecurringActivityController@indexAll')->name('recurring_activities.list_all');
		 Route::get('/', function(){ return redirect('/actividades-recurrentes/listar');})->name('recurring_activities.list');
		 Route::get('/{id}/ver', 'RecurringActivityController@view')->name('recurring_activities.view');
		 Route::post('/eliminar', 'RecurringActivityController@delete')->name('recurring_activities.delete');
		 Route::post('/reactivar', 'RecurringActivityController@reactivate')->name('recurring_activities.enable');
		 Route::post('/desactivar', 'RecurringActivityController@desactivate')->name('recurring_activities.enable');
	 });
	/**
	*Department Routes
	*/
	 Route::group(['prefix' => '/departamentos'], function(){
		Route::get('/registrar', 'DepartmentController@showDataForm')->name('departments.create');
		Route::post('/registrar', 'DepartmentController@register')->name('departments.create');
		Route::get('/modificar/{id}', 'DepartmentController@showUpdateForm')->name('departments.update');
		Route::post('/modificar/{id}', 'DepartmentController@update')->name('departments.update');
		Route::get('/listar', 'DepartmentController@index')->name('departments.list');
		Route::get('/', function(){ return redirect('/departamentos/listar');})->name('departments.list');
		Route::get('/{id}/listado', 'DepartmentController@indexUsers')->name('departments.list_users');
	 });

	/**
	*User Routes
	*/
	 Route::group(['prefix' => '/usuarios'], function(){
		Route::get('/registrar', 'UserController@showDataForm')->name('users.create');
		Route::post('/registrar', 'UserController@register')->name('users.create');
		Route::get('/modificar/{id}', 'UserController@showUpdateForm')->name('users.update');
		Route::post('/modificar/{id}', 'UserController@update')->name('users.update');
		Route::get('/listar', 'UserController@index')->name('users.list');
		Route::get('', function(){ return redirect('/usuarios/listar');})->name('users.list');
		Route::post('/desactivar', 'UserController@desactivate')->name('users.enable');
		Route::post('/reactivar', 'UserController@reactivate')->name('users.enable');
		Route::post('/eliminar', 'UserController@delete')->name('users.delete');
		Route::get('/perfil/{id}', 'UserController@showProfile')->name('users.view');
		Route::post('/actualizar-perfil', 'UserController@updateData')->middleware('sensitive')->name('users.change_data');
		Route::post('/actualizar-clave', 'UserController@updatePassword')->middleware('sensitive')->name('users.change_password');
	 });
	/**
	*Calendar Routes
	*/
	 Route::group(['prefix' => '/calendario'], function(){
		Route::get('/actualizar', 'CalendarController@showDataForm')->name('calendar.update');
		Route::post('/actualizar', 'CalendarController@update')->name('calendar.update');
		Route::get('/ver', 'CalendarController@show')->name('calendar.view');
		Route::get('/', function(){ return redirect('/calendario/ver');})->name('calendar.view');
	 });

	/**
	*Absences Routes
	*/
	 Route::group(['prefix' => '/ausencias'], function(){
		Route::get('/registrar', 'AbsenceController@showDataForm')->name('absences.create');
		Route::post('/registrar', 'AbsenceController@register')->name('absences.create');
		Route::get('/modificar/{id}', 'AbsenceController@showUpdateForm')->name('absences.update');
		Route::post('/modificar/{id}', 'AbsenceController@update')->name('absences.update');
		Route::post('/eliminar', 'AbsenceController@delete')->name('absences.delete');
		Route::get('/{id}/ver', 'AbsenceController@view')->name('absences.view');
		Route::get('/listar', 'AbsenceController@index')->name('absences.list');
		Route::get('/todas', 'AbsenceController@indexAll')->name('absences.list_all');
		Route::get('/', function(){ return redirect('/ausencias/listar');})->name('absences.list');
	 });

	/**
	*Reports Routes
	*/
	 Route::group(['prefix' => '/reportes'], function(){
		Route::get('/', 'ReportController@index')->name('reports.index');
		Route::post('/generar', 'ReportController@generate')->name('reports.generate');
		Route::get('/cintillo', 'ReportController@showHeader')->name('reports.header');
		Route::post('/cintillo', 'ReportController@loadHeader')->name('reports.header');
	 });

	/**
	*Steganography Routes
	*/

	Route::get('/seguridad/elegir-imagen', 'SteganographyController@showDataForm');
	Route::post('/seguridad/elegir-imagen', 'SteganographyController@save');

	Route::get('/seguridad/ver-contenido', 'SteganographyController@test');

	Route::get('/secureimages/base/{filename}', 'SteganographyController@loadBaseImage')->name('baseimage');
	Route::get('/secureimages/users/{filename}', 'SteganographyController@loadUserImage')->name('userimage');
});

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
