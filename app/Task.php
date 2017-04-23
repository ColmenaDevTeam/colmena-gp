<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Calendar;
use App\TaskLog;

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
	public static function getTasksPerDate($date){
		return self::where('estimated_date', $date)->get();
	}

	public static function getTasksPerRange($start, $end){
        $tasks = self::whereBetween('estimated_date',[$start,$end])->get();
        return $tasks;
	}

	public static function delayTasks($date){
		$tasks = self::getTasksPerDate($date);
		if (count($tasks) > 0) {
			$nextDate = Calendar::getNextWorkableDate($date);
			foreach ($tasks as $task) {
				TaskLog::generateAutoLog($task->id, false, $task->estimated_date, $nextDate);
				$task->estimated_date = $nextDate;
				$task->status = "Diferida";
				$task->save();
			}
		}
	}

	public static function countTasks(){
		return self::where('status', '<>', 'Cumplida')->where('status', '<>', 'Cancelada')
					->count();
	}

	public static function getActiveTask(){
		return self::where('status', '<>', 'Cumplida')->where('status', '<>', 'Cancelada')->get();
	}

	public function getDificultyAttribute(){
		return $this->priority + $this->complexity;
	}
	/*
}
public static function buscarFechaEst($fecha){
	$tareas = Ctarea::where('fecEst', '=', $fecha )->get();
	return $tareas;
}
	*/
}
