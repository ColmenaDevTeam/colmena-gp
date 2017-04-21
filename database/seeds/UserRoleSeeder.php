<?php

use Illuminate\Database\Seeder;
use App\Role;
class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        foreach (Role::all() as $role) {
			DB::table('users_has_roles') -> insert([
                'user_id' => 1,
                'role_id' => $role->id
			]);
		}
    }
}
