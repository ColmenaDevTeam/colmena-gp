<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'id', 'name', 'slug', 'level',
	];
	public function permissions(){
		return $this->belongsToMany('App\Permission', 'roles_has_permissions', 'role_id', 'permission_id');
	}
	public function users(){
		return $this->belongsToMany('App\User', 'users_has_roles', 'role_id', 'user_id');
	}
	public function scopeLevelFilter($query){
		return $query->where('level','>=' ,\Auth::user()->getAccessLevel());
	}

	public function permissionsByCategory(){
        $all = $this->permissions;
        $permissions = array();
        foreach ($all as $p){
            if(array_key_exists($p->category, $permissions)){
                $permissions[$p->category][] = $p;
            }else{
                $permissions[$p->category] = array();
                $permissions[$p->category][] = $p;
            }
        }
        return $permissions;
	}

	public static function getRolesByLevel(){
		return self::select()->levelFilter()->get();
	}
}
