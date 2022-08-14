<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Order;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    protected $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function index(){
        $table_name = $this->order->getTable();

        $object = $this->order->select(
            'orders.id',
            'users.name as created_name',
        );

        $object->leftJoin('users', 'users.id', '=', "{$table_name}.created_by");
        $object->whereMonth($table_name.'.created_at', Carbon::now()->month);
        $result = $object->get();
        $dataCharts = $result->groupBy('created_name')->map->count()->toArray();
        return view('admin.dashbroad', compact('dataCharts'));
    }
}
