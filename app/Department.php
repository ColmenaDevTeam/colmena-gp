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
}
