<?php

use Illuminate\Database\Seeder;

class MinningSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
          $table->integer('task_estimated_date')->nullable(); (Ya)
          $table->integer('task_deliver_date')->nullable(); (YA)
          $table->integer('task_status')->nullable(); (Ya)
          $table->integer('task_type')->nullable(); (Ya)
          $table->integer('task_priority')->nullable(); (Ya)
          $table->integer('task_complexity')->nullable(); (Ya)
          $table->integer('department_id')->nullable();
          $table->integer('absence_type')->nullable();
          $table->integer('user_type')->nullable();
        */
       	$action = array(
       		array(
       			'name' => 'Fecha estimada de entrega',
       			'sql_name' => 'tasks.estimated_date',
       			'sql_table' => 'tasks',
       			'sql_query' => null
       		),
       		array(
       			'name' => 'Fecha de entrega',
       			'sql_name' => 'users_has_tasks.deliver_date',
       			'sql_table' => 'users_has_tasks',
       			'sql_query' => null
       		),
       		array(
      			'name' => 'Estado de tarea',
       			'sql_name' => 'users_has_tasks.status',
       			'sql_table' => 'users_has_tasks',
       			'sql_query' => null
       		),
       		array(
       			'name' => 'Tipo de tarea',
       			'sql_name' => 'tasks.type',
       			'sql_table' => 'tasks',
       			'sql_query' => null
       		),
       		array(
       			'name' => 'Prioridad de tarea',
       			'sql_name' => 'tasks.priority',
       			'sql_table' => 'tasks',
       			'sql_query' => null
       		),
       		array(
       			'name' => 'Complejidad de tarea',
       			'sql_name' => 'tasks.complexity',
       			'sql_table' => 'tasks',
       			'sql_query' => null
       		),
       		array(
       			'name' => 'Tipo de ausencia',
       			'sql_name' => 'absences.type',
       			'sql_table' => 'absences',
       			'sql_query' => null
       		),
       		array(
       			'name' => 'Tipo de Usuario',
       			'sql_name' => 'users.user_type',
       			'sql_table' => 'users',
       			'sql_query' => null
       		),
       	);

		DB::table('data_minning_variables') -> insert($action);
    }
}
