<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'id', 'category', 'action', 'slug', 'navigation', 'level',
	];
	public function roles(){
		return $this->belongsToMany('App\Role', 'roles_has_permissions', 'role_id', 'permission_id');
	}

	public static function whereSlug($slug){
		$permission = self::where('slug', $slug)->first();
		return $permission;
	}

	public function scopeLevelFilter(){
		
	}

	public static function getByCategory(){
		$all = self::all();
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
}
