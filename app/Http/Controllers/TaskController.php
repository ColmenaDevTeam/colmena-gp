<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use Carbon\Carbon;
use App\User;
use App\Calendar;
use App\Absence;
use Validator;
use App\TaskLog;
use Illuminate\Pagination\LengthAwarePaginator;
use \Auth;

class TaskController extends Controller{
	public function index(){
#		return view('modules.tasks.list')->with(['tasks' => Task::getActiveTask()]);
		return view('modules.tasks.list');
	}

	public function showDataForm(){

		if (!Calendar::checkAvailability()) {
			return redirect('/calendario/sin-datos');
		}
		return view('modules.tasks.forms.data-form')->with(['users' => User::getUsersByOcupation(),
															'types' => Task::getEnumValues('type'),
															'dates' => Calendar::getAbleWorkableDates()]);
	}

	public function register(Request $request){
		Validator::make($request->input(), [
			'title' => 'required',
			'priority' => 'required',
			'complexity' => 'required',
			'type' => 'required',
			'estimated_date' => 'required|date_format:Y-m-d|after:yesterday',#Aqui verificacion de calendario
			'users' => 'required',
			'details' => 'min:10'
		])->validate();

		$task = new task();
		$task->title = $request->title;
		$task->priority = $request->priority;
		$task->complexity = $request->complexity;
		$task->type = $request->type;
		$task->estimated_date = Carbon::createFromFormat('Y-m-d',$request->estimated_date);
		$task->details = $request->details;
		$task->creator_id = Auth::user()->id;
		$task->save();
		$task->responsibles()->sync($request->users);
		/**
		try {
			$task->generateNotification();

		} catch (\Exception $e) {

		}
			// ¡Notificación a base de dato y a mail!
		*/
		\Session::push('success', true);
		return redirect("tareas/listar");
	}

	public function showUpdateForm(Request $request){
		$task = Task::find($request->id);
		if (!$task) return redirect('/404');
		//verificacion de usuario/rol
		$dates = Calendar::getAbleWorkableDates($task->estimated_date->toDateString());
		if (is_null($dates)) {
			return redirect('calendario/sin-datos');
		}
		return view('modules.tasks.forms.data-form')->with(['task' => $task, 'users' => User::getUsersByOcupation(),
															'types' => Task::getEnumValues('type'),
															'dates' => $dates]);
	}

	public function update(Request $request){
		$task = Task::find($request->id);
		if (!$task) return redirect('/404');
		//verificacion de usuario/rol
		Validator::make($request->input(), [
			'title' => 'required',
			'priority' => 'required',
			'complexity' => 'required',
			'type' => 'required',
			'estimated_date' => 'required|date_format:Y-m-d|after:yesterday', #Aqui verificacion de calendario
			'details' => 'min:10'
		])->validate();

		$task->title = $request->title;
		$task->priority = $request->priority;
		$task->complexity = $request->complexity;
		$task->type = $request->type;
		$task->estimated_date = Carbon::createFromFormat('Y-m-d',$request->estimated_date);
		$task->details = $request->details;
		$task->status = Task::DEFAULT_STATUS;
		$task->save();
		\Session::push('success', true);
		return redirect("tareas/listar");
	}

    public function personalList(Request $request){
		#hacer el beta de las person
    }
    public function view(Request $request){
		$task = Task::find($request->id);
		return view('modules.tasks.view')->with(['task' => $task, 'statuses' => TaskLog::getEnumValues('status')]);
    }

	public function getLogs(Request $request){
		return response(['log_id' => $request->log_id, 'logs' => TaskLog::find($request->log_id)->getIterations()]);
	}
	public function transact(Request $request){
		Validator::make($request->input(), [
			'status' => 'required',
			'detail' => 'min:10|max:255'
			])->validate();

		$log = TaskLog::find($request->task_log_id);
		$log->setDetails(\Auth::user()->fullname, $request->detail, $log->status, date('Y-m-d h:m'));

		if(\Auth::user()->id === $log->user_id){
			$log->deliver_date = date('Y-m-d');
			$log->status = "Revision";
		}else{
			$log->status = $request->status;
		}
		$log->save();
		\Session::push('success', true);
		return \Redirect::back()->with(['task' => Task::find($log->task_id), 'statuses' => TaskLog::getEnumValues('status')]);
	}

	public function delete(Request $request){
		$task = Task::find($request->task_id);
		if (!$task) return redirect('/404');

		$task->delete();
		\Session::push('success', true);
		return redirect("tareas/listar")->with(['tasks' => Task::getActiveTask()]);
	}

	public function indexAll(){
		return view("modules.tasks.list")->with(['tasks' => Task::all()]);
	}
}
