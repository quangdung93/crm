<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::all();
        return view('admin.menus.index')->with(['menus' => $menus]);
    }

    public function create()
    {
        return view('admin.menus.add-edit');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:menus',
        ],[
            'name.required' => 'Bạn chưa nhập tên menu',
            'name.unique' => 'Tên menu đã tồn tại',
        ]);

        $data['name'] = $request->name;

        $menu = Menu::create($data);

        if($menu){
            return redirect('admin/menus');
        }
        else{
            return redirect('admin/menus')->with('danger', 'Tạo thất bại!');
        }
    }

    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        return view('admin.menus.add-edit')->with(['menu' => $menu]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:menus,name,'.$id,
        ],[
            'name.required' => 'Bạn chưa nhập tên menu',
            'name.unique' => 'Tên menu đã tồn tại',
        ]);

        $menu = Menu::findOrFail($id);

        $data['name'] = $request->name;

        $update = $menu->update($data);

        if($update){
            return redirect('admin/menus/edit/'.$id)->with('success', 'Sửa thành công!');
        }
        else{
            return redirect('admin/menus/edit/'.$id)->with('danger', 'Tạo thất bại!');
        }
    }

    public function destroy($id)
    {   
        $menu = Menu::findOrFail($id);

        $delete = $menu->delete();

        if($delete){
            return redirect('admin/menus')->with('success', 'Xóa thành công!');
        }
        else{
            return redirect('admin/menus')->with('danger', 'Xóa thất bại!');
        }
    }
}
