<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model{
	use EnumHelper;

	const DEFAULT_STATUS = 'Asignada';

	protected $dates = ['estimated_date', 'deliver_date'];

	protected $fillable = [
        'title','estimated_date','deliver_date','details','priority',
        'complexity', 'type', 'seen', 'status'
	];

    public function responsible(){
        return $this->belongsTo('App\User', 'user_id');
    }

	public function taskLogs(){
		return $this->hasMany('App\TaskLog', 'task_id');
	}

	public function lastLog(){
		return $this->taskLogs()->orderBy('created_at', 'desc')->take(1)->first();
	}
	public static function getTasksPerDay(){

	}
	
	public static function delayTasks(){

	}
}
