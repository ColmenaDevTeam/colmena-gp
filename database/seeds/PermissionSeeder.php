<?php

use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
		$action = array(
            array(
                'category' => 'Cartelera',
                'action' => 'Ver',
                'navigation' => false,
                'slug' => 'dashboard.view',
                'level' => 2,
            ),
            /**
            * Departments
            */
			array(
                'category' => 'Departamentos',
                'action' => 'Registrar',
				'navigation' => true,
				'slug' => 'departments.create',
				'level' => 0,
			),
			array(
                'category' => 'Departamentos',
                'action' => 'Modificar',
				'navigation' => false,
				'slug' => 'departments.update',
				'level' => 0,
			),
			array(
                'category' => 'Departamentos',
                'action' => 'Listar',
				'navigation' => true,
				'slug' => 'departments.list',
				'level' => 0,
			),
            array(
                'category' => 'Departamentos',
                'action' => 'Listar Usuarios',
                'navigation' => false,
                'slug' => 'departments.list_users',
                'level' => 0,
            ),

			array(
                'category' => 'Departamentos',
                'action' => 'Eliminar',
				'navigation' => false,
				'slug' => 'departments.delete',
				'level' => 0,
			),
            /**
            * Roles
            */
			array(
                'category' => 'Roles',
                'action' => 'Registrar',
				'navigation' => true,
				'slug' => 'roles.create',
				'level' => 0,
			),
			array(
                'category' => 'Roles',
                'action' => 'Modificar',
				'navigation' => false,
				'slug' => 'roles.update',
				'level' => 0,
			),
			array(
                'category' => 'Roles',
                'action' => 'Listar',
				'navigation' => true,
				'slug' => 'roles.list',
				'level' => 0,
			),
			array(
                'category' => 'Roles',
                'action' => 'Eliminar',
				'navigation' => false,
				'slug' => 'roles.delete',
				'level' => 0,
			),
            /**
            * Users
            */
			array(
                'category' => 'Usuarios',
                'action' => 'Registrar',
				'navigation' => true,
				'slug' => 'users.create',
				'level' => 1,
			),
            array(
                'category' => 'Usuarios',
                'action' => 'Ver',
                'navigation' => false,
                'slug' => 'users.view',
                'level' => 1,
            ),
			array(
                'category' => 'Usuarios',
                'action' => 'Modificar',
				'navigation' => false,
				'slug' => 'users.update',
				'level' => 1,
			),
			array(
                'category' => 'Usuarios',
                'action' => 'Eliminar',
				'navigation' => false,
				'slug' => 'users.delete',
				'level' => 1,
			),
			array(
                'category' => 'Usuarios',
                'action' => 'Listar',
				'navigation' => true,
				'slug' => 'users.list',
				'level' => 1,
			),
            array(
                'category' => 'Usuarios',
                'action' => 'Activar',
                'navigation' => false,
                'slug' => 'users.enable',
                'level' => 1,
            ),
            array(
                'category' => 'Usuarios',
                'action' => 'Actualizar datos',
                'navigation' => false,
                'slug' => 'users.change_data',
                'level' => 2,
            ),
            array(
                'category' => 'Usuarios',
                'action' => 'Actualizar Contraseña',
                'navigation' => false,
                'slug' => 'users.change_password',
                'level' => 2,
            ),
            /**
            * Tasks
            */
	        array(
                'category' => 'Tareas',
                'action' => 'Registrar',
                'slug' => 'tasks.create',
                'navigation' => true,
                'level' => 2,
            ),
	        array(
                'category' => 'Tareas',
                'action' => 'Modificar',
                'slug' => 'tasks.update',
                'navigation' => false,
                'level' => 2,
            ),
	        array(
                'category' => 'Tareas',
                'action' => 'Listar',
                'slug' => 'tasks.list',
                'navigation' => true,
                'level' => 2,
            ),
	        array(
                'category' => 'Tareas',
                'action' => 'Borrar',
                'slug' => 'tasks.delete',
                'navigation' => false,
                'level' => 2,
            ),
            array(
                'category' => 'Tareas',
                'action' => 'Ver Todas',
                'slug' => 'tasks.list_all',
                'navigation' => true,
                'level' => 0,
            ),
            array(
                'category' => 'Tareas',
                'action' => 'Gestionar',
                'slug' => 'tasks.transact',
                'navigation' => false,
                'level' => 2,
            ),
            array(
                'category' => 'Tareas',
                'action' => 'Ver',
                'slug' => 'tasks.view',
                'navigation' => false,
                'level' => 2,
            ),
            /**
            * Absences
            */
	        array(
                'category' => 'Ausencias',
                'action' => 'Eliminar',
                'slug' =>'absences.delete',
                'navigation' => false,
                'level' => 1,
            ),
	        array(
                'category' => 'Ausencias',
                'action' => 'Registrar',
                'slug' =>'absences.create',
                'navigation' => true,
                'level' => 1,
            ),
	        array(
                'category' => 'Ausencias',
                'action' => 'Modificar',
                'slug' =>'absences.update',
                'navigation' => false,
                'level' => 1,
            ),
	        array(
                'category' => 'Ausencias',
                'action' => 'Listar',
                'slug' =>'absences.list',
                'navigation' => true,
                'level' => 1,
            ),
            array(
                'category' => 'Ausencias',
                'action' => 'Ver Todas',
                'slug' =>'absences.list_all',
                'navigation' => true,
                'level' => 0,
            ),
            array(
                'category' => 'Ausencias',
                'action' => 'Ver',
                'slug' =>'absences.view',
                'navigation' => false,
                'level' => 2,
            ),

            /**
            * Calendar
            */
	        array(
                'category' => 'Calendario',
                'action' => 'Actualizar',
                'slug' =>'calendar.update',
                'navigation' => true,
                'level' => 0
            ),
            array(
                'category' => 'Calendario',
                'action' => 'Ver',
                'slug' =>'calendar.see',
                'navigation' => true,
                'level' => 2,
            ),

            /**
            * Recurrent activities
            */
	        array(
                'category' => 'ActividadesRecurrentes',
                'action' => 'Registrar',
                'slug' =>'recurring_activities.create',
                'navigation' => true,
                'level' => 2,
            ),
	        array(
                'category' => 'ActividadesRecurrentes',
                'action' => 'Modificar',
                'slug' =>'recurring_activities.update',
                'navigation' => false,
                'level' => 2,
            ),
	        array(
                'category' => 'ActividadesRecurrentes',
                'action' => 'Listar',
                'slug' =>'recurring_activities.list',
                'navigation' => true,
                'level' => 2,
            ),
	        array(
                'category' => 'ActividadesRecurrentes',
                'action' => 'Eliminar',
                'slug' =>'recurring_activities.delete',
                'navigation' => false,
                'level' => 2,
            ),
            array(
                'category' => 'ActividadesRecurrentes',
                'action' => 'Ver',
                'slug' =>'recurring_activities.view',
                'navigation' => false,
                'level' => 2,
            ),
            array(
                'category' => 'ActividadesRecurrentes',
                'action' => 'Activar',
                'slug' =>'recurring_activities.enable',
                'navigation' => false,
                'level' => 2,
            ),
            array(
                'category' => 'ActividadesRecurrentes',
                'action' => 'Ver Todas',
                'slug' =>'recurring_activities.list_all',
                'navigation' => true,
                'level' => 1,
            ),

            /**
            * Reports
            */
			array(
				'category' => 'Reportes',
				'action' => 'Reportes Generales',
				'slug' =>'reports.macro_report',
				'navigation' => true,
				'level' => 0,
			),
            array(
                'category' => 'Reportes',
                'action' => 'Reportes de Departamento',
                'slug' =>'reports.department_report',
                'navigation' => true,
                'level' => 1,
            ),
            array(
                'category' => 'Reportes',
                'action' => 'Reportes de Comisión',
                'slug' =>'reports.commission_report',
                'navigation' => true,
                'level' => 1,
            ),
            array(
                'category' => 'Reportes',
                'action' => 'Reportes Individuales',
                'slug' =>'reports.individual_report',
                'navigation' => true,
                'level' => 2,
            ),

            /**
            * Parameters
            */
            array(
                'category' => 'Parametros',
                'action' => 'Cintillo',
                'slug' =>'parameters.header',
                'navigation' => false,
                'level' => 0,
            ),
            array(
                'category' => 'Parametros',
                'action' => 'Logo',
                'slug' =>'parameters.logo',
                'navigation' => false,
                'level' => 0,
            ),
            array(
                'category' => 'Parametros',
                'action' => 'Color',
                'slug' =>'parameters.color',
                'navigation' => false,
                'level' => 0,
            ),
            array(
                'category' => 'Parametros',
                'action' => 'Parametrizar Sistema',
                'slug' =>'parameters.parameters',
                'navigation' => true,
                'level' => 0,
            ),
	    );
	    DB::table('permissions')->insert($action);
    }
}
