<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RecurringActivity;
use App\Calendar;
use App\User;
use Validator;
use \Auth;

class RecurringActivityController extends Controller
{
    public function index(){
		if(!Auth::user()->canDo('recurring_activities.list')) return redirect('/401');
		return view('modules.recurring-activities.list')->with(['activities' => RecurringActivity::all()]);
	}

	public function showDataForm(){
		if(!Auth::user()->canDo('recurring_activities.create')) return redirect('/401');
		if (!Calendar::checkAvailability()) {
			return redirect('/calendario/sin-datos');
		}
		return view('modules.recurring-activities.forms.data-form')
				->with(['types' => RecurringActivity::getEnumValues('task_type') ,
		 		  	'frequency' => RecurringActivity::getEnumValues('frequency'),
					'users' => User::getUsersByOcupation(),
					'dates' => Calendar::getAbleWorkableDates()]);
	}

	public function register(Request $request){
		if(!Auth::user()->canDo('recurring_activities.create')) return redirect('/401');
		Validator::make($request->input(), [
			'title' => 'required',
			'priority' => 'required',
			'complexity' => 'required',
			'task_type' => 'required',
			'start_date' => 'required|date_format:Y-m-d|after:yesterday',
			'users' => 'required',
			'deliverer_days' => 'required|min:1',
			'details' => 'min:10|max:255'
		])->validate();

		$activity = new RecurringActivity;
		$activity->title = $request->title;
		$activity->details = $request->details;
		$activity->priority = $request->priority;
		$activity->complexity = $request->complexity;
		$activity->task_type = $request->task_type;
		$activity->frequency = $request->frequency;
		$activity->deliverer_days = $request->deliverer_days;
		$activity->start_date = $request->start_date;
		$activity->save();
		$collection = [];

		for ($i=0; $i < count($request->users); $i++) {
			$user = User::find($request->users[$i]);
			is_null($user) ?  : $collection[] = $request->users[$i];
		}
		$activity->users()->sync($collection);


		\Session::push('success', true);
		return view('modules.recurring-activities.list')->with(['activities' => RecurringActivity::all()]);
	}

	public function showUpdateForm(Request $request){
		if(!Auth::user()->canDo('recurring_activities.update')) return redirect('/401');
		$activity = RecurringActivity::find($request->id);
		if (is_null($activity)) {
			return view("errors/404");
		}
		return view('modules.recurring-activities.forms.data-form')
				->with(['types' => RecurringActivity::getEnumValues('task_type') ,
					'frequency' => RecurringActivity::getEnumValues('frequency'),
					'activity' => $activity,
					'users' => User::getUsersByOcupation(),
					'dates' => Calendar::getAbleWorkableDates()]);
	}

	public function update(Request $request){
		if(!Auth::user()->canDo('recurring_activities.update')) return redirect('/401');
		$activity = RecurringActivity::find($request->id);
		if (is_null($activity)) {
			return redirect("/404");
		}
		Validator::make($request->input(), [
			'title' => 'required',
			'priority' => 'required',
			'complexity' => 'required',
			'task_type' => 'required',
			'start_date' => 'required|date_format:Y-m-d|after:yesterday',
			'users' => 'required',
			'deliverer_days' => 'required|min:1',
			'details' => 'min:10|max:255'
		])->validate();

		$activity->title = $request->title;
		$activity->details = $request->details;
		$activity->priority = $request->priority;
		$activity->complexity = $request->complexity;
		$activity->task_type = $request->task_type;
		$activity->frequency = $request->frequency;
		$activity->deliverer_days = $request->deliverer_days;
		$activity->start_date = $request->start_date;
		$activity->save();
		$collection = [];

		for ($i=0; $i < count($request->users); $i++) {
			$user = User::find($request->users[$i]);
			is_null($user) ?  : $collection[] = $request->users[$i];
		}
		$activity->users()->sync($collection);


		\Session::push('success', true);
		return view('modules.recurring-activities.list')->with(['activities' => RecurringActivity::all()]);
	}

	public function view(Request $request){
		if(!Auth::user()->canDo('recurring_activities.create')) return redirect('/401');
		$activity = RecurringActivity::find($request->id);
		if (is_null($activity)) {
			return view("errors/404");
		}
		return view('modules.recurring-activities.view')->with('activity', $activity);
	}

	public function delete(Request $request){
		if(!Auth::user()->canDo('recurring_activities.delete')) return redirect('/401');
		$activity = RecurringActivity::find($request->id);
		if (!$activity) return redirect('/404');

		$activity->delete();
		\Session::push('success', true);
		return redirect("actividades-recurrentes/listar")->with(['activities' => RecurringActivity::all()]);
	}

	public function desactivate(Request $request){
		$activity = RecurringActivity::find($request->id);
		if (!$activity) return redirect('/404');

		$activity->active = false;
		$activity->save();

		\Session::push('success', true);
		return redirect("actividades-recurrentes/".$activity->id."/ver")->with('activity', $activity);
	}
	public function reactivate(Request $request){
		if(!Auth::user()->canDo('recurring_activities.create')) return redirect('/401');
		$activity = RecurringActivity::find($request->id);
		if (!$activity) return redirect('/404');

		$activity->active = true;
		$activity->save();

		\Session::push('success', true);
		return redirect("actividades-recurrentes/".$activity->id."/ver")->with('activity', $activity);
	}
}
