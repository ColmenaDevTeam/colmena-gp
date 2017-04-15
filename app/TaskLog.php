<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskLog extends Model
{
	protected $fillable = [
		'status','user','detail'
	];

	public function task(){
		return $this->belongsTo('App\Task', 'task_id');
	}
}
