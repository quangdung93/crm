<?php 

namespace App\Services;
use Carbon\Carbon;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;

class PostService
{
    public function getDatatable($table){
        $data = Datatables::of($table)
            ->editColumn('id', function ($row) {
                return $row->id;
            })
            ->editColumn('title', function ($row) {
                return $row->title;
            })
            ->editColumn('category_id', function ($row) {
                return $row->category->name ?? '';
            })
            ->editColumn('image', function ($row) {
                return '<img src="'.asset($row->image).'" class="img-responsive" style="width:60px;">';
            })
            ->editColumn('created_at', function ($row) {
                return Carbon::parse($row->created_at)->format('d/m/Y');
            })
            ->editColumn('status', function ($row) {
                $status =  $row->status === 1 ? '<label class="label label-primary">Hiển thị</label>' : '<label class="label label-danger">Ẩn</label>';
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
                        $action .= '<a href="'.url('admin/posts/delete/'.$row->id).'" onclick="return confirm("Bạn có muốn xóa dòng này?")" class="btn btn-danger" title="Xóa">
                            <i class="feather icon-trash-2"></i>
                        </a>';
                    }
                    $action .= '<a class="btn btn-success" href="'.url($row->links()).'" target="_blank"><i class="feather icon-eye" title="Xem"></i></a>';
                }
                return $action;
            })
            ->rawColumns(['image','status','action'])
            ->make(true);
        return $data;
    }
}