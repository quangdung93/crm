<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function create(Request $request){
        if(!$request->ajax()){
            return $this->responseJson(false,'Có lỗi xảy ra vui lòng thử lại!');
        }

        $data = $request->all();

        if(!isset($data['commentable_type']) && !isset($data['commentable_id'])){
            return $this->responseJson(false,'Có lỗi xảy ra vui lòng thử lại!');
        }

        $className = $data['commentable_type'];
        $model = new $className;

        $instance = $model->findOrFail($data['commentable_id']);

        $dataComment = $request->except('commentable_type', 'commentable_id');

        $create = $instance->comments()->create($dataComment);
        
        if($create){
            return $this->responseJson(true, 'Bình luận thành công!', $create);
        }
    }
}
