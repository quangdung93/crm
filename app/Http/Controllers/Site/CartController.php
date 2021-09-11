<?php

namespace App\Http\Controllers\Site;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\CartItem;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    public function add(Request $request){
        if (!$request->ajax()) {
            return response()->json(['status' => false, 'message' => 'Yêu cầu không hợp lệ.']);
        }

        $requestCartItem = $this->toCartItemArray($request);
        $existedCartItems = Cart::search(function ($cartItem, $key) use ($requestCartItem) {
            return $requestCartItem->id == $cartItem->id;
        });

        if ($existedCartItems->isNotEmpty()) {
            $existedCartItem = $existedCartItems->first();
            $newQty = (int)$requestCartItem->qty + (int)$existedCartItem->qty;
            Cart::update($existedCartItem->rowId, $newQty);
        } else {
            Cart::addCartItem($requestCartItem);
        }

        return response()->json([
            'status' => true, 
            'qty' => Cart::count(),
            'html' => $this->renderListCart(),
        ]);
    }

    protected function toCartItemArray(Request $request)
    {
        $cartItem = $this->mappingCartItem($request->product_id);
        $cartItem->setQuantity((int)$request->qty);
        return $cartItem;
    }

    public function mappingCartItem($productId)
    {
        if (!$productId) {
            return null;
        }

        $product = Product::find($productId);

        if(!$product){
            return null;
        }

        $options = [
            'price_old' => $product->price_old,
            'image' => $product->image,
            'sku' => $product->sku,
            'discount' => $product->discount
        ];

        return new CartItem($productId, $product->name, $product->price, 0, $options);
    }

    public function update(Request $request)
    {
        if (!$request->ajax() || !$cartId = $request->cart_id) {
            return response()->json(['status' => false, 'message' => 'Yêu cầu không hợp lệ.']);
        }

        Cart::update($cartId, (int)$request->qty);

        return response()->json([
            'status' => true, 
            'qty' => Cart::count(),
            'html' => $this->renderListCart()
        ]);

    }

    public function remove(Request $request)
    {
        if (!$request->ajax() || !$cartId = $request->cart_id) {
            return response()->json(['status' => false, 'message' => 'Yêu cầu không hợp lệ.']);
        }

        $cartId = $request->cart_id;
        Cart::remove($cartId);

        return response()->json([
            'status' => true, 
            'qty' => Cart::count(),
            'html' => $this->renderListCart(),
        ]);
    }

    private function renderListCart(){
        $content = Cart::content();
        $html = '<div class="list-cart">';

        foreach($content as $item){
            $html .= '<div class="cart-item">
                <div class="image">
                    <img width="50" src="'.asset($item->options['image']).'" alt="'.$item->name.'"/>
                </div>
                <div class="product-info">
                    <div class="content">
                        <div class="name">'.$item->name.'</div>
                        <div class="price-zone">
                            <span class="price-old">'.number_format($item->price).' đ</span>
                            <span class="discount">x '.$item->qty.'</span>
                        </div>
                    </div>
                    <div class="price">'.number_format($item->price * $item->qty).' đ</div>
                </div>
            </div>';
        }

        $html .= '</div><div class="text-center mt-2">
            <a href="'.route('checkout').'" class="btn bg-kangen view-all-cart">Thanh toán</a>
        </div>';

        return $html;
    }
}
