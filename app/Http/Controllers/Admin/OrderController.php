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
                <label class="col-sm-4 col-form-label text-right font-weight-bold">Ti???n h??ng:</label>
                <div class="col-sm-8 col-form-label text-primary">'.number_format($order->total_money).' ??</div>
            </div>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label text-right font-weight-bold">T???ng ????n h??ng:</label>
                <div class="col-sm-8 col-form-label text-primary">'.number_format($order->total_price).' ??</div>
            </div>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label text-right font-weight-bold">C??n n???:</label>
                <div class="col-sm-8 col-form-label text-primary">'.number_format($order->total_money - $order->customer_pay).' ??</div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group row">
                <label class="col-sm-4 col-form-label text-right font-weight-bold">S??? l?????ng s???n ph???m:</label>
                <div class="col-sm-8 col-form-label text-primary">'.$order->total_quantity.'</div>
            </div>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label text-right font-weight-bold">Gi???m gi??:</label>
                <div class="col-sm-8 col-form-label text-primary">'.number_format($order->coupon).' ??</div>
            </div>
        </div>
        </div>
        <div class="card-datatable table-responsive"><table class="table-order-detail table" width="100%">
        <thead class="thead-light">
            <tr class="bg-primary text-white">
            <td>M?? s???n ph???m</td>
            <td>T??n s???n ph???m</td>
            <td>S??? l?????ng</td>
            <td>Tr???ng l?????ng</td>
            <td>Gi?? b??n</td>
            <td>Th??nh ti???n</td>
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
