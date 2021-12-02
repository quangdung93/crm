<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    protected $userModel;

    public function __construct(User $userModel){
        $this->userModel = $userModel;
    }
    //
    public function index(){
        $users = $this->userModel->getAllUser();
        return view('admin.users.index')->with(compact('users'));
    }

    public function create(){
        $roles = Role::all();
        return view('admin.users.add-edit')->with('roles', $roles);
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'username' => 'required|min:3|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'role' => 'required'
        ],[
            'name.required' => 'Bạn chưa nhập tên người dùng',
            'username.required' => 'Bạn chưa nhập username',
            'username.min' => 'Username phải nhiều hơn 3 ký tự',
            'username.unique' => 'Username đã tồn tại',
            'email.required' => 'Bạn chưa nhập email',
            'email.email' => 'Định dạng email không đúng',
            'email.unique' => 'Email đã tồn tại',
            'password.required' => 'Bạn chưa nhập mật khẩu',
            'role.required' => 'Bạn chưa chọn quyền'
        ]);

        //Avatar image
        if($request->hasFile('input_file')){
            $avatarPath = $this->uploadImage('users', $request->file('input_file'));
        }

        $data = [
            'name' => $request->name,
            'username' => Str::slug($request->username),
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => isset($request->status) ? 1 : 0,
            'avatar' => $avatarPath ?? '/admin/images/user-default.png'
        ];

        $user = User::create($data);

        //Assign Role
        if($user && $request->role){
            $user->assignRole($request->role);

            return redirect('admin/users');
        }
        else{
            return redirect('admin/users')->with('danger', 'Tạo thất bại!');
        }
    }

    public function edit($id){
        $user = $this->userModel->findUser($id);

        if(!$user){
            return abort('404');
        }

        $roles = Role::all();
        return view('admin.users.add-edit')->with([
            'roles' => $roles,
            'user' => $user
        ]);
    }

    public function update(Request $request, $id){
        $user = $this->userModel->findUser($id);

        if(!$user){
            return abort('404');
        }

        $request->validate([
            'name' => 'required',
            'username' => 'required|min:3|unique:users,username,'.$user->id,
            'email' => 'required|email|unique:users,email,'.$user->id,
            'role' => 'required'
        ],[
            'name.required' => 'Bạn chưa nhập tên người dùng',
            'username.required' => 'Bạn chưa nhập username',
            'username.min' => 'Username phải nhiều hơn 3 ký tự',
            'username.unique' => 'Username đã tồn tại',
            'email.required' => 'Bạn chưa nhập email',
            'email.email' => 'Định dạng email không đúng',
            'email.unique' => 'Email đã tồn tại',
            'role.required' => 'Bạn chưa chọn quyền'
        ]);

        //Avatar image
        if($request->hasFile('input_file')){
            $avatarPath = $this->uploadImage('users', $request->file('input_file'));
            if($avatarPath){
                $this->deleteImage($user->image);
            }
        }else{
            $avatarPath = $user->avatar;
        }

        $data = [
            'name' => $request->name,
            'username' => Str::slug($request->username),
            'email' => $request->email,
            'status' => isset($request->status) ? 1 : 0,
            'avatar' => $avatarPath ?? null
        ];

        //Change password
        if($request->password){
            $data['password'] = Hash::make($request->password);
        }

        $update = $user->update($data);

        //Assign Role
        if($request->role){
            $user->syncRoles($request->role);
        }

        return redirect('admin/users/edit/'.$id)->with('success','Cập nhật thành công!');
    }

    public function destroy($id){
        $user = $this->userModel->findUser($id);

        if(!$user){
            return abort('404');
        }
        $delete = $user->delete();

        if($delete){
            return redirect('admin/users')->with('success', 'Xóa thành công!');
        }
    }
}
