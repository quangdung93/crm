<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Services\PostService;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    protected $postService;

    public function __construct()
    {
        $this->postService = new PostService();
    }
    
    public function detail($post){
        $post->load('categories');

        //Handle content post
        $post->handleContentPost();
        //Get siderbar category
        $categorySiderbar = $this->postService->getCategorySiderBar();
        $postRelated = $this->postService->getPostRelated($post->categories->pluck('id')->toArray());
        return view('themes.kangen.posts.detail')
                ->with([
                    'post' => $post,
                    'categorySiderbar' => $categorySiderbar,
                    'postRelated' => $postRelated,
                ]);
    }
}
