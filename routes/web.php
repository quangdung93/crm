<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
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

Route::get('/login', [LoginController::class, 'login']);
Route::post('/login', [LoginController::class, 'postLogin'])->name('login');

Route::get('/', function () {
    return view('welcome');
});

//Filemanager
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

Route::group(['prefix' => 'admin','middleware' => 'auth'], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashbroad');
    Route::get('/logout', [LoginController::class, 'logout']);

    //User
    Route::group(['prefix' => 'users', 'middleware' => ['can:read_users']], function () {
        Route::get('/', [UserController::class, 'index']);
        Route::get('/create', [UserController::class, 'create']);
        Route::post('/create', [UserController::class, 'store']);
        Route::get('/edit/{id}', [UserController::class, 'edit']);
        Route::post('/edit/{id}', [UserController::class, 'update']);
        Route::get('/delete/{id}', [UserController::class, 'destroy'])->middleware('can:delete_users');
    });

    //Role
    Route::group(['prefix' => 'roles', 'middleware' => ['can:read_roles']], function () {
        Route::get('/', [RoleController::class, 'index']);
        Route::get('/create', [RoleController::class, 'create']);
        Route::post('/create', [RoleController::class, 'store']);
        Route::get('/edit/{id}', [RoleController::class, 'edit']);
        Route::post('/edit/{id}', [RoleController::class, 'update']);
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
});