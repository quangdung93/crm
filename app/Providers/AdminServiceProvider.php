<?php

namespace App\Providers;

use App\Models\Page;
use App\Models\Post;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\PostCategory;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Relations\Relation;

class AdminServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Relation::morphMap([
            'post' => Post::class,
            'product' => Product::class,
            'page' => Page::class,
            'category' => Category::class,
            'brand' => Brand::class,
            'postcategory' => PostCategory::class,
        ]);
    }
}
