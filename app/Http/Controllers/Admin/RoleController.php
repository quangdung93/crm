<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
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
        // foreach($this->listPermission as $per){
        //     Permission::create(['name' => 'read_'.$per, 'groups' => $per]);
        //     Permission::create(['name' => 'add_'.$per, 'groups' => $per]);
        //     Permission::create(['name' => 'edit_'.$per, 'groups' => $per]);
        //     Permission::create(['name' => 'delete_'.$per, 'groups' => $per]);
        // }
        return redirect('admin/roles');
    }

    public function edit(Request $request, $id){
        $role = Role::findOrFail($id)->load('permissions');
        $permissions = Permission::all();
        return view('admin.roles.edit')
            ->with([
                'role' => $role, 
                'permissions' => $permissions->groupBy('groups')
            ]);
    }

    public function update(Request $request, $id){
        $role = Role::findOrFail($id);
        $role->name = Str::slug($request->name);
        $role->display_name = $request->display_name;
        $role->save();
        $role->syncPermissions(array_keys($request->permission));

        return redirect('admin/roles/edit/'.$id);
    }
}
