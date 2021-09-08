<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index(){
        $settings = Setting::all();
        return view('admin.settings.index')->with([
            'settings' => $settings
        ]);
    }

    public function store(Request $request){
        $request->validate([
            'display_name' => 'required',
            'key' => 'required|unique:settings',
        ],[
            'display_name.required' => 'Bạn chưa nhập tên hiển thị',
            'key.required' => 'Key không được trống',
            'key.unique' => 'Key đã tồn tại',
        ]);

        $data = $request->all();
        $data['order'] = (int)Setting::where('group', $data['group'])->max('order') + 1;
        $setting = Setting::create($data);

        if($setting){
            return redirect('admin/settings')->withSuccess('Tạo thành công!');
        }
        else{
            return redirect('admin/settings')->with('danger', 'Tạo thất bại!');
        }
    }

    public function update(Request $request)
    {
        $data = $request->except('_token');
        foreach ($data as $key => $value) {

            //Image
            if($request->hasFile($key)){
                $imagePath = $this->uploadImage('settings', $request->file($key));
                if($imagePath){
                    $setting = Setting::where('key', $key)->first();
                    $this->deleteImage($setting->value);
                    $value = $imagePath;
                }
            }

            $setting = Setting::where('key', $key)->first();
            $update = $setting->update(['value' => $value]);
        }

        return redirect('admin/settings')->with('success','Cập nhật thành công!');
    }

    public function destroy($id)
    {
        $setting = Setting::findOrFail($id);

        $delete = $setting->delete();

        if($delete){
            return redirect('admin/settings')->withSuccess('Xóa thành công!');
        }
        else{
            return redirect('admin/settings')->with('danger', 'Xóa thất bại!');
        }
    }

    public function order(Request $request){
        $order = $request->order;
        
        foreach ($order as $item) {
            Setting::where('id', $item['id'])->update(['order' => $item['order']]);
        }

        return response()->json(['status' => true]);
    }
}
