<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DashboardController;

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

// Route::get('/login', '');

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'admin'], function () {
    Route::get('/', [DashboardController::class, 'index']);

    Route::group(['prefix' => 'users'], function () {
        Route::get('/', [UserController::class, 'index']);
    });

    Route::group(['prefix' => 'roles'], function () {
        Route::get('/', [UserController::class, 'role']);
        Route::get('/create', [UserController::class, 'createRole']);
    });

    Route::group(['prefix' => 'posts'], function () {
        Route::get('/', [PostController::class, 'index']);
        Route::get('datatable', [PostController::class,'getDatatable'])->name('posts.view');
    });
});