<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Steganography;
use \File;
use KzykHys\Steganography\Processor;
use \Hash;

class SteganographyController extends Controller
{
    public function showDataForm(){
		return view('modules.steganography.forms.data-form')->with([
			'baseImages' => Steganography::getBaseImages()]);
	}

	public function loadBaseImage($filename){
		$path = Steganography::getFullBasePath().$filename;
		return Steganography::getImage($path);
	}

	public function loadUserImage($filename){
		$path = Steganography::getFullUsersPath().$filename;
		return Steganography::getImage($path);
	}

	public function save(Request $request){
		validator($request->all(), [
			'secureimg' => 'required',
			'passphrase' => 'required|confirmed'
			])->validate();

		Steganography::make($request->passphrase, $request->secureimg, \Auth::user()->cedula);

		return redirect('/')->with(['success' => true]);
	}

	public function test(){
		$processor = new Processor();
		$message = $processor->decode(Steganography::getFullUsersPath().\Auth::user()->cedula.'.png');
		dd($message);
	}
}
