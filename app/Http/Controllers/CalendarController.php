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
			foreach ($calendar as $savedDate) {
				$n = -1;
				$dateAux = '';
				#var_dump($request->dates);
				for ($i=0; $i < count($request->dates); $i++) {

					if ($savedDate->workable_date->toDateString() == $request->dates[$i]) {
						$n = $i;
						break;
					}else{
						$dateAux = $request->dates[$i];
					}
				}
				if($n == -1){
				  //Aqui lo de las tareas
				  /*
				  $tareasMover=Ctarea::buscarFechaEst($fecha->getOriginal('fecLab'));
				  if (!is_null($tareasMover)) {
					foreach ($tareasMover as $tarea) {
					  $tarea->fecEst = Ccalendario::getProxima($fecha->getOriginal('fecLab'));
					  $tarea->save();
					}
				}*/
				  $savedDate->delete();
				}
			}
			foreach ($request->dates as $day) {
				$date = Calendar::firstOrCreate(['workable_date' => Carbon::createFromFormat('Y-m-d h:m:s', $day)]);
				$date->save();
			}
		}else {
			foreach ($request->dates as $day) {
				$date = new Calendar;
				$date->workable_date = Carbon::createFromFormat('Y-m-d', $day);
				$date->save();
			}
		}
		dd('la vista del ver, luego del cargado automatico');
	}

	public function show(){
		;
	}
}
