<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
		$this->call(DepartmentSeeder::class);

        $this->call(PermissionSeeder::class);
		$this->call(RoleSeeder::class);
        $this->call(RolePermissionsSeeder::class);

        $this->call(UserSeeder::class);
        $this->call(UserRoleSeeder::class);
    }
}
