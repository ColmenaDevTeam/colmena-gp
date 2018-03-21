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

	public function scopeLevelFilter($query){
		return $query->where('level','>=' ,\Auth::user()->getAccessLevel());
	}

	public static function getByCategory(){
		$all = self::select()->levelFilter()->get();
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

	public function getUrlAttribute(){
		return url(strtolower($this->category).'/'.strtolower($this->action));
	}
}
