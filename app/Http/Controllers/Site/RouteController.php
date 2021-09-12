<?php

namespace App\Http\Controllers\Site;

use App\Models\Page;
use App\Models\Post;
use App\Models\Product;
use App\Models\Category;
use App\Models\PostCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RouteController extends Controller
{
    public function handle($model){
        if($model instanceof Post){
            return (new PostController)->detail($model);
        }
        else if($model instanceof Product){
            return (new ProductController)->detail($model);
        }
        else if($model instanceof PostCategory){
            return (new PostCategoryController)->index($model);
        }
        else if($model instanceof Category){
            return (new CategoryController)->index($model);
        }
        else if($model instanceof Page){
            return (new PageController)->detail($model);
        }
        else if($model == 'san-pham'){ //custom route
            return (new ProductController)->index(); 
        }
        else if($model == 'tim-kiem'){ //Search
            return (new SearchController)->index(); 
        }
        else{
            abort('404');
        }
    }
}
