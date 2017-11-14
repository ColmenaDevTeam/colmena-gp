<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Steganography;
use \File;

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

	/*
	Route::get('/avatars/{filename}', function ($filename)
	{
	    $path = storage_path() . '/avatars/' . $filename;

	    if(!File::exists($path)) abort(404);

	    $file = File::get($path);
	    $type = File::mimeType($path);

	    $response = Response::make($file, 200);
	    $response->header("Content-Type", $type);
	    return $response;
	})->name('avatar');

	*/
}
