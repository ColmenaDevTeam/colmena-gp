<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Minning;

class MinningController extends Controller
{
    public function index(){

		$variables = Minning::getVariables();
		
		return view('modules.minning.minning')->with('variables', $variables);
	}

	public function process(Request $request){
		$model_id = Minning::generateModel($request->all());
		$records = Minning::getRecords($request->variables, $request->range_min,$request->range_max);

		$arrProccess = [];
		$attributes = null;
		foreach ($records as $record) {
			$attributes = array_keys(get_object_vars($record));
			$row = [];
			$row['data_minning_model_id'] = $model_id;

			for ($i=0; $i < count($attributes) ; $i++) {
				$discretized =  Minning::discretize($record->{$attributes[$i]}, $attributes[$i]);

				$data = array($record->{$attributes[$i]}, $discretized);
				$row[$attributes[$i]] = $data;
			}
			$arrProccess[] = $row;
		}

		$arrayToSave = Minning::normalize($arrProccess, $attributes);

		Minning::saveValues($arrayToSave);		
		
		return redirect("/segmentacion-de-datos/modelos");
	}

	public function algorithm(){

	}

	public function counter(Request $request)
	{
		$count = Minning::countRecords($request->variables);

		return json_encode(['count' => $count]);
	}

	public function showModels(){
		return view('modules.minning.model-list')->with('models', Minning::getModels());
	}

	public function deleteModel($id){

		Minning::deleteModel($id);
		return redirect("/segmentacion-de-datos/modelos");	
		
	}
}
