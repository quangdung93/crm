<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use App\Models\PostCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category_posts = PostCategory::all();
        return view('admin.posts.categories.index')->with('category_posts', $category_posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = PostCategory::all();
        return view('admin.posts.categories.add-edit')->with('categories', $categories);
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
            'name' => 'required|unique:categories_posts',
        ],[
            'name.required' => 'Bạn chưa nhập tên danh mục',
            'name.unique' => 'Tên danh mục đã tồn tại',
        ]);

        $data = [
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'status' => 1,
        ];

        $category = PostCategory::create($data);

        if($category){
            return redirect('admin/category_posts');
        }
        else{
            return redirect('admin/category_posts')->with('danger', 'Tạo thất bại!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PostCategory  $postCategory
     * @return \Illuminate\Http\Response
     */
    public function show(PostCategory $postCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PostCategory  $postCategory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $postCategory = PostCategory::findOrFail($id);
        return view('admin.posts.categories.add-edit')->with('postCategory', $postCategory);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PostCategory  $postCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $postCategory = PostCategory::findOrFail($id);
        $request->validate([
            'name' => 'required|unique:categories_posts,name,'.$id,
            'slug' => 'required|unique:categories_posts,slug,'.$id,
        ],[
            'name.required' => 'Bạn chưa nhập tên danh mục',
            'name.unique' => 'Tên danh mục đã tồn tại',
            'slug.unique' => 'Đường dẫn đã tồn tại',
        ]);

        $data = [
            'name' => $request->name,
            'slug' => $request->slug ? Str::slug($request->slug) : Str::slug($request->name),
            'status' => isset($request->status) ? 1 : 0,
        ];

        $update = $postCategory->update($data);

        if($update){
            return redirect('admin/category_posts/edit/' . $id)->with('success', 'Sửa thành công!');
        }
        else{
            return redirect('admin/category_posts/edit/'. $id)->with('danger', 'Sửa thất bại!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PostCategory  $postCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $postCategory = PostCategory::findOrFail($id);
        $delete = $postCategory->delete();

        if($delete){
            return redirect('admin/category_posts')->with('success', 'Xóa thành công!');
        }
    }
}
