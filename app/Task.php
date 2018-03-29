<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Calendar;
use App\TaskLog;
use App\Notifications\NewTaskAssignment;
use App\Notifications\CalendarTasksDelay;
use App\Notifications\AbsenceTasksDelay;
use App\Notifications\DelayedTask;

class Task extends Model{
	protected $dates = ['estimated_date'];

	protected $fillable = [
        'title','estimated_date','details','priority',
        'complexity', 'type'
	];

    public function responsibles(){
        return $this->belongsToMany('App\User', 'users_has_tasks', 'task_id', 'user_id');
    }

	public function creator(){
        return $this->belongsTo('App\User', 'creator_id');
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
				try {
					$task->generateCalendarDelayNotification();

				} catch (\Exception $e) {

				}

			}
		}
	}

	public static function countTasks(){
		return self::where('status', '<>', 'Cumplida')->where('status', '<>', 'Cancelada')
					->count();
	}

	public function getDificultyAttribute(){
		return $this->priority + $this->complexity;
	}

	public static function checkTasks(){
		$tasks = self::where('status', '<>', 'Cumplida')->where('status', '<>', 'Cancelada')
						->where('status', '<>', 'Retardada')->where('estimated_date', '<', date('Y-m-d'))->get();
		foreach ($tasks as $task) {
			$task->status = 'Retardada';
			$task->save();
			try {
				$task->generateDelayedTaskNotification();

			} catch (\Exception $e) {

			}

		}
	}

	public static function generateTasks($activity){
		$date = Calendar::getNextWorkableDate(Carbon::now()->addDays($activity->deliverer_days-1)->toDateString());
		if (is_null($date)) {
			$activity->active = false;
			$active->save();
			return ;
		}
		else {
			foreach ($activity->users as $user){
				$task = new Task;
				$task->title = $activity->title;
				$task->estimated_date = $date;
				$task->details  = $activity->details ;
				$task->priority  = $activity->priority ;
				$task->complexity  = $activity->complexity ;
				$task->status  = 'Asignada' ;
				$task->type  = $activity->task_type ;
				$task->responsible()->associate($user);
				$task->save();
				try {
					$task->generateNotification();

				} catch (\Exception $e) {

				}

				$activity->last_launch = date('Y-m-d');
				$active->save();
				#notifyUser
			return ;
			}
		}
	}
	public function generateNotification(){
		$this->responsible->notify(new NewTaskAssignment($this));
	}

	public function generateCalendarDelayNotification(){
		$this->responsible->notify(new CalendarTasksDelay($this));
	}

	public function generateAbsenceDelayNotification(){
		$this->responsible->notify(new AbsenceTasksDelay($this));
	}

	public function generateDelayedTaskNotification(){
		$this->responsible->notify(new DelayedTask($this));
	}
}
