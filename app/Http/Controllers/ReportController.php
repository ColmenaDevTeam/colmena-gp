<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use \Image;
use App\Task;
use Carbon\Carbon;
use App\User;
use App\Calendar;
use App\Absence;
use App\TaskLog;
use App\ReportHeader;
use Validator;

class ReportController extends Controller
{
    public function index(){

	}

	public function showHeader(){
		return view('modules.reports.forms.header-form')->with('header', ReportHeader::first());
	}

	public function loadHeader(Request $request){
		dd($request->file('header'));
		$name = 'header'.Carbon::now()->format('Ymdhms').'.jpg';

		try{
			$headers = ReportHeader::all();
			foreach ($headers as $header) {
				$header->delete();
			}
			# Carpeta de Fotos
			if(!Storage::exists(ReportHeader::GLOBAL_URI))
			Storage::makeDirectory(ReportHeader::GLOBAL_URI, 775);
			$path = storage_path('app'.ReportHeader::GLOBAL_URI.$name);
			$image = Image::make($request->file('header')->getRealPath())->encode('jpg', 95);
			$image->resize(Photo::DEFAULT_WIDTH, Photo::DEFAULT_HEIGHT);
			$image->save($path);

			$header = new ReportHeader;
			$header->uri = $name;
			$header->save();

		}catch(Exception $e){

		}
		\Session::push('success', true);
		return view('modules.reports.forms.header-form')->with('header', ReportHeader::first());
	}
}
