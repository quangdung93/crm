<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Hash;

class LoginController extends Controller
{
    use AuthenticatesUsers;
    protected $redirectTo = '/admin/dashbroad';

    public function __construct()
    {
        
    }

    public function login(){
        return view('auth.login');
    }

    public function postLogin(Request $request){
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ],[
            'username.required' => 'Bạn chưa nhập tên đăng nhập',
            'password.required' => 'Bạn chưa nhập mật khẩu'
        ]);

        $credentials = [
            'username' => $request->username,
            'password' => $request->password,
            'status' => 1
        ];

        if (Auth::attempt($credentials, $request->has('remember'))) {
            return redirect('admin/dashbroad');
        }

        return redirect("login")->with('login_failed', 'Tên đăng nhập hoặc mật khẩu không đúng!');
    }

    public function logout(){
        \Auth::logout();
        return redirect(url('login'));
    }
}
