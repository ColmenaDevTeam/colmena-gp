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
		return $this->hasMany('App\Permission',);
	}
	public function users(){

	}
}
