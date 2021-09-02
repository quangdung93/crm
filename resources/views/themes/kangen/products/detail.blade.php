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
                                <p>Giá Trị Của Sản Phẩm Phải Đi Kèm Với Chất Lượng Của Dịch Vụ. Giá Có Thể Tốt Nhưng Dịch Vụ Phải Tốt Hơn</p>
                                <p class="text-right">CEO: Đại Lâm Thịnh</p>
                            </blockquote>
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <div class="product-detail-info">
                            <div class="answer">
                                <span><i class="feather icon-chevrons-right"></i></span>
                                <span><a href="#">Vì sao không nên mua hàng xách tay? Click xem ngay</a></span>
                            </div>
                            <div class="product-name"><h3>{{ $product->name }}</h3></div>
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
                            <div class="add-to-cart">
                                <div class="qty-box">
                                    <a href="#" class="btn bg-kangen mr-2"><i class="feather icon-minus"></i></a>
                                    <input class="qty-input mr-2" type="text" value="1" />
                                    <a href="#" class="btn bg-kangen"><i class="feather icon-plus"></i></a>
                                </div>
                                <a href="#" class="btn bg-kangen btn-addtocart">Thêm vào giỏ hàng</a>
                            </div>
                            <div class="image-block">
                                <h5 class="title text-center">Thanh toán các loại thẻ</h5>
                                <img class="img-fluid lazy" data-src="{{ asset('themes/kangen/images/bank-all.png') }}" alt="" />
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="product-detail-siderbar">
                            <div class="siderbar-item">
                                <h5 class="title text-center">Đại Lâm Thịnh Có Gì?</h5>
                                <div class="content">
                                    <div class="item">
                                        <a href="#">
                                            <i class="feather icon-check-circle"></i> <span>Dịch vụ rửa máy chuyên sâu</span>
                                        </a>
                                    </div>
                                    <div class="item">
                                        <a href="#">
                                            <i class="feather icon-check-circle"></i> Dịch vụ rửa máy chuyên sâu
                                        </a>
                                    </div>
                                    <div class="item">
                                        <a href="#">
                                            <i class="feather icon-check-circle"></i> Dịch vụ rửa máy chuyên sâu
                                        </a>
                                    </div>
                                    <div class="item">
                                        <a href="#">
                                            <i class="feather icon-check-circle"></i> Dịch vụ rửa máy chuyên sâu
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="siderbar-item">
                                <h5 class="title text-center">Chính Sách Trả Góp</h5>
                                <div class="image-block">
                                    <a href="#"><img class="img-fluid" src="{{ asset('themes/kangen/images/chinh-sach-kangen.jpg') }}" alt="" /></a>
                                </div>
                            </div>

                            <div class="siderbar-item">
                                <div class="image-block">
                                    <a href="#"><img class="img-fluid" src="{{ asset('themes/kangen/images/click-khuyen-mai.gif') }}" alt="" /></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="product-content">
                <div class="content-detail height-fixed blur-content">
                    {!! $product->content !!}
                </div>
                <div class="text-center">
                    <a href="#" class="btn bg-kangen mt-4 show-all"><span>Xem thêm</span> <i class="feather icon-chevrons-down"></i></a>
                </div>
            </div>

            {!! shortcode('thongtin') !!}

            @include('themes.kangen.components.installment')

            @include('themes.kangen.components.product-slider', ['title' => 'SẢN PHẨM TƯƠNG TỰ', 'products' => $productRelated])
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