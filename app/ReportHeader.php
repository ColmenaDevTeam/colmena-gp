<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ReportHeader extends Model
{
	const GLOBAL_URI = '/storage/headers/';
	const STORAGE_URI = '/public/headers/';
    const DEFAULT_WIDTH = 900;
    const DEFAULT_HEIGHT = 50;

	protected $fillable = [
		'uri'
	];
	public $timestamps = false;

	public function getFulluriAttribute(){
		return self::GLOBAL_URI.$this->uri;
	}


	public function delete(){
		Storage::delete(self::STORAGE_URI.$this->uri);
		parent::delete();
	}

}
