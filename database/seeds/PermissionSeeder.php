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
                'category' => 'Departamentos',
                'action' => 'Registrar',
				'navigation' => true,
				'slug' => 'departaments.create',
				'level' => 0,
			),

			array(
                'category' => 'Departamentos',
                'action' => 'Modificar',
				'navigation' => false,
				'slug' => 'departaments.update',
				'level' => 0,
			),
			array(
                'category' => 'Departamentos',
                'action' => 'Listar',
				'navigation' => true,
				'slug' => 'departaments.list',
				'level' => 0,
			),
			array(
                'category' => 'Departamentos',
                'action' => 'Eliminar',
				'navigation' => false,
				'slug' => 'departaments.delete',
				'level' => 0,
			),
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
			array(
                'category' => 'Usuarios',
                'action' => 'Registrar',
				'navigation' => true,
				'slug' => 'users.create',
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
                'category' => 'Tareas',
                'action' => 'Registrar',
                'slug' => 'tasks.create',
                'navigation' => true,
                'level' => 1,
            ),
	        array(
                'category' => 'Tareas',
                'action' => 'Modificar',
                'slug' => 'tasks.update',
                'navigation' => false,
                'level' => 1,
            ),
	        array(
                'category' => 'Tareas',
                'action' => 'Listar',
                'slug' => 'tasks.list',
                'navigation' => true,
                'level' => 1,
            ),
	        array(
                'category' => 'Tareas',
                'action' => 'Borrar',
                'slug' => 'tasks.delete',
                'navigation' => false,
                'level' => 1,
            ),
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

	        //Desde la version 0.5.0A
	        array(
                'category' => 'Calendario',
                'action' => 'Editar',
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

	        //Desde la version 0.6.0A
	        array(
                'category' => 'Actividades Recurrentes',
                'action' => 'Registrar',
                'slug' =>'recurring_activities.create',
                'navigation' => true,
                'level' => 1,
            ),
	        array(
                'category' => 'Actividades Recurrentes',
                'action' => 'Modificar',
                'slug' =>'recurring_activities.update',
                'navigation' => false,
                'level' => 1,
            ),
	        array(
                'category' => 'Actividades Recurrentes',
                'action' => 'Listar',
                'slug' =>'recurring_activities.list',
                'navigation' => true,
                'level' => 1,
            ),
	        array(
                'category' => 'Actividades Recurrentes',
                'action' => 'Eliminar',
                'slug' =>'recurring_activities.delete',
                'navigation' => false,
                'level' => 1,
            )
	    );
	    DB::table('permissions')->insert($action);
    }
}
