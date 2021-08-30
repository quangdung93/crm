<?php

namespace App\Http\Controllers\Site;

use Corcel\Model\Page;
use Corcel\Model\Post;
use Corcel\WooCommerce\Model\Product as ProductCorcel;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index(){
        return view('themes.kangen.homepage.index');
    }

    public function integrate(){
        $posts = $this->getPostWordpress('product');
        $products = $this->getProductWP();
        dd($products[0]->post_name);
        $data = [];
        foreach($products as $product){
            $data[] = [
                'name' => $product->post_title,
                'sku' => $product->sku,
                'price_old' => $product->regular_price,
                'price_new' => $product->price,
                'slug' => $product->post_name,
            ];
        }
    }

    public function getPostWordpress($postType){
        $post = Post::where('post_type', $postType)
                    ->orderByDesc('post_date')
                    ->first();
        $image = $post->thumbnail->attachment;
        $imageUrl = $post->image;

        return $post;
    }

    public function getPageWordpress(){
        $page = Page::all();

        return $page;
    }

    public function getProductWP(){
        $products = ProductCorcel::limit(3)->get();
        return $products;
    }
}
