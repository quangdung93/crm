<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    protected $listPermission = ['users','roles','posts','products','pages','menus','settings'];
    
    public function index(){
        $roles = Role::all();
        return view('admin.roles.index')->with(compact('roles'));
    }

    public function create(){
        return view('admin.roles.add');
    }

    public function store(Request $request){
        $data = [
            'name' => Str::slug($request->name),
            'display_name' => $request->display_name
        ];
        Role::create($data);
        
        return redirect('admin/roles');
    }

    public function edit(Request $request, $id){
        $role = Role::findOrFail($id)->load('permissions');

        //Check permission edit
        if($role->name == config('permission.role_dev') 
        && !Auth::user()->hasRole(config('permission.role_dev'))){
            return abort(403);
        }

        $permissions = Permission::all();
        return view('admin.roles.edit')
            ->with([
                'role' => $role, 
                'permissions' => $permissions->groupBy('groups')
            ]);
    }

    public function update(Request $request, $id){
        $role = Role::findOrFail($id);

        //Check permission edit
        if($role->name == config('permission.role_dev') 
        && !Auth::user()->hasRole(config('permission.role_dev'))){
            return abort(403);
        }

        $role->name = Str::slug($request->name);
        $role->display_name = $request->display_name;
        $role->save();
        $role->syncPermissions(array_keys($request->permission));

        return redirect('admin/roles/edit/'.$id)->with('success','Cập nhật thành công!');
    }

    public function createPermission(Request $request){
        if(Auth::user()->roles->first()->name != config('permission.role_dev')){
            return abort(403);
        }

        $permission = $request->permission;
        Permission::create(['name' => 'read_'.$permission, 'groups' => $permission]);
        Permission::create(['name' => 'add_'.$permission, 'groups' => $permission]);
        Permission::create(['name' => 'edit_'.$permission, 'groups' => $permission]);
        Permission::create(['name' => 'delete_'.$permission, 'groups' => $permission]);

        return 'Create Permission Success!';
    }
}
