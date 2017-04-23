<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RecurringActivity;
use App\Calendar;
use App\User;
use Validator;

class RecurringActivityController extends Controller
{
    public function index(){
		return view('modules.tasks.list')->with(['activities' => RecurringActivity::all()]);
	}

	public function showDataForm(){
		if (!Calendar::checkAvailability()) {
			return redirect('/calendario/sin-datos');
		}
		return view('modules.recurring-activities.forms.data-form')
				->with(['types' => RecurringActivity::getEnumValues('task_type') ,
		 		  	'frequency' => RecurringActivity::getEnumValues('frequency'),
					'users' => User::getUsersByOcupation(),
					'dates' => Calendar::getAbleWorkableDates()]);
	}

	public function register(){
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
	}

	public function showUpdateForm(){

	}

	public function update(){

	}

	public function view(){

	}

	public function delete(){

	}

	public function reactivate(){

	}
}
