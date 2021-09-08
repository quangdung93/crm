<?php 

namespace App\Services;
use Carbon\Carbon;
use App\Models\Product;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;

class ProductService
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
            ->editColumn('brand_id', function ($row) {
                return  optional($row->brand)->name ?? '';
            })
            ->editColumn('price', function ($row) {
                return '<strike>'.format_price($row->price_old).' đ</strike><br><span class="text-danger">'.format_price($row->price).' đ</span>';
            })
            ->editColumn('discount', function ($row) {
                return  $row->discount ? $row->discount.'%' : '0';
            })
            // ->editColumn('created_at', function ($row) {
            //     return format_date($row->created_at);
            // })
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
                if($user->can('edit_products')){
                    $action .= '<a class="btn btn-primary" href="'.url('admin/products/edit/'.$row->id).'" title="Chỉnh sửa">
                                <i class="feather icon-edit-1"></i></a>';
                }
                if($user->can('delete_products')){
                    $action .= '<a href="'.url('admin/products/delete/'.$row->id).'" class="btn btn-danger notify-confirm" title="Xóa">
                        <i class="feather icon-trash-2"></i>
                    </a>';
                }
                $action .= '<a class="btn btn-success" href="'.url($row->link()).'" target="_blank"><i class="feather icon-eye" title="Xem"></i></a>';

                return $action;
            })
            ->rawColumns(['image', 'price', 'status','action'])
            ->make(true);
        return $data;
    }

    public function getProductRelated($category_ids, $limit = 8){
        return Product::whereHas('categories', function($query) use($category_ids){
            $query->whereIn('category_id', $category_ids);
        })
        ->limit($limit)
        ->get();
    }
}