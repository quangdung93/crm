<?php

namespace App\Http\Controllers\Site;

use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Http\Request;
use App\Services\PostService;
use App\Http\Controllers\Controller;

class PostCategoryController extends Controller
{
    protected $postService;

    public function __construct()
    {
        $this->postService = new PostService();
    }

    public function index($postCategory){
        $posts = $postCategory->posts()->with('categories')->orderByDesc('created_at')->paginate(10);
        $categorySiderbar = $this->postService->getCategorySiderBar();
        return view('themes.kangen.posts.category')->with([
            'postCategory' => $postCategory,
            'categorySiderbar' => $categorySiderbar,
            'posts' => $posts
        ]);
    }
}
