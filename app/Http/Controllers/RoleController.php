<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Auth;
use App\Role;
use App\User;
use App\Permission;
class RoleController extends Controller{

    public function index(Request $request){
        return view('modules.roles.list')->with('roles', Role::all());
    }
    public function showDataForm(Request $request){
        #dd(Auth::user()->roles->first()->permissions);
        return view('modules.roles.forms.data-form')->with(['permissions' => Permission::getByCategory()]);
    }
    public function showUpdateForm(Request $request){
		$role = Role::find($request->id);
		if($role == null){
			return view('errors.404');
		}
        return view('modules.roles.forms.data-form')->with(['role' => $role,'permissions' => Permission::getByCategory()]);
    }
    public function update(Request $request){
        return redirect('/roles/ver/'.$role->id);
    }
    public function register(Request $request){
        return redirect('/roles/ver/'.$role->id);
    }
    public function view(Request $request){
        $role = Role::find($request->id);
        if($role == null){
            return view('errors.404');
        }
        return view('modules.roles.view')->with('role', $role);
    }


}
