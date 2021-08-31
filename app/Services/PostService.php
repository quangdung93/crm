<?php 

namespace App\Services;
use Carbon\Carbon;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;

class PostService
{
    public function getDatatable($table){
        $data = Datatables::of($table)
            ->editColumn('image', function ($row) {
                return '<img src="'.asset($row->image).'" style="width:60px;">';
            })
            ->editColumn('name', function ($row) {
                return $row->name;
            })
            ->editColumn('categories', function ($row) {
                return implode(',', $row->categories->pluck('name')->toArray());
            })
            ->editColumn('created_at', function ($row) {
                return format_date($row->created_at);
            })
            ->editColumn('status', function ($row) {
                $status =  $row->status === 1 ? '<label class="label label-success">Hiển thị</label>' : '<label class="label label-danger">Ẩn</label>';
                if( !empty($row->deleted_at) ){
                    $status = '<label class="label label-danger">Đã xóa</label><br> <p class="white-space"> Ngày xóa: '.date('d-m-Y',strtotime($row->deleted_at)).' </p>';
                }
                return $status;
            })
            ->addColumn('action', function ($row) {
                $user = Auth::user();
                $action = "";
                if( !empty($row->deleted_at) ){
                    $action .= '<a onclick="restoreNews(this)" data-id="'.$row->id.'" class="btn btn-primary" title="Khôi phục">
                        <i class="fa fa-undo text-white"></i> </a>';
                }
                else{
                    if($user->can('edit_posts')){
                        $action .= '<a class="btn btn-primary" href="'.url('admin/posts/edit/'.$row->id).'" title="Chỉnh sửa">
                                    <i class="feather icon-edit-1"></i></a>';
                    }
                    $action .= '<a href="javascript:void(0)" onclick="duplicateNew('.$row->id.')" class="btn btn-warning" title="Nhân bản">
                                <i class="feather icon-copy"></i>
                            </a>';
                    if($user->can('delete_posts')){
                        $action .= '<a href="'.url('admin/posts/delete/'.$row->id).'" class="btn btn-danger notify-confirm" title="Xóa">
                            <i class="feather icon-trash-2"></i>
                        </a>';
                    }
                    $action .= '<a class="btn btn-success" href="'.url($row->link()).'" target="_blank"><i class="feather icon-eye" title="Xem"></i></a>';
                }
                return $action;
            })
            ->rawColumns(['image','status','action'])
            ->make(true);
        return $data;
    }
}