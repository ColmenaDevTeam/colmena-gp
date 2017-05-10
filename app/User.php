<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\UserRegistration;
use Carbon\Carbon;
use App\Task;
use App\Calendar;
use App\Permission;
use App\Role;
use App\TaskLog;

class User extends Authenticatable
{
    use Notifiable;
	use EnumHelper;
	/**
     * The class constants.
     *
     *
     */
	const PASSWORD_LENGHT = 12;
	const MIN_USER_AGE = 18;
	protected $dates = ['birthdate'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 'lastname', 'cedula', 'birthdate', 'gender', 'active',
		'user_type', 'phone', 'email', 'password',

	];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'active'
    ];
    public function getFullnameAttribute(){
        return $this->firstname.' '.$this->lastname;
    }
	public function getOcupationAttribute(){
		$ocupation=0;
		if ($this->tasks) {
			foreach ($this->tasks as $task) {
				if ($task->status!='Cumplida' or $task->status!='Cancelada' or $task->status!='Retrasada')
					$ocupation+=($task->complexity)+($task->priority);
			}
		}
		return $ocupation;
	}
	public function getGenderStringAttribute(){
		return $this->gender == true ? 'Masculino' : 'Femenino';
	}
	public static function getUsersByOcupation(){
		$users = self::where('cedula', '!=', env('APP_DEV_USERNAME'))->get();
		for($i=0; $i < count($users); $i++){
		   for ( $j=$i+1;$j<count($users);$j++){
			  if ($users[$i]->ocupation > $users[$j]->ocupation) {
				  $aux = $users[$i];
				  $users[$i] = $users[$j];
				  $users[$j] = $aux;
				}
			  }
		  }
		return $users;
	}
	public function department(){
		return $this->belongsTo('App\Department', 'department_id');
	}

	public function tasks(){
		return $this->hasMany('App\Task', 'user_id');
	}

	public function roles(){
		return $this->belongsToMany('App\Role', 'users_has_roles', 'user_id', 'role_id');
	}

	public function recurringActivities(){
		return $this->belongsToMany('App\RecurringActivity', 'users_has_recurring_activities', 'user_id', 'recurring_activity_id');
	}

	public function absences(){
		return $this->hasMany('App\Absence', 'user_id');
	}

	public function accessList(){
		$accessList = array();
		foreach ($this->roles as $role) {
			foreach ($role->permissions as $permission) {
				if ($permission->navigation) {
					if(array_key_exists($permission->category, $accessList)){
						if (!in_array($permission, $accessList[$permission->category]))
						$accessList[$permission->category][] = $permission;
					}else{
						$accessList[$permission->category] = array();
						if (!in_array($permission, $accessList[$permission->category]))
						$accessList[$permission->category][] = $permission;
					}
				}
			}
		}
		#dd($accessList);
		/*$all = collect();
		foreach ($this->roles as $role) {
			foreach ($role->permissions as $permission) {
				if (!$all->contains($permission)) {
					$all->push($permission);
				}
			}
		}

		foreach ($all as $permission) {
			if ($permission->navigation) {
				if(array_key_exists($permission->category, $accessList)){
					if (!in_array($permission, $accessList[$permission->category]))
					$accessList[$permission->category][] = $permission;
				}else{
					$accessList[$permission->category] = array();
					if (!in_array($permission, $accessList[$permission->category]))
					$accessList[$permission->category][] = $permission;
				}
			}
		}*/
		return $accessList;
	}

	public function generateRegistrationNotify(){
		try {
			$this->notify(new UserRegistration($this));
		} catch (Exception $e) {

		}
	}

	public function getTasksPerRange($start, $end){
        $tasks = $this->tasks()->whereBetween('estimated_date',[$start,$end])->get();
        return $tasks;
	}
	public function delayTasks($start, $end){
		$tasks = $this->getTasksPerRange($start, $end);
		if (count($tasks) > 0) {
			$nextDate = Calendar::getNextWorkableDate($end);
			foreach ($tasks as $task) {
				TaskLog::generateAutoLog($task->id, true, $task->estimated_date, $nextDate);
				$task->estimated_date = $nextDate;
				$task->status = 'Diferida';
				$task->save();
				$task->generateAbsenceDelayNotification();
			}
		}
	}

	public function isDev(){
		if ($this->cedula == env('APP_DEV_USERNAME'))
			return true;
		else
			return false;
	}

	public function getUrlAttribute(){
		return "/usuarios/perfil/".$this->id;
	}
	public static function birthdates(){
		return self::where('birthdate', '=', Carbon::now()->subDays(3))
					->where('birthdate', '=', Carbon::now()->addDays(3))->count();
	}

	public static function usersCount(){
		return self::count();
	}

	public function getAccessLevel(){
		return $this->roles()->min('level');
	}

	public function canDo($permisssionSlug){

		foreach ($this->roles as $role) {
			if ($role->permissions->contains(Permission::whereSlug($permisssionSlug))) {
				return true;
			}
		}
		return false;
	}
}
