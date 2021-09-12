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
                    'metaData' => $this->getMetaData($page),
                    'page' => $page,
                ]);
    }

    public function getMetaData($model){
        return [
            'title' => $model->meta_title ?: $model->name,
            'description' => $model->meta_description,
            'keyword' => $model->meta_keywords,
            'image' => $model->image,
        ];
    }
}
