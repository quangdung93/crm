<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function detail($page){
        //Handle content post
        $page->handleContent();
        return view('themes.kangen.pages.detail')
                ->with([
                    'page' => $page,
                ]);
    }
}
