<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function increment(Request $request){
        if(!$request->ajax()){
            return $this->responseJson(false,'Có lỗi xảy ra vui lòng thử lại!');
        }

        $className = $request->model;
        $model = new $className;

        $instance = $model->findOrFail($request->id);

        if($instance){
            $instance->increment('rating_count');
            return $this->responseJson(true, 'Đánh giá thành công!', $instance->rating_count);
        }
    }
}
