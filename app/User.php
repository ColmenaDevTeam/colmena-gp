<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\UserRegistration;

class User extends Authenticatable
{
    use Notifiable;

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

	public function department(){
		return $this->belongsTo('App\Department', 'department_id');
	}

	public function tasks(){
		return $this->hasMany('App\Task', [ 'user_id', 'id']);
	}

	public function roles(){
		return $this->belongsToMany('App\Rol', 'users_has_roles', 'user_id', 'rol_id');
	}

	public function recurringActivities(){
		return $this->belongsToMany('App\RecurringActivity', 'users_has_recurring_activities', 'user_id', 'recurring_activity_id');
	}

	public function absences(){
		return $this->hasMany('App\Absence', 'user_id');
	}

	public function generateRegistrationNotify(){
		try {
			$this->notify(new UserRegistration($this));
		} catch (Exception $e) {

		}
	}

	public function isDev(){
		if ($this->cedula == env('APP_DEV_USERNAME'))
			return true;
		else
			return false;
	}
}
