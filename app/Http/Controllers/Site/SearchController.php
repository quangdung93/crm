<?php

namespace App\Http\Controllers\Site;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    public function index(){
        $keyword = request()->input('key');

        $products = Product::where('name', 'like', '%'.$keyword.'%')->paginate(20);

        return view('themes.kangen.products.search')->with([
            'metaData' => $this->getMetaData($keyword, $products),
            'products' => $products
        ]);
    }

    public function getMetaData($keyword, $products){
        return [
            'title' => 'Kết quả tìm kiếm',
            'description' => 'Kết quả tìm kiếm từ khóa '.$keyword,
            'keyword' => $keyword,
            'image' => @$products->first()->image,
        ];
    }
}
