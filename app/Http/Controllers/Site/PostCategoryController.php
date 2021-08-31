<?php

namespace App\Http\Controllers\Site;

use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostCategoryController extends Controller
{
    public function index($postCategory){
        $posts = $postCategory->posts()->with('categories')->orderByDesc('created_at')->paginate(10);
        $categorySiderbar = PostCategory::where('id', 126)->with('posts')->first();
        return view('themes.kangen.posts.category.index')->with([
            'postCategory' => $postCategory,
            'categorySiderbar' => $categorySiderbar,
            'posts' => $posts
        ]);
    }
}
