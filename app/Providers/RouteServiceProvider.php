<?php

namespace App\Providers;

use App\Models\Page;
use App\Models\Post;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Models\PostCategory;
use App\Models\RedirectLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->removeIndexPhpFromUrl();
        
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::middleware('web')
                ->group(base_path('routes/web.php'));

            Route::prefix('api')
                ->middleware('api')
                ->group(base_path('routes/api.php'));
        });

        //Custom route
        Route::bind('url', function ($path) {
            $redirect = RedirectLink::where('from_url', $path)->first();
            if($redirect){
                return $redirect;
            }

            $slugs = explode('/', $path);

            if(count($slugs) == 2){ //Multi level route

                //Post
                if($slugs[0] === config('stableweb.prefix.post.slug')){
                    $post = Post::where('slug', $slugs[1])->first();
                    if($post){
                        return $post;
                    }
                }

                //Product
                if($slugs[0] === config('stableweb.prefix.product.slug')){
                    $product = Product::where('slug', $slugs[1])->first();
                    if($product){
                        return $product;
                    }
                }
                //Post Category Multi level
                return $this->handleRoutePostCategory($slugs);
            }
            else{ //Single level route
                $model = $this->handleRouteSingle($path);
                if($model){
                    return $model;
                }

                return $path;
            }
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60);
        });
    }

    private function handleRouteSingle($path){
        //Product Category
        $model = Category::where('slug', $path)->first();
        if($model){
            return $model;
        }

        //Post Category Single Level (Parent)
        $model = PostCategory::where('slug', $path)->first();
        if($model){
            return $model;
        }

        //Post Category Single Level (Parent)
        $model = Page::where('slug', $path)->first();
        if($model){
            return $model;
        }
    }

    private function handleRoutePostCategory($slugs){
        // Look up all categories and key by slug for easy look-up
        $categories = PostCategory::whereIn('slug', $slugs)->get()->keyBy('slug');
        if($categories){
            $parent = null;   
            foreach ($slugs as $slug) {
                $category = $categories->get($slug);
                // Category with slug does not exist
                if (!$category) {
                    abort(404);
                    // throw (new ModelNotFoundException)->setModel(PostCategory::class);
                }
        
                // Check this category is child of previous category
                if ($parent && $category->parent_id != $parent->getKey()) {
                    // Throw 404 if this category is not child of previous one
                    abort(404);
                }
        
                // Set $parent to this category for next iteration in loop
                $parent = $category;
            }

            // All categories exist and are in correct hierarchy
            // Return last category as route binding
            return $category;
        }
    }

    protected function removeIndexPhpFromUrl()
    {
        if (Str::startsWith(request()->getRequestUri(), '/index.php')) {
            $url = str_replace('/index.php', '', request()->getRequestUri());
            $url = request()->getSchemeAndHttpHost() . Str::start($url, '/');

            if (strlen($url) > 0) {
                header("Location: $url", true, 301);
                exit;
            }
        }
    }
}
