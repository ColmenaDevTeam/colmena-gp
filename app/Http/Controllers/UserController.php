<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\User;
use Carbon\Carbon;
use \Auth;

class UserController extends Controller{

	public function index(){
		if(!Auth::user()->canDo('users.list')) return redirect('/401');
		return view('modules.users.list')->with('users', User::all()->where('cedula', '<>', env('APP_DEV_USERNAME')));
	}
    public function showDataForm(){
		if(!Auth::user()->canDo('users.create')) return redirect('/401');
		return view('modules.users.forms.data-form');
	}

	public function register(Request $request){
		if(!Auth::user()->canDo('users.create')) return redirect('/401');
		$minDate = Carbon::now()->subYear(User::MIN_USER_AGE)->format('d/m/Y');
		Validator::make($request->input(), [
			'cedula' => 'numeric|required|unique:users',
			'firstname' => 'regex:/^[[:alpha:]]+( [[:alpha:]]+)?$/|required|min:3|max:45',
			'lastname' => 'regex:/^[[:alpha:]]+( [[:alpha:]]+)?$/|required|min:3|max:45',
			'user_type' => 'required',
			'email' => 'email|required',
			'phone' => 'numeric|required',
			'birthdate' => 'date_format:d/m/Y|required|before:'.$minDate,
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
		try {
			$user->generateRegistrationNotify();
		} catch (\Exception $e) {
			#dd("GG");
			#Colocar Acá el fallback de lo que deba ocurrir cuando
		}


		\Session::push('success' , true);
		return redirect("usuarios/registrar");
	}

	public function showUpdateForm(Request $request){
		if(!Auth::user()->canDo('users.update')) return redirect('/401');
		$user = User::find($request->id);
		if (!$user) return view('errors.404');
		return view('modules.users.forms.data-form')->with('user', $user);
	}

	public function update(Request $request){
		if(!Auth::user()->canDo('users.update')) return redirect('/401');
		$user = User::find($request->id);
		if (!$user) return view('errors/404');

		$minDate = Carbon::now()->subYear(User::MIN_USER_AGE)->format('d/m/Y');
		#dd($request->birthdate);
		Validator::make($request->input(), [
			'cedula' => $user->cedula!=$request->cedula ? 'numeric|required|unique:users' : '',
			'firstname' => 'regex:/^[[:alpha:]]+( [[:alpha:]]+)?$/|required|min:3|max:45',
			'lastname' => 'regex:/^[[:alpha:]]+( [[:alpha:]]+)?$/|required|min:3|max:45',
			'user_type' => 'required',
			'email' => 'email|required',
			'phone' => 'numeric|required',
			'birthdate' => 'date_format:d/m/Y|required|before:'.$minDate,
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
		if(!Auth::user()->canDo('users.delete')) return redirect('/401');
		$user = User::find($request->user_id);
		if (!$user) return redirect('/404');

		$user->active = false;
		$user->save();

		\Session::push('success', true);
		return redirect("usuarios/listar")->with('users', User::all());
	}
	public function reactivate(Request $request){
		if(!Auth::user()->canDo('users.create')) return redirect('/401');
		$user = User::find($request->re_user_id);
		if (!$user) return redirect('/404');

		$user->active = true;
		$user->save();

		\Session::push('success', true);
		return redirect("usuarios/listar")->with('users', User::all());
	}

	public function delete(){
		if(!Auth::user()->canDo('users.delete')) return redirect('/401');
		return redirect("usuarios/listar")->with('users', User::all());
	}

	public function showProfile(Request $request){
		if (isset($request->id)) {
			$user = User::find($request->id);
			if($user == null){
				return view('erros.404');
			}
			return view('modules.users.profile')->with(['user' => $user]);
		}else {
			return view('modules.users.profile')->with(['user' => \Auth::user()]);
		}
	}

	public function updateData(Request $request){
		$user = User::find($request->user_id);
		if ($user == null) {
			return redirect('/404');
		}
		if(Auth::user()->id =! $user->id) return redirect('/401');
		Validator::make($request->input(), [
			'email' => 'email|required',
			'phone' => 'numeric|required'
		])->validate();

		$user->email == $request->email ?  : $user->email = $request->email;
		$user->phone == $request->phone ?  : $user->phone = $request->phone ;
		$user->save();

		\Session::push('success', true);
		return redirect('/usuarios/perfil/'.$user->id);
	}

	public function updatePassword(Request $request){
		$user = User::find($request->user_id);
		if ($user == null) {
			return redirect('/404');
		}
		if(Auth::user()->id =! $user->id) return redirect('/401');
		Validator::make($request->input(), [
			'password' => 'min:6|max:15|confirmed'
		])->validate();
		if (\Hash::check($request->oldpassword, $user->password)){
			$user->password = \Hash::make($request->password);
			$user->save();
			\Session::push('success', true);
			return redirect('/usuarios/perfil/'.$user->id);
		}else {
			return redirect('/404');
		}
	}
}
