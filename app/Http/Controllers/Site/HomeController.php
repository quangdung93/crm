<?php

namespace App\Http\Controllers\Site;

use App\Models\Post;
use App\Models\Category;
use App\Models\PostCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Arr;

class HomeController extends Controller
{
    public function index(){
        $newPosts = Post::active()->orderByDesc('created_at')->limit(5)->get();
        $home_section_news = theme('home_section_news');
        $listPostCategory = Arr::pluck($home_section_news, 'category_id');
        if($listPostCategory){
            $listNews = PostCategory::whereIn('id', $listPostCategory)
                                    ->with('posts')->get();
        }
        return view('themes.kangen.homepage.index')->with([
            'newPosts' => $newPosts,
            'listNews' => $listNews ?? [],
        ]);
    }
}
