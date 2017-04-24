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
	#	dd( ReportHeader::first()->fulluri);
		return view('modules.reports.forms.header-form')->with('header', ReportHeader::first());
	}

	public function loadHeader(Request $request){
		Validator::make($request->input(),[
			'header' => 'mime:jpg,png,bmp|
						dimensions:min_width=700,min_height=30,
						max_width=1200,max_height=200'
			])->validate();
		$name = 'header'.Carbon::now()->format('Ymdhms').'.jpg';

		try{
			$headers = ReportHeader::all();
			foreach ($headers as $header) {
				$header->delete();
			}
			# Carpeta de Fotos
			if(!Storage::exists(ReportHeader::STORAGE_URI))
			Storage::makeDirectory(ReportHeader::STORAGE_URI, 775);
			$path = storage_path('app'.ReportHeader::STORAGE_URI.$name);
			$image = Image::make($request->file('header')->getRealPath())->encode('jpg', 95);
			$image->resize(ReportHeader::DEFAULT_WIDTH, ReportHeader::DEFAULT_HEIGHT);
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
