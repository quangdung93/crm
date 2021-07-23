<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use Illuminate\Support\Str;
use App\Models\PostCategory;
use Illuminate\Http\Request;
use App\Services\PostService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    protected $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function index(){
        return view('admin.posts.index');
    }

    public function getDatatable(){
        $posts = Post::orderByDesc('created_at')->get();
        return $this->postService->getDatatable($posts);
    }

    public function create(){
        $categories = PostCategory::active()->get();
        return view('admin.posts.add-edit')->with([
            'categories' => $categories
        ]);
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:posts',
            'category_id' => 'required'
        ],[
            'name.required' => 'Bạn chưa nhập tên bài viết',
            'slug.required' => 'Đường dẫn không được trống',
            'slug.unique' => 'Đường dẫn đã tồn tại',
            'category_id.required' => 'Bạn chưa chọn danh mục',
        ]);

        //Avatar image
        if($request->hasFile('input_file')){
            $avatarPath = $this->uploadImage('posts', $request->file('input_file'));
        }

        $data = [
            'name' => $request->name,
            'slug' => Str::slug($request->slug),
            'category_id' => $request->category_id,
            'author_id' => Auth::id(),
            'seo_title' => $request->seo_title,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
            'body' => $request->body,
            'status' => isset($request->status) ? 1 : 0,
            'image' => $avatarPath ?? null
        ];

        $post = Post::create($data);

        if($post){
            return redirect('admin/posts')->with('success', 'Tạo thành công!');
        }
        else{
            return redirect('admin/posts')->with('danger', 'Tạo thất bại!');
        }
    }

    public function edit($id){
        $post = Post::findOrFail($id);
        $categories = PostCategory::active()->get();
        return view('admin.posts.add-edit')->with([
            'post' => $post,
            'categories' => $categories
        ]);
    }

    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:posts,slug,'.$id,
            'category_id' => 'required'
        ],[
            'name.required' => 'Bạn chưa nhập tên bài viết',
            'slug.required' => 'Đường dẫn không được trống',
            'slug.unique' => 'Đường dẫn đã tồn tại',
            'category_id.required' => 'Bạn chưa chọn danh mục',
        ]);

        $post = Post::findOrFail($id);

        //Avatar image
        if($request->hasFile('input_file')){
            $avatarPath = $this->uploadImage('posts', $request->file('input_file'));
            if($avatarPath){
                $this->deleteImage($post->image);
            }
        }else{
            $avatarPath = $post->image;
        }

        $data = [
            'name' => $request->name,
            'slug' => $request->slug ? Str::slug($request->slug) : Str::slug($request->title),
            'category_id' => $request->category_id,
            'seo_title' => $request->seo_title,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
            'body' => $request->body,
            'status' => isset($request->status) ? 1 : 0,
            'image' => $avatarPath ?? null
        ];

        $update = $post->update($data);

        if($update){
            return redirect('admin/posts/edit/' . $id)->with('success', 'Sửa thành công!');
        }
        else{
            return redirect('admin/posts/edit/'. $id)->with('danger', 'Sửa thất bại!');
        }
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $delete = $post->delete();

        if($delete){
            return redirect('admin/posts')->with('success', 'Xóa thành công!');
        }
    }
}
