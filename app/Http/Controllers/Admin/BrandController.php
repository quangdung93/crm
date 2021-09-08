<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::all();
        return view('admin.brands.index')->with('brands', $brands);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.brands.add-edit');
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
            'slug' => 'required|unique:brands'
        ],[
            'name.required' => 'Bạn chưa nhập tên thương hiệu',
            'slug.required' => 'Đường dẫn không được trống',
            'slug.unique' => 'Đường dẫn đã tồn tại'
        ]);

        //Avatar image
        if($request->hasFile('image')){
            $avatarPath = $this->uploadImage('brands', $request->file('image'));
        }

        $data = $request->all();
        $data['slug'] = Str::slug($request->slug);
        $data['image'] = $avatarPath ?? null;
        $data['status'] = isset($request->status) ? 1 : 0;

        $brand = Brand::create($data);

        if($brand){
            return redirect('admin/brands')->with('success', 'Tạo thành công!');
        }
        else{
            return redirect('admin/brands')->with('danger', 'Tạo thất bại!');
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
        $brand = Brand::findOrFail($id);
        return view('admin.brands.add-edit')->with([
            'brand' => $brand,
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
            'slug' => 'required|unique:brands,slug,'.$id,
        ],[
            'name.required' => 'Bạn chưa nhập tên thương hiệu',
            'slug.required' => 'Đường dẫn không được trống',
            'slug.unique' => 'Đường dẫn đã tồn tại',
        ]);

        $brand = Brand::findOrFail($id);

        //Avatar image
        if($request->hasFile('image')){
            $avatarPath = $this->uploadImage('brands', $request->file('image'));
            if($avatarPath){
                $this->deleteImage($brand->image);
            }
        }else{
            $avatarPath = $brand->image;
        }

        $data = $request->all();
        $data['slug'] = Str::slug($request->slug);
        $data['image'] = $avatarPath ?? null;
        $data['status'] = isset($request->status) ? 1 : 0;

        $update = $brand->update($data);

        if($update){
            return redirect('admin/brands/edit/' . $id)->with('success', 'Sửa thành công!');
        }
        else{
            return redirect('admin/brands/edit/'. $id)->with('danger', 'Sửa thất bại!');
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
        $brand = Brand::findOrFail($id);
        $delete = $brand->delete();

        if($delete){
            return redirect('admin/brands')->with('success', 'Xóa thành công!');
        }
    }
}
