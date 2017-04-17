<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Calendar;
use App\Task;
use Validator;
use Carbon\Carbon;

class CalendarController extends Controller
{
	public function showDataForm(){
		Calendar::checkYear();
		return view('modules.calendar.forms.data-form')->with(['calendar' => Calendar::getDateArray(),
																'months' => Calendar::MONTHS,
																'dates' => Calendar::generateDates()]);
	}
    public function update(Request $request){
		Validator::make($request->input(), [
			'dates' => 'required'
		])->validate();

		$calendar = Calendar::all();
		if (count($calendar) > 0) {
			$dates = $request->dates;
			foreach ($calendar as $savedDate) {
				$n = -1;
				#dd($dates);
				#var_dump($request->dates);
				for ($i=0; $i < count($dates); $i++) {
					if ($savedDate->workable_date->toDateString() == $dates[$i]) {
						$n = $i;
						$dates[$i] = null;
					}
				}
				if($n == -1){
				  Task::delayTasks($savedDate->workable_date);
				  $savedDate->delete();
				}
			}
			#dd($dates);
			for ($i=0; $i < count($dates); $i++){
				if ($dates[$i] != null) {
					$date = new Calendar;
					$date->workable_date = Carbon::createFromFormat('Y-m-d', $dates[$i]);
					$date->save();
				}
			}
		}else {
			$dates = $request->dates;
			foreach ($dates as $day) {
				$date = new Calendar;
				$date->workable_date = Carbon::createFromFormat('Y-m-d', $day);
				$date->save();
			}
		}
		\Session::push('success', true);
		return view('modules.calendar.forms.data-form')->with(['calendar' => Calendar::getDateArray(),
																'months' => Calendar::MONTHS,
																'dates' => Calendar::generateDates()]);;
	}

	public function show(){
		return view('modules.calendar.view')->with(['calendar' => Calendar::getDateArray(),
																'months' => Calendar::MONTHS,
																'dates' => Calendar::generateDates()]);;
	}

	public function showNoDataInfo(){
		if (Calendar::checkAvailability()) {
			return view('errors.404');
		}
		return view('modules.calendar.no-data');
	}
}
