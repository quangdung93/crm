<?php

namespace App\Http\Controllers\Site;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    protected $productService;

    public function __construct()
    {
        $this->productService = new ProductService();
    }

    public function index(){
        $products = Product::limit(20)->paginate(20);
        return view('themes.kangen.products.index')->with(['products' => $products]);
    }

    public function detail($product){
        $product->handleContent();

        $productRelated = $this->productService->getProductRelated($product->categories->pluck('id')->toArray());
        return view('themes.kangen.products.detail')->with([
            'product' => $product,
            'productRelated' => $productRelated,
        ]);
    }
}
