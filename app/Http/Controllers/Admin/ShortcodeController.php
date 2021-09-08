<?php

namespace App\Http\Controllers\Admin;

use App\Models\Shortcode;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ShortcodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shortcodes = Shortcode::active()->get();
        return view('admin.shortcodes.index')->with(['shortcodes' => $shortcodes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.shortcodes.add-edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'key' => 'required',
        ],[
            'name.required' => 'Bạn chưa nhập tên người dùng',
            'key.required' => 'Bạn chưa nhập key shortcode',
        ]);

        $data = [
            'name' => $request->name,
            'key' => $request->key,
            'value' => $request->value,
            'user_id' => Auth::id(),
            'status' => isset($request->status) ? 1 : 0,
        ];

        $shortcode = Shortcode::create($data);

        if($shortcode){
            return redirect('admin/shortcodes')->with('success', 'Tạo thành công!');
        }
        else{
            return redirect('admin/shortcodes')->with('danger', 'Tạo thất bại!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $shortcode = Shortcode::findOrFail($id);
        return view('admin.shortcodes.add-edit')->with([
            'shortcode' => $shortcode
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'key' => 'required',
        ],[
            'name.required' => 'Bạn chưa nhập tên shortcode',
            'key.required' => 'Bạn chưa nhập key shortcode',
        ]);

        $shortcode = Shortcode::findOrFail($id);

        $data = [
            'name' => $request->name,
            'key' => $request->key,
            'value' => $request->value,
            'status' => isset($request->status) ? 1 : 0
        ];

        $update = $shortcode->update($data);

        if($update){
            return redirect('admin/shortcodes/edit/' . $id)->with('success', 'Sửa thành công!');
        }
        else{
            return redirect('admin/shortcodes/edit/'. $id)->with('danger', 'Sửa thất bại!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
