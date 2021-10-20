<?php

namespace App\Http\Controllers\Site;

use Carbon\Carbon;
use App\Models\Ward;
use App\Models\Order;
use App\Models\District;
use App\Models\Province;
use App\Jobs\SendMailOrder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Gloudemans\Shoppingcart\Facades\Cart;

class CheckoutController extends Controller
{
    public function index(){
        $provinces = Province::orderByDesc('index')->get();
        return view('themes.kangen.checkout.index')->with([
            'provinces' => $provinces
        ]);
    }

    public function store(Request $request){    
        if(Cart::count() > 0){
            $response = $this->createOrder($request);
        }
        else{
            $response = [
                'status' => false,
                'cart' => false,
                'message' => 'Giỏ hàng không có sản phẩm. Vui lòng thực hiện lại!'
            ];
        }

        return response()->json($response);
    }

    public function thanksPage($order_id){
        $order = Order::where('id', $order_id)->type('order')->first();
        
        //Set lifetime checkout sucess link
        if(Carbon::now() > Carbon::parse($order->created_at)->addMinutes(5)){
            return abort('404');
        }

        return view('themes.kangen.checkout.success')->with([
            'order' => $order
        ]);
    }   

    public function load(){
        return response()->json([
            'status' => true, 
            'qty' => Cart::count(),
            'data' => $this->renderCart()
        ]);
    }

    public function getDistrict($id){
        if($id){
            $data = District::where('province_id', $id)->orderBy('name', 'ASC')->get();
            $html = '<option value="0">Chọn quận/huyện</option>';
            if($data){
                foreach($data as $item){
                    $html .= '<option value="'.$item->id.'">'.$item->name.'</option>';
                }
                return response()->json(['status' => true, 'html' => $html]);
            }
            else{
                return response()->json(['status' => false, 'alert' => 'Không có dữ liệu']);    
            }
        }
    }

    public function getWard($id){
        if($id){
            $data = Ward::where('district_id', $id)->get();
            $html = '<option value="0">Chọn phường/xã</option>';
            if($data){
                foreach($data as $item){
                    $html .= '<option value="'.$item->id.'">'.$item->name.'</option>';
                }
                return response()->json(['status' => true, 'html' => $html]);
            }
            else{
                return response()->json(['status' => false, 'alert' => 'Không có dữ liệu']);    
            }
        }
    }

    public function renderCart(){
        $html = '';

        if(Cart::count() > 0){
            $content = Cart::content();
            foreach ($content as $key => $item) {
                $html .= '<div class="line" data-id="'.$key.'">
                    <div class="item image">
                        <img width="50" src="'.asset($item->options['image']).'" alt="'.$item->name.'"/>
                        <span class="ml-2">'.$item->name.'</span>
                    </div>
                    <div class="item price">
                        <p class="mb-1 text-red">'.number_format($item->price).' đ</p>
                        <p class="strike mb-0">'.number_format($item->options['price_old']).' đ</p>
                    </div>
                    <div class="item qty">
                        <div class="qty-box d-flex align-items-center">
                            <a href="#" class="btn bg-kangen mr-2 checkout-btn-cart-minus"><i class="feather icon-minus"></i></a>
                            <input name="qty" class="checkout-qty-input mr-2" type="number" value="'.$item->qty.'" min="1" max="99" maxlength="2">
                            <a href="#" class="btn bg-kangen checkout-btn-cart-plus ="><i class="feather icon-plus"></i></a>
                        </div>
                    </div>
                    <div class="item subtotal">
                        <span class="mr-2 text-red">'.number_format($item->price * $item->qty).' đ</span>
                        <span class="remove-cart-item"><i class="feather icon-trash-2"></i></span>
                    </div>
                </div>';
            }
    
            $html .= '<div class="line justify-content-end">
                <div class="item text-right">
                    <span>Tổng tiền: </span><span class="text-red font-weight-bold">'.number_format(Cart::totalFloat()).' đ</span>
                </div>
            </div>';
        }
        else{
            $html .= '<p class="text-center mt-3"><i class="feather icon-shopping-cart"></i> Giỏ hàng trống</p>
                <div class="text-center">
                    <a href="/" class="btn bg-kangen">Đến trang mua hàng</a>
                </div>
            ';
        }

        return $html;
    }

    public function createOrder(Request $request){
        $data = $request->except('_token');
        $data['total'] = Cart::totalFloat();
        $order = Order::create($data);

        if(!$order){
            $response = [
                'status' => false,
                'message' => 'Thanh toán không thành công! Vui lòng thử lại'
            ];
        }

        $orderId = $order->id;
        $listCart = Cart::content();

        foreach ($listCart as $row) {
            $orderDetail[] = [
                'order_id' => $orderId,
                'product_id' => $row->id,
                'qty' => $row->qty,
                'price_old' => $row->options['price_old'],
                'price' => $row->price,
                'subtotal' => $row->subtotal,
            ];
        }

        //Save Order Detail
        $order->detail()->attach($orderDetail);

        //Send mail order
        // $this->sendMailOrder($orderId);
        
        //Remove Cart
        Cart::destroy();

        $response = [
            'status' => true,
            'order_id' => $orderId,
            'message' => 'Thanh toán thành công!'
        ];

        return $response;
    }

    public function sendMailOrder($orderId){
        $mailOrder = setting('site_order_mail');

        if(trim($mailOrder) !== ''){
            $orderObj = Order::find($orderId)->load('detail');

            $data = [
                'mail_to' => $mailOrder,
                'order' => $orderObj
            ];

            if(!empty($data['order'])){
                // SendMailOrder::dispatch($data);
                Mail::send('themes.kangen.mail.mail-order', $data, 
                    function($message) use ($data){
                        $message->to($data['mail_to']);
                        $message->subject('[Đơn Hàng] Thông Tin Đơn Hàng Mới - ngày '.date('d/m/Y' ,strtotime($data['order']->created_at)). ' lúc '.date('H:i' ,strtotime($data['order']->created_at)));
                });
            }
        }
    }
}
