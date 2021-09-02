@extends('themes.kangen.body')
@section('title', $page->meta_title ?: $page->name)
@section('content')
    <nav aria-label="breadcrumb">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $page->name }}</li>
            </ol>
        </div>
    </nav>
    <div class="product-page">
        <div class="container">
            <div class="post-category-wrapper">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="post-detail">
                            <div class="post-item">
                                <h2 class="post-name text-center">{{ $page->name }}</h2>
                                <div class="post-tagline text-center mb-2">✯ LIÊN HỆ TỔNG ĐÀI: <a href="tel:1900866810">1900.86.68.10</a> ĐỂ ĐƯỢC TƯ VẤN TRỰC TIẾP ✯</div>
                                <div class="content-detail">
                                    {!! $page->body !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {!! shortcode('thongtin') !!}
            </div>
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