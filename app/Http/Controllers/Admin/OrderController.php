<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index(){
        $orders = Order::all();
        return view('admin.orders.index')->with([
            'orders' => $orders
        ]);
    }

    public function convert(){
        $orders = Order::all();

        foreach ($orders as $key => $order) {
            $detail = json_decode($order->detail_order, true);
            $data = $temp = [];
            foreach ($detail as $key => $value) {
                $temp = [
                    'order_id' => $order['id'],
                    'product_id' => (int)$value['id'],
                    'qty' => (int)$value['quantity'] ?? 1,
                    'price' => (int)$value['price'] ?? 0,
                    'discount' => $value['discount'] ?? 0,
                    'inventory' => $value['loaikho'] ?? null,
                ];

                $temp['subtotal'] = $temp['qty'] * $temp['price'];

                $data[] = $temp;
            }

            $order->detail()->sync($data);
        }

        echo 'Done';
    }

    public function detail($id){
        $order = Order::findOrFail($id)->load('detail');

        return view('admin.orders.detail')->with([
            'order' => $order
        ]);
    }

    public function detailOrder($id){
        try {
            $order = Order::where('id', $id)->with('detail')->first();
            $result = $this->renderOrderDetail($order);
            return $this->responseJson(CODE_SUCCESS, $result);
        } catch (\Throwable $th) {
            return $this->responseJson(CODE_ERROR, null, $th->getMessage());
        }
    }

    public function getOrdersByCustomer($customerId){
        try {
            $orders = Order::where('customer_id', $customerId)->get();

            return $this->responseJson(CODE_SUCCESS, $orders);
        } catch (\Throwable $th) {
            return $this->responseJson(CODE_ERROR, null, $th->getMessage());
        }
    }

    public function renderOrderDetail($order){
        $html = '
        <div class="row">
        <div class="col-sm-6">
            <div class="form-group row">
                <label class="col-sm-4 col-form-label text-right font-weight-bold">Tiền hàng:</label>
                <div class="col-sm-8 col-form-label text-primary">'.number_format($order->total_money).' đ</div>
            </div>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label text-right font-weight-bold">Tổng đơn hàng:</label>
                <div class="col-sm-8 col-form-label text-primary">'.number_format($order->total_price).' đ</div>
            </div>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label text-right font-weight-bold">Còn nợ:</label>
                <div class="col-sm-8 col-form-label text-primary">'.number_format($order->total_money - $order->customer_pay).' đ</div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group row">
                <label class="col-sm-4 col-form-label text-right font-weight-bold">Số lượng sản phẩm:</label>
                <div class="col-sm-8 col-form-label text-primary">'.$order->total_quantity.'</div>
            </div>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label text-right font-weight-bold">Giảm giá:</label>
                <div class="col-sm-8 col-form-label text-primary">'.number_format($order->coupon).' đ</div>
            </div>
        </div>
        </div>
        <div class="card-datatable table-responsive"><table class="table-order-detail table" width="100%">
        <thead class="thead-light">
            <tr class="bg-primary text-white">
            <td>Mã sản phẩm</td>
            <td>Tên sản phẩm</td>
            <td>Số lượng</td>
            <td>Trọng lượng</td>
            <td>Giá bán</td>
            <td>Thành tiền</td>
            </tr>
        </thead><tbody>';

        if($order && $order->detail){
            foreach ($order->detail as $key => $value) {
                $html .= '<tr>
                    <td>'.$value->code.'</td>
                    <td>'.$value->name.'</td>
                    <td>'.$value->pivot->qty.'</td>
                    <td>0.5 Kg</td>
                    <td>'.number_format($value->pivot->price).'</td>
                    <td>'.number_format($value->pivot->subtotal).'</td>
                </tr>';
            }
        }

        $html .= '</tbody></table></div>';

        return $html;
    }
}
