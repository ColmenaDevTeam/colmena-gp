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
use Auth;
use Session;

class TaskController extends Controller{
	public function index(){
		//verificacion de usuario/rol

		return view('modules.tasks.list')->with(['tasks' => Task::all()]);
	}

	public function showDataForm(){
		//verificacion de usuario/rol
		
		if (!Calendar::checkAvailability()) {
			return redirect('/calendario/sin-datos');
		}
		return view('modules.tasks.forms.data-form')->with(['users' => User::getUsersByOcupation(),
															'types' => Task::getEnumValues('type'),
															'dates' => Calendar::getAbleWorkableDates()]);
	}

	public function register(Request $request){
		//verificacion de usuario/rol
		Validator::make($request->input(), [
			'title' => 'required',
			'priority' => 'required',
			'complexity' => 'required',
			'type' => 'required',
			'estimated_date' => 'required|date_format:Y-m-d|after:yesterday',#Aqui verificacion de calendario
			'users' => 'required',
			'details' => 'min:10|max:255'
		])->validate();

		foreach ($request->users as $user) {
			$task = new task();
			$task->title = $request->title;
			$task->priority = $request->priority;
			$task->complexity = $request->complexity;
			$task->type = $request->type;
			$task->estimated_date = Carbon::createFromFormat('Y-m-d',$request->estimated_date);
			$task->details = $request->details;
			$task->user_id = $user;
			$task->save();
		}
		Session::push('success', true);
		return redirect("tareas/listar")->with(['tasks' => Task::all()]);
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

		$tasks = Task::all();
		Session::push('success', true);
		return redirect("tareas/listar")->with(['tasks' => $tasks]);
	}

    public function personalList(Request $request){

    }
    public function view(Request $request){
		$task = Task::find($request->id);
		if (!$task) return redirect('/404');
		//verificacion de usuario/rol
		$task->taskLogs()->paginate(5);
		return view('modules.tasks.view')->with(['task' => $task, 'statuses' => Task::getEnumValues('status'), 'log' => $task->lastLog()]);
    }

	public function transact(Request $request){
		//verificacion de usuario/rol
		$task = Task::find($request->task_id);
		if (!$task) return redirect('/404');

		Validator::make($request->input(), [
			'status' => 'required',
			'detail' => 'min:10|max:255'
		])->validate();

		$log = new TaskLog;
		$log->status = $request->status;
		$log->detail = $request->detail;
		$log->user = Auth::user()->fullname;
		$log->task_id = $task->id;
		$log->save();
		Session::push('success', true);
		return \Redirect::back()->with(['task' => $task, 'statuses' => Task::getEnumValues('status'), 'log' => $task->lastLog()]);
	}

	public function delete(Request $request){
		//verificacion de usuario/rol
		$task = Task::find($request->task_id);
		if (!$task) return redirect('/404');

		$task->delete();
		Session::push('success', true);
		return redirect("tareas/listar")->with(['tasks' => Task::all()]);
	}
}
