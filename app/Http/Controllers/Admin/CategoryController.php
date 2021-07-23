<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::with('parent')->get();
        return view('admin.categories.index')->with('categories', $categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::active()->get();
        return view('admin.categories.add-edit')->with('categories', $categories);
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
            'slug' => 'required|unique:categories'
        ],[
            'name.required' => 'Bạn chưa nhập tên danh mục',
            'slug.required' => 'Đường dẫn không được trống',
            'slug.unique' => 'Đường dẫn đã tồn tại'
        ]);

        $data = [
            'name' => $request->name,
            'slug' => Str::slug($request->slug),
            'father_id' => $request->father_id ?? null,
            'user_id' => Auth::id(),
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keyword' => $request->meta_keyword,
            'content' => $request->content,
            'status' => isset($request->status) ? 1 : 0,
        ];

        $category = Category::create($data);

        if($category){
            return redirect('admin/categories')->with('success', 'Tạo thành công!');
        }
        else{
            return redirect('admin/categories')->with('danger', 'Tạo thất bại!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $Category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $Category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $Category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $categories = Category::where('id', '!=', $category->id)->active()->get();
        return view('admin.categories.add-edit')->with([
            'category' => $category,
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $Category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:categories,slug,'.$id,
        ],[
            'name.required' => 'Bạn chưa nhập tên danh mục',
            'slug.required' => 'Đường dẫn không được trống',
            'slug.unique' => 'Đường dẫn đã tồn tại',
        ]);

        $category = Category::findOrFail($id);

        $data = [
            'name' => $request->name,
            'slug' => $request->slug ? Str::slug($request->slug) : Str::slug($request->title),
            'father_id' => $request->father_id ?? null,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keyword' => $request->meta_keyword,
            'content' => $request->content,
            'status' => isset($request->status) ? 1 : 0
        ];

        $update = $category->update($data);

        if($update){
            return redirect('admin/categories/edit/' . $id)->with('success', 'Sửa thành công!');
        }
        else{
            return redirect('admin/categories/edit/'. $id)->with('danger', 'Sửa thất bại!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $Category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $delete = $category->delete();

        if($delete){
            return redirect('admin/categories')->with('success', 'Xóa thành công!');
        }
    }
}
