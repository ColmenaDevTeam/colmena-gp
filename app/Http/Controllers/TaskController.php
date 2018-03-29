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
			'details' => 'min:10|max:255'
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
			'details' => 'min:10|max:255'
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
		return view('modules.tasks.view')->with('task', $task);
    }

	public function transact(Request $request){
		//verificacion de usuario/rol
		$task = Task::find($request->task_id);
		if(!Auth::user()->canDo('tasks.create') && Auth::user()->id != $task->responsible->id) return redirect('/401');
		if (!$task) return redirect('/404');

		Validator::make($request->input(), [
			'status' => 'required',
			'detail' => 'min:10|max:255'
		])->validate();
		$task->status = $request->status;
		if($request->status == "Revision") $task->deliver_date = date('Y-m-d');
		$task->save();
		$log = new TaskLog;
		$log->status = $request->status;
		$log->detail = $request->detail;
		$log->user = Auth::user()->fullname;
		$log->task_id = $task->id;
		$log->save();
		\Session::push('success', true);
		return \Redirect::back()->with(['task' => $task, 'statuses' => Task::getEnumValues('status'), 'log' => $task->lastLog()]);
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
