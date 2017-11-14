<?php

namespace App;

use App\User;
use KzykHys\Steganography\Processor;
use \Hash;
use \File;
class Steganography
{
    const BASE_IMAGE_PATH = '/secureimages/base';
    const USERS_IMAGE_PATH = '/secureimages/users';

    public static function check($request, $user){
        if (condition) {
            # code...
        }
	}

    public static function getFullBasePath(){
        return storage_path().self::BASE_IMAGE_PATH;
    }

    public static function getFullUserPath(){
        return storage_path().self::USERS_IMAGE_PATH;
    }

    public static function getBaseImages(){
        return array_diff(scandir(self::getFullBasePath()), array('.', '..'));
    }
    public static function generateImage(){

    }

    public static function updateImage(){

    }

    public static function unsetImage(){

    }

    public static function getImage($path){
        if(!File::exists($path)) abort(404);

        $file = File::get($path);
	    $type = File::mimeType($path);

	    $response = Response::make($file, 200);
	    $response->header("Content-Type", $type);

        return $response;
    }
}
