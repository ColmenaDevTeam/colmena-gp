<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\User;
use Carbon\Carbon;

class UserController extends Controller{

	public function index(){
		return view('modules.users.list')->with('users', User::all()->where('cedula', '<>', env('APP_DEV_USERNAME')));
	}
    public function showDataForm(){
		return view('modules.users.forms.data-form');
	}

	public function register(Request $request){
		$minDate = Carbon::now()->subYear(18)->format('Y/m/d');
		Validator::make($request->input(), [
			'cedula' => 'numeric|required|unique:users',
			'firstname' => 'regex:/^[[:alpha:]]+( [[:alpha:]]+)?$/|required|min:3|max:45',
			'lastname' => 'regex:/^[[:alpha:]]+( [[:alpha:]]+)?$/|required|min:3|max:45',
			'user_type' => 'required',
			'email' => 'email|required',
			'phone' => 'numeric|required',
			'birthdate' => 'date|required|before:'.$minDate,
			'gender' => 'boolean|required',
		])->validate();

		$user = new User();
		$user->cedula = $request->cedula;
		$user->firstname = $request->firstname;
		$user->lastname = $request->lastname;
		$user->user_type = $request->user_type;
		$user->password = \Hash::make($request->cedula);
		$user->email = $request->email;
		$user->phone = $request->phone;
		$user->birthdate = Carbon::createFromFormat('d/m/Y',$request->birthdate);
		$user->gender = $request->gender;
		$user->department_id = \Auth::user()->department_id;
		$user->save();
		$user->generateRegistrationNotify();
		\Session::push('success' , true);
		return redirect("usuarios/registrar");
	}

	public function showUpdateForm(Request $request){
		$user = User::find($request->id);
		if (!$user || $user->isDev()) return view('errors.404');
		return view('modules.users.forms.data-form')->with('user', $user);
	}

	public function update(Request $request){
		$user = User::find($request->id);
		if (!$user || $user->isDev()) return view('errors/404');

		$minDate = Carbon::now()->subYear(18)->format('Y/m/d');

		Validator::make($request->input(), [
			'cedula' => $user->cedula!=$request->cedula ? 'numeric|required|unique:users' : '',
			'firstname' => 'regex:/^[[:alpha:]]+( [[:alpha:]]+)?$/|required|min:3|max:45',
			'lastname' => 'regex:/^[[:alpha:]]+( [[:alpha:]]+)?$/|required|min:3|max:45',
			'user_type' => 'required',
			'email' => 'email|required',
			'phone' => 'numeric|required',
			'birthdate' => 'date|required|before:'.$minDate,
			'gender' => 'boolean|required',
		])->validate();

		$user->cedula = $request->cedula;
		$user->firstname = $request->firstname;
		$user->lastname = $request->lastname;
		$user->user_type = $request->user_type;
		#$user->password = \Hash::make($request->cedula);
		$user->email = $request->email;
		$user->phone = $request->phone;
		$user->birthdate = Carbon::createFromFormat('d/m/Y',$request->birthdate);
		$user->gender = $request->gender;
		#$user->department_id = \Auth::user()->department_id;
		$user->save();
		$users = User::all()->where('cedula', '<>', env('APP_DEV_USERNAME'));
		\Session::push('success', true);
		return redirect("usuarios/listar")->with('users', $users);
	}

	public function desactivate(Request $request){
		#dd($request->all());
		$user = User::find($request->user_id);
		if (!$user || $user->isDev()) return view('errors/404');

		$user->active = false;
		$user->save();

		\Session::push('success', true);
		return redirect("usuarios/listar")->with('users', User::all());
	}
	public function reactivate(Request $request){
		#dd($request->all());
		$user = User::find($request->re_user_id);
		if (!$user || $user->isDev()) return view('errors/404');

		$user->active = true;
		$user->save();

		\Session::push('success', true);
		return redirect("usuarios/listar")->with('users', User::all());
	}

	public function delete(){
		return redirect("usuarios/listar")->with('users', User::all());
	}
}
