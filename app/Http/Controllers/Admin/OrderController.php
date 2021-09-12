<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index(){
        $orders = Order::all();
        return view('admin.orders.index')->with([
            'orders' => $orders
        ]);
    }

    public function detail($id){
        $order = Order::findOrFail($id)->load('detail');
        return view('admin.orders.detail')->with([
            'order' => $order
        ]);
    }
}
