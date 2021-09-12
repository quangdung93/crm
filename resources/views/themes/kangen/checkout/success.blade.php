@extends('themes.kangen.body')
@section('title', 'Sản phẩm')
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('themes/kangen/css/checkout.css') }}">
@endsection

@section('content')
    <div class="thanks-page">
        <div class="container">
            <div class="thanks-wrapper">
                <h3 class="title">
                    <p class="icon"><i class="feather icon-check-circle"></i></p>
                    <p>Đặt Hàng Thành Công!</p>
                </h3>
                <p>Cám ơn quý khách đã mua hàng tại Kangen Việt Nam, Nhân viên chúng tôi sẽ liên hệ quý khách sớm nhất!</p>
                <div class="text-center">
                    <a href="/" class="btn bg-kangen"><i class="feather icon-chevrons-left"></i> Quay lại trang mua hàng</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
<script>
    $(document).ready(function(){

    });
</script>
@endsection