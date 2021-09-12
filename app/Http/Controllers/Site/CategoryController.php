<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index($category){
        $products = $category->products()->with('categories')->orderByDesc('created_at')->paginate(16);
        return view('themes.kangen.category.index')->with([
            'metaData' => $this->getMetaData($category),
            'category' => $category,
            'products' => $products
        ]);
    }

    public function getMetaData($model){
        return [
            'title' => $model->meta_title ?: $model->name,
            'description' => $model->meta_description,
            'keyword' => $model->meta_keyword,
            'image' => $model->load('products')->products->first()->image,
        ];
    }
}
