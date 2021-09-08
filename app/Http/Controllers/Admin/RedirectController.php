<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use App\Models\RedirectLink;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RedirectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $redirects = RedirectLink::all();
        return view('admin.redirects.index')->with('redirects', $redirects);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.redirects.add-edit');
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
            'from_url' => 'required|unique:redirect_links',
            'to_url' => 'required'
        ],[
            'from_url.required' => 'Bạn chưa nhập đường dẫn gốc',
            'from_url.unique' => 'Đường dẫn gốc đã tồn tại',
            'to_url.required' => 'Bạn chưa nhập đường dẫn đến',
        ]);

        $data = [
            'from_url' => Str::replace(url('/'),'', $request->from_url),
            'to_url' => Str::replace(url('/'),'', $request->to_url),
        ];

        $redirect = RedirectLink::create($data);

        if($redirect){
            return redirect('admin/redirects')->with('success', 'Tạo thành công!');
        }
        else{
            return redirect('admin/redirects')->with('danger', 'Tạo thất bại!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Redirect  $redirect
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Redirect  $redirect
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $redirect = RedirectLink::findOrFail($id);
        return view('admin.redirects.add-edit')->with([
            'redirect' => $redirect,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Redirect  $redirect
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'from_url' => 'required|unique:redirect_links,from_url,'.$id,
            'to_url' => 'required'
        ],[
            'from_url.required' => 'Bạn chưa nhập đường dẫn gốc',
            'from_url.unique' => 'Đường dẫn gốc đã tồn tại',
            'to_url.required' => 'Bạn chưa nhập đường dẫn đến',
        ]);

        $redirect = RedirectLink::findOrFail($id);

        $data = [
            'from_url' => Str::replace(url('/'),'', $request->from_url),
            'to_url' => Str::replace(url('/'),'', $request->to_url),
        ];

        $update = $redirect->update($data);

        if($update){
            return redirect('admin/redirects/edit/' . $id)->with('success', 'Sửa thành công!');
        }
        else{
            return redirect('admin/redirects/edit/'. $id)->with('danger', 'Sửa thất bại!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Redirect  $redirect
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $redirect = RedirectLink::findOrFail($id);
        $delete = $redirect->delete();

        if($delete){
            return redirect('admin/redirects')->with('success', 'Xóa thành công!');
        }
    }
}
