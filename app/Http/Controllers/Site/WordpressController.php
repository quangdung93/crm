<?php

namespace App\Http\Controllers\Site;

use Auth;
use Corcel\Model\Page;
use Corcel\Model\Post;
use App\Models\Product;
use Corcel\Model\Taxonomy;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Corcel\WooCommerce\Model\Product as ProductCorcel;
use Corcel\WooCommerce\Model\ProductCategory as CategoryCorcel;

class WordpressController extends Controller
{
    public function integrate(){
        dd($this->getPage());
    }

    public function getPost(){
        //Get Post
        $posts = Post::where('post_type', 'post')->with('taxonomies')->get();
        
        foreach($posts as $post){
            $attachData = data_get($post,'taxonomies.*.term.term_id');
            $data = [
                'name' => $post->post_title,
                'slug' => $post->post_name,
                'body' => $post->post_content,
                'seo_title' => $post->post_title,
                'image' => $post->image,
                'author_id' => Auth::id(),
            ];
            $post = \App\Models\Post::create($data);
            $post->categories()->attach($attachData);
        }

        return true;
    }

    public function getPage(){
        $pages = Page::all();

        foreach($pages as $page){
            $data = [
                'name' => $page->post_title,
                'slug' => $page->post_name ?: Str::slug($page->post_title),
                'body' => $page->post_content,
                'meta_title' => $page->post_title,
                'image' => $page->image,
                'author_id' => Auth::id(),
            ];

            $page = \App\Models\Page::create($data);
        }

        return true;
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
        $create = \App\Models\Category::insert($data);
        return true;
    }

    public function getPostCategoryWP(){
        $categories = Taxonomy::where('taxonomy', 'category')->get();
        $data = [];
        foreach($categories as $item){
            $category = $item->term;
            $data[] = [
                'id' => $category->term_id,
                'name' => $category->name,
                'slug' => $category->slug,
            ];
        }
        $create = \App\Models\PostCategory::insert($data);
        return true;
    }
}
