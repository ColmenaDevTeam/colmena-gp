<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Task;
class RecurringActivity extends Model
{
	use EnumHelper;

    protected $table = "recurring_activities";

	public function users(){
		return $this->belongsToMany('App\User', 'users_has_recurring_activities', 'recurring_activity_id', 'user_id');
	}
	public function getDificultyAttribute(){
		return $this->priority + $this->complexity;
	}

	public static function getActiveActivities(){
		return self::where('active', true)->get();
	}

	public static function deployActivities(){
		$activities = self::getActiveActivities();
		foreach ($activities as $activity) {
			Task::generateTasks($activity);
		}
	}
}
