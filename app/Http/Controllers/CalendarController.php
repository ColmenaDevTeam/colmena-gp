<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Calendar;

class CalendarController extends Controller
{
	public function showDataForm(){
		$calendar = Calendar::all();
		return view('modules.calendar.forms.data-form')->with('calendar', $calendar);
	}
    public function update(){
		;
	}
	public function show(){
		;
	}
}
