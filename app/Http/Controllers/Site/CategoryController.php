<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index($category){
        $products = $category->products()->with('categories')->orderByDesc('created_at')->paginate(16);
        return view('themes.kangen.category.index')->with([
            'category' => $category,
            'products' => $products
        ]);
    }
}
