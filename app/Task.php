<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model{

	protected $dates = ['estimated_date', 'deliver_date'];

	protected $fillable = [
        'id','title','estimated_date','deliver_date','details','priority',
        'complexity', 'type', 'seen', 'status'
	];

    public function responsible(){
        return $this->belongsTo('App\User');
    }
}
