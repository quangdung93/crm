<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(){
        $comments = Comment::with('commentable')->get();
        return view('admin.comments.index')->with(['comments' => $comments]);
    }

    public function edit(Request $request){
        if(!$request->ajax()){
            return $this->responseJson(false,'Có lỗi xảy ra vui lòng thử lại!');
        }

        $comment = Comment::findOrFail($request->id);

        if($request->active){
            $comment->status = 1;
        }
        else{
            $comment->status = 0;
        }

        $comment->save();

        return $this->responseJson(true,'Cập nhật thành công!');
    }

    public function delete($id)
    {
        $model = Comment::findOrFail($id);
        $delete = $model->delete();

        if($delete){
            return redirect('admin/comments')->with('success', 'Xóa thành công!');
        }
    }
}
