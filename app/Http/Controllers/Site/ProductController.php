<?php

namespace App\Http\Controllers\Site;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Helpers\SchemaHelper;
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
        
        //Schema
        $schema = SchemaHelper::schemaProduct($product);
        
        return view('themes.kangen.products.detail')->with([
            'metaData' => $this->getMetaData($product),
            'schema' => $schema,
            'product' => $product,
            'productRelated' => $productRelated,
        ]);
    }

    public function getMetaData($model){
        return [
            'title' => $model->meta_title ?: $model->name,
            'description' => $model->meta_description,
            'keyword' => $model->meta_keyword,
            'image' => $model->image,
        ];
    }
}
