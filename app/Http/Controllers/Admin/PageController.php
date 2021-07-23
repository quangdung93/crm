<?php

namespace App\Http\Controllers\Admin;

use App\Models\Page;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Page::active()->get();
        return view('admin.pages.index')->with(['pages' => $pages]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.add-edit');
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
            'slug' => 'required|unique:pages',
        ],[
            'name.required' => 'Bạn chưa nhập tên người dùng',
            'slug.required' => 'Đường dẫn không được trống',
            'slug.unique' => 'Đường dẫn đã tồn tại',
        ]);

        //Avatar image
        if($request->hasFile('input_file')){
            $avatarPath = $this->uploadImage('pages', $request->file('input_file'));
        }

        $data = [
            'name' => $request->name,
            'slug' => Str::slug($request->slug),
            'author_id' => Auth::id(),
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
            'body' => $request->body,
            'status' => isset($request->status) ? 1 : 0,
            'image' => $avatarPath ?? null
        ];

        $page = Page::create($data);

        if($page){
            return redirect('admin/pages')->with('success', 'Tạo thành công!');
        }
        else{
            return redirect('admin/pages')->with('danger', 'Tạo thất bại!');
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
        $page = Page::findOrFail($id);
        return view('admin.pages.add-edit')->with([
            'page' => $page
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
            'slug' => 'required|unique:pages,slug,'.$id,
        ],[
            'name.required' => 'Bạn chưa nhập tên người dùng',
            'slug.required' => 'Đường dẫn không được trống',
            'slug.unique' => 'Đường dẫn đã tồn tại',
        ]);

        $page = Page::findOrFail($id);

        //Avatar image
        if($request->hasFile('input_file')){
            $avatarPath = $this->uploadImage('pages', $request->file('input_file'));
            if($avatarPath){
                $this->deleteImage($page->image);
            }
        }else{
            $avatarPath = $page->image;
        }

        $data = [
            'name' => $request->name,
            'slug' => $request->slug ? Str::slug($request->slug) : Str::slug($request->title),
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
            'body' => $request->body,
            'status' => isset($request->status) ? 1 : 0,
            'image' => $avatarPath ?? null
        ];

        $update = $page->update($data);

        if($update){
            return redirect('admin/pages/edit/' . $id)->with('success', 'Sửa thành công!');
        }
        else{
            return redirect('admin/pages/edit/'. $id)->with('danger', 'Sửa thất bại!');
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
        $page = Page::findOrFail($id);
        $delete = $page->delete();

        if($delete){
            return redirect('admin/pages')->with('success', 'Xóa thành công!');
        }
    }
}
