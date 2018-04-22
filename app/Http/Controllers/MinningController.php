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
		
	}

	public function counter(Request $request)
	{
		$count = Minning::countRecords($request->variables);

		return json_encode(['count' => $count]);
	}	
}
