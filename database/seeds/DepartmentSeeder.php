<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Faker\Factory as Faker;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$faker = Faker::create();
		DB::table('departments') -> insert([
        'name'=>'Departamento del Programa Nacional de formacion en Informatica',
        'description'=>$faker->text,
    	]);

		for ($i=0; $i < 30; $i++) {
			DB::table('departments') -> insert([
			'name'=>$faker->name,
			'description'=> $faker->text,
			]);
		}
    }
}
