<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Services\PostService;
use Illuminate\Http\Request;

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
}
