<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskLog extends Model
{
	protected $fillable = [
		'status','user','detail'
	];
	const CALENDAR_DELAY = 'Diferida por cambio en el calendario a la fecha ';
	const ABSENCE_DELAY = 'Diferida por registro de ausencia a la fecha ';

	public function task(){
		return $this->belongsTo('App\Task', 'task_id');
	}

	public static function generateAutoLog($task_id, bool $reason, $newDate){
		$log = new TaskLog;
		$log->status = 'Diferida';
		$log->detail = $reason ? self::ABSENCE_DELAY.$newDate : self::CALENDAR_DELAY.$newDate;
		$log->user = env('APP_NAME');
		$log->task_id = $task_id;
		$log->save();
	}
}
