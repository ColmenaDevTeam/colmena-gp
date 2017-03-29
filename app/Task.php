<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model{
    protected $fillable = [
        'id','title','estimated_date','deliver_date','details','priority',
        'complexity','task_status', 'task_type', 'seen', 'created_at', 'updated_at'
	];

    public function responsible(){
        return $this->belongsTo('App\User');
    }
}
