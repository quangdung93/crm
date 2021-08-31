<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index($category){
        $category->load('products');
        return view('themes.kangen.category.index')->with(['category' => $category]);
    }
}
