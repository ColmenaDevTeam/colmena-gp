<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return view('modules.dashboard.index');
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
