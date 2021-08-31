<?php

namespace App\Http\Controllers\Site;

use App\Models\Category;
use App\Models\PostCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index(){
        return view('themes.kangen.homepage.index');
    }
}
