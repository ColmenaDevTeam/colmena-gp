<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Absence;
use App\User;
use App\Task;
use Carbon\Carbon;
use Validator;
use App\Calendar;
use Auth;

class AbsenceController extends Controller
{
	public function index(){
		if(!Auth::user()->canDo('absences.list')) return redirect('/401');
		return view('modules.absences.list')->with('absences', Absence::getActiveAbsences());
	}
	public function indexAll(){
		return view("modules.absences.list")->with(['absences' => Absence::all()]);
	}

	public function showDataForm(){
		if(!Auth::user()->canDo('absences.create')) return redirect('/401');
		if (!Calendar::checkAvailability()) {
			return redirect('/calendario/sin-datos');
		}
		return view('modules.absences.forms.data-form')->with(['users' => User::all()]);
	}

	public function register(Request $request){
		if(!Auth::user()->canDo('absences.create')) return redirect('/401');
		$user = User::find($request->user_id);
		if (is_null($user))
			return redirect('/404');
		$minDate = Carbon::now()->subDays(Absence::MAX_PASSED_DAYS)->format('d/m/Y');
		Validator::make($request->input(), [
			'start_date' => 'required|date_format:d/m/Y|after:'.$minDate,
			'end_date' => 'required|date_format:d/m/Y|after:start_date',
			'user_id' => 'required',
			'type' => 'required',
			'details' => 'min:10|max:255'
		])->validate();
		$absence = new Absence();
		$absence->start_date = Carbon::createFromFormat('d/m/Y',$request->start_date);
		$absence->end_date = Carbon::createFromFormat('d/m/Y',$request->end_date);
		$absence->details = $request->details;
		$absence->user_id = $user->id;
		$absence->type = $request->type;
		$absence->save();

		$user->delayTasks($absence->start_date, $absence->end_date);

		$absences = Absence::getActiveAbsences();
		\Session::push('success', true);
		return redirect("ausencias/listar")->with(['absences' => $absences]);
	}

	public function showUpdateForm(Request $request){
		if(!Auth::user()->canDo('absences.update')) return redirect('/401');
		$absence = Absence::find($request->id);
		if (!$absence) return view('errors.404');
		return view('modules.absences.forms.data-form')->with(['absence' => $absence, 'users' => User::all()]);
	}

	public function update(Request $request){
		if(!Auth::user()->canDo('absences.update')) return redirect('/401');
		$absence = Absence::find($request->id);
		$user = User::find($request->user_id);
		if (!$absence || !$user) return view('errors.404');
		$minDate = Carbon::now()->subDays(Absence::MAX_PASSED_DAYS)->format('d/m/Y');
		Validator::make($request->input(), [
			'start_date' => 'required|date_format:d/m/Y|after:'.$minDate,
			'end_date' => 'required|date_format:d/m/Y|after:start_date',
			'user_id' => 'required',
			'type' => 'required',
			'details' => 'min:10|max:255'
		])->validate();

		$absence->start_date = Carbon::createFromFormat('d/m/Y',$request->start_date);
		$absence->end_date = Carbon::createFromFormat('d/m/Y',$request->end_date);
		$absence->details = $request->details;
		$absence->user_id = $user->id;
		$absence->save();

		$user->delayTasks($absence->start_date, $absence->end_date);
		$absences = Absence::getActiveAbsences();
		\Session::push('success', true);
		return redirect("ausencias/listar")->with(['absences' => $absences]);
	}

	public function view(Request $request){
		$absence = Absence::find($request->id);
		if (!$absence) return redirect('/404');
		if(!Auth::user()->canDo('absences.create') && Auth::user()->id != $absence->user->id) return redirect('/401');
		return view('modules.absences.view')->with(['absence' => $absence]);
	}

	public function delete(Request $request){
		if(!Auth::user()->canDo('absences.delete')) return redirect('/401');
		$absence = Absence::find($request->absence_id);
		if (!$absence) return redirect('/404');

		$absence->delete();
		\Session::push('success', true);
		return redirect("ausencias/listar")->with(['absences' => Absence::getActiveAbsences()]);
	}
}
