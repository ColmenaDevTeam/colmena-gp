<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Absence;
use App\User;
use App\Task;
use Carbon\Carbon;
use Validator;

class AbsenceController extends Controller
{
	public function index(){
		return view('modules.absences.list')->with('absences', Absence::all());
	}

	public function showDataForm(){
		return view('modules.absences.forms.data-form')->with(['users' => User::all()]);
	}

	public function register(Request $request){
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
		$absence->user_id = $request->user_id;
		$absence->type = $request->type;
		$absence->save();
		#Aqui Posponer Tareas
		/*
		$tareasPorFecha = $usuario->getTareasPorFecha($Opermrepo->fecIni, $Opermrepo->fecFin);
		if (!is_null($tareasPorFecha)) {
			foreach ($tareasPorFecha as $tarea) {
				$tarea->fecEst = Ccalendario::getProxima($Opermrepo->fecFin);
				$tarea->save();
			}
		}
		*/
		$absences = Absence::all();
		\Session::push('success', true);
		return redirect("ausencias/listar")->with(['absences' => $absences]);
	}

	public function showUpdateForm(Request $request){
		$absence = Absence::find($request->id);
		if (!$absence) return view('errors.404');
		return view('modules.absences.forms.data-form')->with(['absence' => $absence, 'users' => User::all()]);
	}

	public function update(Request $request){
		$absence = Absence::find($request->id);
		if (!$absence) return view('errors.404');
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
		$absence->user_id = $request->user_id;
		$absence->save();
		#Aqui Posponer Tareas
		/*
		$tareasPorFecha = $usuario->getTareasPorFecha($Opermrepo->fecIni, $Opermrepo->fecFin);
		if (!is_null($tareasPorFecha)) {
			foreach ($tareasPorFecha as $tarea) {
				$tarea->fecEst = Ccalendario::getProxima($Opermrepo->fecFin);
				$tarea->save();
			}
		}
		*/
		$absences = Absence::all();
		\Session::push('success', true);
		return redirect("ausencias/listar")->with(['absences' => $absences]);
	}
}
