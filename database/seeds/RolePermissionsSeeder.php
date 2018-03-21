<?php

use Illuminate\Database\Seeder;
use App\Permission;
class RolePermissionsSeeder extends Seeder{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        /*
        $action = array(
            array(
                'role_id' => 1,
                'permission_id' => 1
            ),
        );
        DB::table('roles_has_permissions')->insert($action);*/
        foreach (Permission::all() as $p) {
			DB::table('roles_has_permissions') -> insert([
                'role_id' => 1,
                'permission_id' => $p->id
			]);
		}
    }
}
