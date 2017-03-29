<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$roles = array(
			array('name' => 'Root',
				'slug' => 'root',
				'level' => 3,
			),
            array('name' => 'Administrador',
				'slug' => 'administrador',
				'level' => 2,
			),
			array('name' => 'Jefe de Departamento',
				'slug' => 'jefe_departamento',
				'level' => 2,
			),
			array('name' => 'Asistente Administrativo',
				'slug' => 'asistente',
				'level' => 2,
			),
			array('name' => 'Jefe de Comisión',
				'slug' => 'jefe_comision',
				'level' => 1,
			),
			array('name' => 'Docente',
				'slug' => 'docente',
				'level' => 0,
			),
            array('name' => 'Jefe de Departamento'),
            array('name' => 'Asis Administrativo'),
            array('name' => 'Docente')
            );
        DB::table('roles')->insert($roles);
    }
}

/*
$table->increments('id');
$table->string('name',45)->unique();
$table->string('slug',45)->unique();
$table->boolean('navigation')->default(false);
$table->integer('level');

*/
