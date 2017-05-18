<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class TaskLog extends Model
{
	protected $fillable = [
		'status','user','detail'
	];
	const CALENDAR_DELAY = 'Diferida por cambio en el calendario de ';
	const ABSENCE_DELAY = 'Diferida por registro de ausencia de ';
	const AFTER_DATE = ' hacia ';


	public function task(){
		return $this->belongsTo('App\Task', 'task_id');
	}

	public static function generateAutoLog($task_id, bool $reason, $oldDate, $newDate){
		$log = new TaskLog;
		$log->status = 'Diferida';
		$log->detail = $reason ? self::ABSENCE_DELAY.$oldDate.self::AFTER_DATE.$newDate : self::CALENDAR_DELAY.$oldDate.self::AFTER_DATE.$newDate;
		$log->user = User::first()->id;
		$log->task_id = $task_id;
		$log->save();
	}
}
