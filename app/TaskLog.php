<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\EnumHelper;
class TaskLog extends Model
{
		use EnumHelper;
		protected $table = "users_has_tasks";
		protected static $tabla = "users_has_tasks";
		protected $fillable = [ 'status','deliver_date','user_id','task_id','details', 'created_at', 'updated_at'];
		protected $dates = ['deliverer_date'];
		public function user(){
			return $this->belongsTo('App\User');
		}
		public function task(){
			return $this->belongsTo('App\Task');
		}

		public function getLastIteration(){
			if (is_null($this->details)) {
				$detail = [];
			}else {
				$details = json_decode($this->details);
				$detail = end($details);
			}
			return json_encode($detail);
		}
		public function getIterations(){
			return	is_null($this->details) ? json_encode([]) : $this->details;
		}
		public function setDetails($username, $message, $oldStatus, $date){
			if (is_null($this->details)) {
				$details[] = ['user' => $username, 'messsage' => $message, 'old' => $oldStatus, 'date' => $date];
			}else {
				$details = json_decode($this->details);
				$details[] = ['user' => $username, 'messsage' => $message, 'old' => $oldStatus, 'date' => $date];
			}
			#dd(json_encode($details), $details, $this->details);
			$details = json_encode($details);
			$this->details = $details;
		}
}
