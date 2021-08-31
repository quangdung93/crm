<?php

namespace App\Http\Controllers\Site;

use Auth;
use Corcel\Model\Page;
use Corcel\Model\Post;
use App\Models\Product;
use Corcel\Model\Taxonomy;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Corcel\WooCommerce\Model\Product as ProductCorcel;
use Corcel\WooCommerce\Model\ProductCategory as CategoryCorcel;

class HomeController extends Controller
{
    public function index(){
        return view('themes.kangen.homepage.index');
    }

    public function integrate(){
        dd($this->getProductWP());
        $posts = $this->getPostWordpress('product');
        dd(1);
    }

    public function getPostWordpress($postType){
        //Get Category Post
        $cat = Taxonomy::where('taxonomy', 'category')->with('posts')->first();

        //Get Post
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
        $products = ProductCorcel::limit(2)->get();
        foreach($products as $product){
            $attachData = data_get($product,'categories.*.term.term_id');
            dd($product->post_title, $product->attachment);
            $data = [
                'name' => $product->post_title,
                'sku' => $product->sku,
                'price_old' => $product->regular_price,
                'price' => $product->price,
                'discount' => round(($product->regular_price - $product->price) / $product->regular_price * 100, 2),
                'slug' => $product->post_name,
                'brand_id' => 1,
                'content' => $product->post_content,
                'meta_title' => $product->post_title,
                'image' => $product->image,
                'user_id' => Auth::id(),
            ];
            // $product = Product::create($data);
            // $product->categories()->attach($attachData);
        }

        return true;
    }

    public function getCategoryWP(){
        $categories = CategoryCorcel::all();
        // dd($categories[0]->term);
        $data = [];
        foreach($categories as $item){
            $category = $item->term;
            $data[] = [
                'id' => $category->term_id,
                'name' => $category->name,
                'slug' => $category->slug,
                'content' => null,
                'meta_title' => $category->name,
                'user_id' => Auth::id(),
            ];
        }

        // dd($data);

        $create = \App\Models\Category::insert($data);

        return true;
    }
}
