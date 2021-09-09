<?php 

namespace App\Services;
use Carbon\Carbon;
use App\Models\Setting;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;

class LogService
{
    public function getDatatable($table){
        $data = Datatables::of($table)
            ->editColumn('user_id', function ($row) {
                return $row->user->name ?? '';
            })
            ->editColumn('action', function ($row) {
                if($row->action == 'created'){
                    $status = '<label class="label label-success">created</label>';
                }
                elseif($row->action == 'updated'){
                    $status = '<label class="label label-primary">updated</label>';
                }
                elseif($row->action == 'deleted'){
                    $status = '<label class="label label-danger">deleted</label>';
                }

                return $status;
            })
            ->editColumn('logable_type', function ($row) {
                return Setting::MODEL[$row->logable_type];
            })
            ->editColumn('title', function ($row) {
                return $row->logable->name ?? '';
            })
            ->editColumn('ip', function ($row) {
                return $row->ip;
            })
            ->editColumn('created_at', function ($row) {
                return format_datetime($row->created_at);
            })
            ->addColumn('action_btn', function ($row) {
                $user = Auth::user();
                $action = "";
                if($user->can('read_logs') && $row->action == 'updated'){
                    $action .= '<a class="btn btn-success" href="'.url('admin/logs/details/'.$row->id).'" title="Xem chi tiết">
                    <i class="feather icon-eye"></i></a>';
                }
                return $action;
            })
            ->rawColumns(['action','details','action_btn'])
            ->make(true);
        return $data;
    }
}