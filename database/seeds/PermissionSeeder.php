<?php

use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$action = array(
			array('name' => 'Registrar Departamentos',
				'navigation' => true,
				'slug' => 'departamentos.registrar',
				'level' => 3
			),

			array('name' => 'Modificar Departamentos',
				'navigation' => false,
				'slug' => 'departamentos.modificar',
				'level' => 3
			),
			array('name' => 'Listar Departamentos',
				'navigation' => true,
				'slug' => 'departamentos.listar',
				'level' => 3
			),
			array('name' => 'Eliminar Departamentos',
				'navigation' => false,
				'slug' => 'departamentos.listar',
				'level' => 3
			),
			array('name' => 'Registrar Roles',
				'navigation' => true,
				'slug' => 'roles.registrar',
				'level' => 3
			),

			array('name' => 'Modificar Roles',
				'navigation' => false,
				'slug' => 'roles.modificar',
				'level' => 3
			),
			array('name' => 'Listar Roles',
				'navigation' => true,
				'slug' => 'roles.listar',
				'level' => 3
			),
			array('name' => 'Eliminar Roles',
				'navigation' => false,
				'slug' => 'roles.listar',
				'level' => 3
			),
			array('name' => 'Registrar Usuarios',
				'navigation' => true,
				'slug' => 'usuarios.registrar',
				'level' => 2
			),
			array('name' => 'Registrar Usuarios',
				'navigation' => true,
				'slug' => 'usuarios.registrar',
				'level' => 2
			),
			array('name' => 'Modificar Usuarios',
				'navigation' => false,
				'slug' => 'usuarios.modificar',
				'level' => 2
			),
			array('name' => 'Eliminar Usuarios',
				'navigation' => false,
				'slug' => 'usuarios.eliminar',
				'level' => 2
			),
			array('name' => 'Listar Usuarios',
				'navigation' => true,
				'slug' => 'usuarios.listar',
				'level' => 2
			),

	        array('name' => 'tasks.register', 'navigation' => true),
	        array('name' => 'tasks.update', 'navigation' => false),
	        array('name' => 'tasks.list', 'navigation' => true),
	        array('name' => 'tasks.delete', 'navigation' => false),


	        array('name' => 'absences.delete', 'navigation' => false),
	        array('name' => 'absences.register', 'navigation' => true),
	        array('name' => 'absences.update', 'navigation' => false),
	        array('name' => 'absences.list', 'navigation' => true),

	        //Desde la version 0.5.0A
	        array('name' => 'calendar.update', 'navigation' => true),

	        //Desde la version 0.6.0A
	        array('name' => 'recurring_activities.register', 'navigation' => true),
	        array('name' => 'recurring_activities.update', 'navigation' => false),
	        array('name' => 'recurring_activities.list', 'navigation' => true),
	        array('name' => 'recurring_activities.delete', 'navigation' => false),
	        );
	    DB::table('permissions')->insert($action);
    }
}
