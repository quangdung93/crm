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
                                    <div class="post-tagline">✯ LIÊN HỆ TỔNG ĐÀI: 1900.86.68.10 ĐỂ ĐƯỢC TƯ VẤN TRỰC TIẾP ✯</div>
                                    <div class="post-content">
                                        <div class="image lazy" data-src="&#39;{{asset($post->image)}}&#39;"></div>
                                        <div class="body">
                                            <p>Bạn đang tìm hiểu về nước Kangen hay đã sử dụng được một khoảng thời gian nhưng vẫn chưa hiểu hết được cụ thể công dụng của các loại nước quý này. Nếu bạn muốn tìm hiểu rõ ràng hơn thì bài viết dưới đây giúp bạn giải đáp thắc mắc về nước điện giả</p>
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
                            <div class="siderbar-title">{{ $categorySiderbar->name }}</div>
                            <div class="siderbar-content">
                                @foreach($categorySiderbar->posts as $item)
                                    <div class="item">
                                        <a href="{{ url($item->link()) }}">
                                            <div class="image lazy" data-src="&#39;{{asset($item->image)}}&#39;"></div>
                                        </a>
                                        <div class="content">
                                            <a href="{{ url($item->link()) }}">{{ $item->name }}</a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
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