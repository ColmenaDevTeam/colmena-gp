<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'workable_date'
	];

	public $timestamps = false;

    protected $table = 'calendar';

}
