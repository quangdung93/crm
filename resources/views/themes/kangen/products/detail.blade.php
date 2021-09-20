@extends('themes.kangen.body')
@section('title', 'Sản phẩm')
@section('content')
    <nav aria-label="breadcrumb">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="{{ url($product->categories[0]->link()) }}">{{ $product->categories[0]->name }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
            </ol>
        </div>
    </nav>
    <div class="product-detail-wrap">
        <div class="container">
            <div class="product-detail">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="product-detail-image">
                            <img class="img-fluid" src="{{ asset($product->image) }}" alt="{{ $product->name }}" />
                        </div>
                        <div class="quote-text">
                            <blockquote>
                                <p>{{ theme('product_quote.content') }}</p>
                                <p class="text-right">{{ theme('product_quote.author') }}</p>
                            </blockquote>
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <div class="product-detail-info">
                            <div class="answer">
                                <span><i class="feather icon-chevrons-right"></i></span>
                                <span><a href="{{ theme('product_question.link') }}">{{ theme('product_question.title') }}</a></span>
                            </div>
                            <div class="product-name"><h2>{{ $product->name }}</h2></div>
                            <div class="product-price">
                                <div class="price-old">{{ number_format($product->price_old) }} đ</div>
                                <div class="price-discount">
                                    <div class="price">{{ number_format($product->price) }} đ</div>
                                    <div class="discount">-{{ $product->discount }}%</div>
                                </div>
                                <div class="vat">(Giá chưa bao gồm VAT)</div>
                            </div>
                            <div class="more-info">
                                <div class="item">
                                    <i class="feather icon-check-square"></i> <span>Đứng thứ 1 về xử lý nước trên Thế Giới</span>
                                </div>
                                <div class="item">
                                    <i class="feather icon-check-square"></i> <span>Thương hiệu: </span> <span>{{ $product->brand->name }}</span>
                                </div>
                                <div class="item">
                                    <i class="feather icon-check-square"></i> <span>Xuất sứ: </span> <span>{{ $product->origin ?: 'Nhật Bản' }}</span>
                                </div>
                            </div>
                            <form data-action="{{ route('cart.add') }}">
                                <div class="add-to-cart">
                                    <div class="qty-box">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                        <input type="hidden" name="product_id" value="{{ $product->id }}" />
                                        <a href="#" class="btn bg-kangen mr-2 btn-cart-minus"><i class="feather icon-minus"></i></a>
                                        <input name="qty" class="qty-input mr-2" type="number" value="1" min="1" max="99" maxlength="2"/>
                                        <a href="#" class="btn bg-kangen btn-cart-plus ="><i class="feather icon-plus"></i></a>
                                    </div>
                                <a href="#" class="btn bg-kangen btn-addtocart">Thêm vào giỏ hàng</a>
                            </form>
                            </div>
                            <div class="image-block">
                                <h5 class="title text-center">{{ theme('product_banner_1.title') }}</h5>
                                <a href="{{ theme('product_banner_1.link') }}" class="d-block">
                                    <img class="img-fluid lazy" data-src="{{ asset(theme('product_banner_1.image')) }}" alt="" />
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="product-detail-siderbar">
                            <div class="siderbar-item">
                                <h5 class="title text-center">Đại Lâm Thịnh Có Gì?</h5>
                                <div class="content">
                                    @php
                                        $productServices = theme('product_services');
                                    @endphp
                                    @if($productServices)
                                        @foreach($productServices as $service)
                                            <div class="item">
                                                <a href="{{ url($service['link']) }}">
                                                    <i class="feather icon-check-circle"></i> <span>{{ $service['title'] }}</span>
                                                </a>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>

                            <div class="siderbar-item">
                                <h5 class="title text-center">Chính Sách Trả Góp</h5>
                                <div class="image-block">
                                    <a href="#"><img class="img-fluid lazy" data-src="{{ asset('themes/kangen/images/chinh-sach-kangen.jpg') }}" alt="" /></a>
                                </div>
                            </div>

                            <div class="siderbar-item">
                                <div class="image-block">
                                    <a href="#"><img class="img-fluid lazy" data-src="{{ asset('themes/kangen/images/click-khuyen-mai.gif') }}" alt="" /></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Rating --}}
            @include('themes.kangen.components.rating', ['model' => $product])

            <div class="product-content">
                <div class="content-detail height-fixed blur-content">
                    {!! $product->content !!}
                </div>
                <div class="text-center">
                    <a href="#" id="btn-toggle-content" class="btn bg-kangen mt-4"><span>Xem thêm</span> <i class="feather icon-chevrons-down"></i></a>
                </div>
            </div>

            {{-- Comment --}}
            @include('themes.kangen.components.comments', ['model' => $product])

            {!! shortcode('thongtin') !!}

            @include('themes.kangen.components.installment')

            @include('themes.kangen.components.product-slider', [
                'title' => 'SẢN PHẨM TƯƠNG TỰ', 
                'products' => $productRelated
            ])
        </div>
    </div>
@endsection

@section('javascript')
<script>
    $(document).ready(function(){
        $('.content-detail img').each(function () {
            $(this).addClass('lazy');
            $(this).lazyload();
        });
    });
</script>
@endsection