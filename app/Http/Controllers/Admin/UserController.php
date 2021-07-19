<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\User;

class UserController extends Controller
{
    //

    public function index(){
        $users = User::all();
        return view('admin.users.index')->with(compact('users'));
    }

    public function role(){
        $roles = Role::all();
        return view('admin.users.role')->with(compact('roles'));
    }

    public function createRole(){
        
    }
}
