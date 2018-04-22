<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Faker\Factory as Faker;

class TasksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      if (env('APP_ENV') == 'local') {
	    $users_id = DB::table('users')->select('id')->where('id','>',1)->get()->toArray();
	    $faker = Faker::create();
	    $tasks_types = ['Academico-Docente','Administrativas','Creacion-Intelectual','Integracion-Social','Administrativo-Docente','Produccion'];
	    $statuses = ['Asignada','Revision','Cumplida','Cancelada','Diferida','Retardada'];

        for ($i=0; $i < 30; $i++) {
          DB::table('tasks') -> insert([
            'title'=>$faker->name,
            'estimated_date' => Carbon::now()->addDays(array_rand([1,2,3,4,5,6])),
            'details'=> $faker->text,
            'priority'=> array_rand([1,2,3]),
            'complexity'=> array_rand([1,2,3]),
            'creator_id'=> 1,
            'type'=> $tasks_types[array_rand($tasks_types)]
          ]);
          $val = rand(1,9);
          
          for ($j=0; $j <= $val; $j++) { 
          	$user_id = $users_id[array_rand($users_id)]->id;

          	DB::table('users_has_tasks') -> insert ([
          		'status' => $statuses[array_rand($statuses)],
          		'deliver_date' => Carbon::now(),
          		'user_id' => $user_id,
          		'task_id' => $i+1,
          		'details' => json_encode(['user' => $faker->name, 'messsage' => $faker->text, 'old' => $statuses[array_rand($statuses)], 'date' => date('Y-m-d') ])
          	]);
          }
        }
      }
    }
}