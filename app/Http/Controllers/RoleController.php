<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Auth;
use App\Role;
use App\User;
use App\Permission;
class RoleController extends Controller{

    public function index(Request $request){
        return view('modules.roles.index');
    }
    public function showDataForm(Request $request){
        dd(Auth::user()->roles->first()->permissions);
        return view('modules.roles.data-form');
    }
    public function showUpdateForm(Request $request){
        return view('modules.roles.data-form');
    }
    public function update(Request $request){
        return redirect('/roles/ver/'.$role->id);
    }
    public function register(Request $request){
        return redirect('/roles/ver/'.$role->id);
    }
    public function view(Request $request){
        return view('modules.roles.view');
    }


}
