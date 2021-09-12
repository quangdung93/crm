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
                    'metaData' => $this->getMetaData($post),
                    'post' => $post,
                    'categorySiderbar' => $categorySiderbar,
                    'postRelated' => $postRelated,
                ]);
    }

    public function getMetaData($model){
        return [
            'title' => $model->seo_title ?: $model->name,
            'description' => $model->meta_description,
            'keyword' => $model->meta_keywords,
            'image' => $model->image,
        ];
    }
}
