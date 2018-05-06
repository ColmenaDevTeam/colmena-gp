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

		#Minning::generateModel($request->all());
		$records = Minning::getRecords($request->variables, $request->range_min,$request->range_max);
		#dd($records);

		foreach ($records as $record) {
			$attrs = get_object_vars($record);
	
			for ($i=0; $i < count($attrs) ; $i++) { 
				Minning::discretize();
				Minning::normalize();
			}	
		}
		
		#$count = count(get_object_vars($some_std_class_object));
		#dd($request->all());
		return redirect();
	}

	public function algorithm(){

	}

	public function counter(Request $request)
	{
		$count = Minning::countRecords($request->variables);

		return json_encode(['count' => $count]);
	}	
}
