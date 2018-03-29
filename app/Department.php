<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name', 'description'
	];

	public $timestamps = false;

	public function users(){
		return $this->hasMany('App\User', 'department_id');
	}

	public function tasks(){
		return $this->hasManyThrough('App\Task', 'App\User', 'department_id', 'creator_id', 'id', 'id');
	}

	public function absences(){
		return $this->hasManyThrough('App\Absence', 'App\User');
	}
}
