<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\Absence;
use App\User;
use App\Department;

class HomeController extends Controller{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){

        return view('modules.dashboard.index')->with(['tasksCount' => Task::countTasks(), 'absencesCount' => Absence::countActiveAbsences(),
													'birthdates' => User::birthdates(), 'usersCount' => User::usersCount()]);
    }

	/**
	 * Show the application 'about us'.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function about(){
		return view('about_us');
	}
}
