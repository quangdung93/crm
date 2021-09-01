@extends('themes.kangen.body')
@section('title', $post->seo_title ?: $post->name)
@section('content')
    <nav aria-label="breadcrumb">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="/kinh-nghiem-hay">Tin tức</a></li>
                {{-- <li class="breadcrumb-item active" aria-current="page">{{ $post->categories->name }}</li> --}}
            </ol>
        </div>
    </nav>
    <div class="product-page">
        <div class="container">
            <div class="post-category-wrapper">
                <div class="row">
                    <div class="col-sm-9">
                        <div class="post-detail">
                            <div class="post-item">
                                <div class="cat-name">
                                    <h6 class="text-center">
                                        @foreach($post->categories as $item)
                                            <a href="{{ url($item->link()) }}">{{ $item->name }}</a>@if(!$loop->last), @endif
                                        @endforeach
                                    </h6>
                                </div>
                                <h2 class="post-name text-center">{{ $post->name }}</h2>
                                <div class="post-tagline text-center mb-2">✯ LIÊN HỆ TỔNG ĐÀI: <a href="tel:1900866810">1900.86.68.10</a> ĐỂ ĐƯỢC TƯ VẤN TRỰC TIẾP ✯</div>
                                <div class="content-detail">
                                    {!! $post->body !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="siderbar posts">
                            @include('themes.kangen.posts.siderbar.post-vertical', ['title' => $categorySiderbar->name, 'posts' => $categorySiderbar->posts])
                            @include('themes.kangen.posts.siderbar.post-vertical', ['title' => 'Bài viết liên quan', 'posts' => $postRelated])
                        </div>
                    </div>
                </div>
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