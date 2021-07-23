<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\ThemeController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PostCategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//Login
Route::get('/login', [LoginController::class, 'login']);
Route::post('/login', [LoginController::class, 'postLogin'])->name('login');


//Admin
Route::group(['prefix' => 'admin','middleware' => 'auth'], function () {
    Route::get('/dashbroad', [DashboardController::class, 'index'])->name('dashbroad');
    Route::get('/logout', [LoginController::class, 'logout']);

    //User
    Route::group(['prefix' => 'users', 'middleware' => ['can:read_users']], function () {
        Route::get('/', [UserController::class, 'index']);
        Route::get('/create', [UserController::class, 'create'])->middleware('can:add_users');
        Route::post('/create', [UserController::class, 'store'])->middleware('can:add_users');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->middleware('can:edit_users');
        Route::post('/edit/{id}', [UserController::class, 'update'])->middleware('can:edit_users');
        Route::get('/delete/{id}', [UserController::class, 'destroy'])->middleware('can:delete_users');
    });

    //Role
    Route::group(['prefix' => 'roles', 'middleware' => ['can:read_roles']], function () {
        Route::get('/', [RoleController::class, 'index']);
        Route::get('/create', [RoleController::class, 'create'])->middleware('can:add_roles');
        Route::post('/create', [RoleController::class, 'store'])->middleware('can:add_roles');
        Route::get('/edit/{id}', [RoleController::class, 'edit'])->middleware('can:edit_roles');
        Route::post('/edit/{id}', [RoleController::class, 'update'])->middleware('can:edit_roles');

        //Create permission // url : /admin/roles/create_permission/{permission_group_name}
        Route::get('/create_permission/{permission}', [RoleController::class, 'createPermission'])
        ->middleware('role:'.config('permission.role_dev'));
    });

    //Page
    Route::group(['prefix' => 'pages', 'middleware' => ['can:read_pages']], function () {
        Route::get('/', [PageController::class, 'index']);
        Route::get('/create', [PageController::class, 'create'])->middleware('can:add_pages');
        Route::post('/create', [PageController::class, 'store'])->middleware('can:add_pages');
        Route::get('/edit/{id}', [PageController::class, 'edit'])->middleware('can:edit_pages');
        Route::post('/edit/{id}', [PageController::class, 'update'])->middleware('can:edit_pages');
        Route::get('/delete/{id}', [PageController::class, 'destroy'])->middleware('can:delete_pages');
    });

    //Post
    Route::group(['prefix' => 'posts', 'middleware' => ['can:read_posts']], function () {
        Route::get('/', [PostController::class, 'index']);
        Route::get('datatable', [PostController::class,'getDatatable'])->name('posts.view');
        Route::get('/create', [PostController::class, 'create'])->middleware('can:add_posts');
        Route::post('/create', [PostController::class, 'store'])->middleware('can:add_posts');
        Route::get('/edit/{id}', [PostController::class, 'edit'])->middleware('can:edit_posts');
        Route::post('/edit/{id}', [PostController::class, 'update'])->middleware('can:edit_posts');
        Route::get('/delete/{id}', [PostController::class, 'destroy'])->middleware('can:delete_posts');
    });

    //Category Post
    Route::group(['prefix' => 'category_posts', 'middleware' => ['can:read_posts']], function () {
        Route::get('/', [PostCategoryController::class, 'index']);
        Route::get('/create', [PostCategoryController::class, 'create'])->middleware('can:add_posts');
        Route::post('/create', [PostCategoryController::class, 'store'])->middleware('can:add_posts');
        Route::get('/edit/{id}', [PostCategoryController::class, 'edit'])->middleware('can:edit_posts');
        Route::post('/edit/{id}', [PostCategoryController::class, 'update'])->middleware('can:edit_posts');
        Route::get('/delete/{id}', [PostCategoryController::class, 'destroy'])->middleware('can:delete_posts');
    });

    //Menu
    Route::group(['prefix' => 'menus', 'middleware' => ['can:read_menus']], function () {
        Route::get('/', [MenuController::class, 'index']);
        Route::get('/create', [MenuController::class, 'create'])->middleware('can:add_menus');
        Route::post('/create', [MenuController::class, 'store'])->middleware('can:add_menus');
        Route::get('/edit/{id}', [MenuController::class, 'edit'])->middleware('can:edit_menus');
        Route::post('/edit/{id}', [MenuController::class, 'update'])->middleware('can:edit_menus');
        Route::get('/builder/{id}', [MenuController::class, 'builder'])->middleware('can:edit_menus');
        Route::get('/delete/{id}', [MenuController::class, 'destroy'])->middleware('can:delete_menus');

        //Menu Items
        Route::group(['prefix' => 'item'], function () {
            Route::post('/order', [MenuController::class, 'orderItem'])
            ->middleware('can:edit_menus')->name('menus.item.order');
            Route::post('/add', [MenuController::class, 'addItem'])
            ->middleware('can:add_menus')->name('menus.item.add');
            Route::post('/add_custom', [MenuController::class, 'addItemCustom'])
            ->middleware('can:add_menus')->name('menus.item.addcustom');
            Route::post('/update/{id}', [MenuController::class, 'updateItem'])
            ->middleware('can:edit_menus')->name('menus.item.update');
            Route::get('/delete/{id}', [MenuController::class, 'deleteItem'])
            ->middleware('can:delete_menus');
        });
    });


    //Setting
    Route::group(['prefix' => 'settings', 'middleware' => ['can:read_settings']], function () {
        Route::get('/', [SettingController::class, 'index']);
        Route::post('/', [SettingController::class, 'update'])->middleware('can:edit_settings');
        Route::post('/create', [SettingController::class, 'store'])
        ->middleware('role:'.config('permission.role_dev'))->name('settings.add');
        Route::get('/delete/{id}', [SettingController::class, 'destroy'])
        ->middleware('role:'.config('permission.role_dev'))->name('settings.delete');
        Route::post('/order', [SettingController::class, 'order'])->name('settings.order');
    });

    //Media
    Route::group(['prefix' => 'media', 'middleware' => ['can:read_media']], function () {
        Route::get('/', [MediaController::class, 'index']);
        Route::group(['prefix' => 'filemanager'], function () {
            \UniSharp\LaravelFilemanager\Lfm::routes();
        });
    });

    //Category Product
    Route::group(['prefix' => 'categories', 'middleware' => ['can:read_products']], function () {
        Route::get('/', [CategoryController::class, 'index']);
        Route::get('/create', [CategoryController::class, 'create'])->middleware('can:add_products');
        Route::post('/create', [CategoryController::class, 'store'])->middleware('can:add_products');
        Route::get('/edit/{id}', [CategoryController::class, 'edit'])->middleware('can:edit_products');
        Route::post('/edit/{id}', [CategoryController::class, 'update'])->middleware('can:edit_products');
        Route::get('/delete/{id}', [CategoryController::class, 'destroy'])->middleware('can:delete_products');
    });

    //Themes
    Route::group(['prefix' => 'themes', 'middleware' => ['can:read_themes']], function () {
        Route::get('/', [ThemeController::class, 'index']);
        Route::get('/edit/{id}', [ThemeController::class, 'edit'])->middleware('can:edit_themes');
        Route::post('/edit/{id}', [ThemeController::class, 'update'])->middleware('can:edit_themes');
    });

});