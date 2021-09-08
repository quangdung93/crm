@extends('themes.kangen.body')
@section('title', $postCategory->name)
@section('content')
    <nav aria-label="breadcrumb">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $postCategory->name }}</li>
            </ol>
        </div>
    </nav>
    <div class="product-page">
        <div class="container">
            <div class="post-category-wrapper">
                <div class="row">
                    <div class="col-sm-9">
                        <div class="page-title">
                            <h3>{{ $postCategory->name }}</h3>
                        </div>
                        <div class="post-lists">
                            @foreach($posts as $post)
                                <div class="post-item">
                                    <div class="cat-name">
                                        <h6>
                                            @foreach($post->categories as $item)
                                                <a href="{{ url($item->link()) }}">{{ $item->name }}</a>@if(!$loop->last), @endif
                                            @endforeach
                                        </h6>
                                    </div>
                                    <h2 class="post-name"><a href="{{ url($post->link()) }}">{{ $post->name }}</a></h2>
                                    <div class="post-tagline">✯ LIÊN HỆ TỔNG ĐÀI: <a href="tel:1900866810">1900.86.68.10</a> ĐỂ ĐƯỢC TƯ VẤN TRỰC TIẾP ✯</div>
                                    <div class="post-content">
                                        <div class="image lazy" data-src="&#39;{{asset($post->image)}}&#39;"></div>
                                        <div class="body">
                                            <p>{!! post_excerpt($post->body, 50) !!}</p>
                                            <a href="{{ url($post->link()) }}" class="btn read-more mt-4 bg-kangen"><i class="feather icon-chevrons-right"></i> Xem thêm</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        {!! $posts->render('themes.kangen.components.pagination') !!}
                    </div>
                    <div class="col-sm-3">
                        <div class="siderbar posts">
                            @include('themes.kangen.posts.siderbar.post-vertical', ['title' => $categorySiderbar->name, 'posts' => $categorySiderbar->posts])
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
        
    });
</script>
@endsection