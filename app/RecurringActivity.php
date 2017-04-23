<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RecurringActivity extends Model
{
	use EnumHelper;
	
    protected $table = "recurring_activities";

	public function users(){
		return $this->belongsToMany('App\User', 'users_has_recurring_activities', 'recurring_activity_id', 'user_id');
	}
}
