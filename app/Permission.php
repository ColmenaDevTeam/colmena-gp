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
		return $this->belongsToMany('App\Role', 'roles_has_permissions', 'permission_id', 'role_id');
	}
}
