<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$faker = Faker::create();
	    DB::table('users') -> insert([
        'cedula'=>env('APP_DEV_USERNAME', 'colmenadevteam'),
        'firstname'=>'Colmena',
        'lastname'=>'Dev Team',
        'user_type'=>'Administrativo',
        'email'=>'devteam@colmena.uptaeb.edu.ve',
        'password'=>Hash::make("0000"),
        'phone'=>$faker->randomNumber(8),
        'birthdate'=>$faker->unique()->date($format = 'Y-m-d', $max = 'now'),
        'gender'=>$faker->boolean(TRUE),
		'active' => true,
		'department_id' => 1,
        'created_at'=>Carbon::now(),
        'updated_at'=>Carbon::now()
    	]);
		for ($i=0; $i < 30; $i++) {
			DB::table('users') -> insert([
				'cedula'=>$faker->randomNumber(8),
				'firstname'=>$faker->name,
				'lastname'=>$faker->name,
				'user_type'=>'Administrativo',
				'email'=>$faker->email,
				'password'=>Hash::make("0000"),
				'phone'=>$faker->randomNumber(8),
				'birthdate'=>$faker->unique()->date($format = 'Y-m-d', $max = 'now'),
				'gender'=>$faker->boolean(),
				'department_id' => 1,
				'created_at'=>Carbon::now(),
				'updated_at'=>Carbon::now()
			]);
		}

    }
}
