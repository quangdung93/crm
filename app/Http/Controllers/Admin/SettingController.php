<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    public function index(){
        $settings = Setting::all();
        return view('admin.settings.index')->with([
            'settings' => $settings
        ]);
    }

    public function store(Request $request){
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
                $value = $imagePath;
            }

            Setting::where('key', $key)->update(['value' => $value]);
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
