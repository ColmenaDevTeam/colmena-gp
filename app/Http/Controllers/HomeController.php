<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\Absence;
use App\User;
use App\Department;
use \Auth;
use Carbon\Carbon;

class HomeController extends Controller{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
		date_default_timezone_set('America/Caracas');
		$hotToday = [];
		$pending = [];

		$birthdayPpl = User::birthdates();
	#	$tasks = Task::where('user_id', Auth::user()->id)->get();
		$absences = Absence::where('user_id', Auth::user()->id)->get();
	#	if(Auth::user()->canDo('tasks.list'))
		#	$tasks = Auth::user()->department->tasks;
		if(Auth::user()->canDo('absences.list'))
			$absences = Auth::user()->department->absences;
		$i = 0;
        /*
		foreach($tasks as $task){
			if($task->status != 'Cumplida' && $task->status != 'Cancelada'){
				$task->itemKind = 'tareas';
				$task->idTag = 'Tarea'.$i;
				$totalDays = $task->created_at->diffInDays($task->estimated_date);
				$passedDays = $task->created_at->diffInDays(Carbon::now());
				$task->percent = 0;
				if($passedDays > 0 && $totalDays > 0)
					$task->percent = ($passedDays*100)/$totalDays;
				//$task->percent = $percent;
				if($task->estimated_date->isPast() || $task->estimated_date->isToday())
					$task->percent = 100;
				if($task->percent > 0 && $task->percent < 40)
					$task->cssStatus = 'progress-bar-success';
				elseif($task->percent >= 40 && $task->percent < 80)
					$task->cssStatus = 'progress-bar-warning';
				elseif($task->percent >= 80)
					$task->cssStatus = 'progress-bar-danger';
				$pending[] = $task;
				$i++;
			}
		}*/
        $tasks = null;
		$i = 0;
		foreach($absences as $absence){
			$absence->itemKind = 'ausencias';
			if($absence->PerRep)
				$absence->idTag = "Permiso".$i;
			else
				$absence->idTag = "Repeposo".$i;
			#$absence->user = User::findOrFail($absence->user_id);

			#$fechaInicio = Carbon::createFromFormat('Y-m-d', $absence->fecIni, 'America/Caracas');
			#$fechaFin = Carbon::createFromFormat('Y-m-d', $absence->fecFin, 'America/Caracas');
			if($absence->start_date->isPast() || $absence->end_date->isToday())
				continue;
			$totalDays = $absence->start_date->diffInDays($absence->end_date);

			$passedDays = $absence->start_date->diffInDays(Carbon::now());
			$percent = 0;
			if($passedDays > 0 && $totalDays > 0)
				$percent = ($passedDays*100)/$totalDays;
			$absence->percent = $percent;
			if($absence->end_date->isPast() || $absence->end_date->isToday())
				$absence->percent = 100;
			//$absence->estadoCss = 'progress-bar-info';
			$pending[] = $absence;
			$i++;
		}
		foreach($birthdayPpl as $cumpleaniero){
			$cumpleaniero->itemKind = "cumpleanios";
			$cumpleaniero->idTag = "Cumple".$i;
			$pending[] = $cumpleaniero;
		}
		$itemKinds = ["tareas", "cumpleanios", "ausencias"];
		$cssClassPerKind['tareas'] = "list-group-item-info";
		$cssClassPerKind['cumpleanios'] = "list-group-item-success";
		$cssClassPerKind['ausencias'] = "list-group-item-warning";

		foreach($pending as $pen){
			$fechaHoy = getdate();
			if($pen->itemKind == 'cumpleanios'){
					$hotToday[] = $pen;
			}
			elseif($pen->itemKind == 'tareas'){
				if($pen->estimated_date->isToday())
					$hotToday[] = $pen;
			}
			elseif($pen->itemKind == 'ausencias'){
				if($pen->isActive())
					$hotToday[] = $pen;
			}
		}
        return view('modules.dashboard.index')->with(['tasksCount' => /*Task::countTasks()*/5, 'absencesCount' => Absence::countActiveAbsences(),
													'birthdates' => User::birthdatesCount(), 'usersCount' => User::usersCount(),
													'itemKinds' => $itemKinds, 'hotToday' => $hotToday, 'cssClassPerKind' => $cssClassPerKind,
													'pending' => $pending
												]);

	}

	/**
	 * Show the application 'about us'.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function about(){
		return view('about_us');
	}
}
