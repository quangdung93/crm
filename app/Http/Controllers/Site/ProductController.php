<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        $products = Product::limit(20)->paginate(20);
        return view('themes.kangen.products.index')->with(['products' => $products]);
    }

    public function detail(){

    }
}
