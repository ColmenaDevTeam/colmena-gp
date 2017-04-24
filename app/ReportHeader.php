<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReportHeader extends Model
{
	const GLOBAL_URI = '/public/headers/';
    const DEFAULT_WIDTH = 900;
    const DEFAULT_HEIGHT = 50;

	protected $fillable = [
		'uri'
	];
	public $timestamps = false;

	public function getFulluriAttibute(){
		return self::GLOBAL_URI.$this->uri;
	}

	public function delete(){
		Storage::delete(self::GLOBAL_URI.$this->uri);
		parent::delete();
	}

}
