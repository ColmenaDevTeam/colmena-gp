<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Absence extends Model
{
	const MAX_PASSED_DAYS = 7;

	protected $dates = ['start_date', 'end_date'];
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'type', 'start_date', 'end_date', 'details'
	];

	public function user(){
		return $this->belongsTo('App\User', 'user_id');
	}

	public static function countActiveAbsences(){
		return self::where('start_date', '<=', date('Y-m-d'))
					->where('end_date', '>=', date('Y-m-d'))->count();
	}
}
