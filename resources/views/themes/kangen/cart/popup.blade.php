<div id="popup-cart" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Giỏ hàng</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="popup-cart-content">
                    @php
                        $cartContent = Cart::content();
                    @endphp

                    @if($cartContent->isNotEmpty())
                    <div class="list-cart">
                        @foreach($cartContent as $item)
                            <div class="cart-item">
                                <div class="image"><img width="50" src="{{ $item->options['image'] }}" alt="{{ $item->name }}"/></div>
                                <div class="product-info">
                                    <div class="content">
                                        <div class="name">{{ $item->name }}</div>
                                        <div class="price-zone">
                                            <span class="price-old">{{ number_format($item->price) }} đ</span>
                                            <span class="discount">x {{ $item->qty }}</span>
                                        </div>
                                    </div>
                                    <div class="price">{{ number_format($item->price * $item->qty) }} đ</div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="text-center mt-2">
                        <a href="{{ route('checkout') }}" class="btn bg-kangen view-all-cart">Thanh toán</a>
                    </div>
                    @else
                        <p class="empty-cart text-center mb-0">
                            <i class="feather icon-shopping-cart"></i>
                            <span>Giỏ hàng trống</span>
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
