<section class="section-news">
    <div class="container">
        <div class="section-title">
            <div class="icon">
                <i class="feather icon-star"></i>
            </div>
            <h3><a href="#">Tin Tức Hữu Ích</a></h3>
        </div>
        <div class="news-wrapper">
            <div class="top-news">
                @foreach($newPosts as $post)
                    <div class="item">
                        <div class="news-info">
                            <h4><a href="{{ url($post->link()) }}">{{ $post->name }}</a></h4>
                            <p>{!! post_excerpt($post->body, 50) !!}</p>
                            <a href="{{ url($post->link()) }}" class="btn read-more mt-4"><i class="feather icon-chevrons-right"></i> Xem thêm</a>
                        </div>
                        <a href="{{ url($post->link()) }}">
                            <div class="news-img lazy" data-src="&#39;{{asset($post->image)}}&#39;" style='background-size: cover'></div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="bottom-news">
            <div class="row">
                @foreach($listNews as $category)
                <div class="col-sm-4">
                    <div class="bottom-news-item">
                        <div class="title">{{ $category->name }}</div>
                        @if($category->posts->isNotEmpty())
                        <div class="content">
                            @php
                                $firstPost = $category->posts->first();
                            @endphp
                            <div class="news-first">
                                <a href="#">
                                    <div class="news-img lazy" data-src="&#39;{{asset($firstPost->image)}}&#39;" style='background-size: cover'></div>
                                </a>
                                <div class="news-info">
                                    <h4><a href="{{ url($firstPost->link()) }}">{{ $firstPost->name }}</a></h4>
                                    <p>{!! post_excerpt($firstPost->body) !!}</p>
                                </div>
                            </div>
                            <div class="news-lists">
                                @foreach($category->posts as $post)
                                    @if($loop->iteration > 5) @break  @endif
                                    <div class="item">
                                        <a href="{{ url($post->link()) }}">{{ Str::lower(Str::words($post->name, 20)) }}</a>
                                    </div>
                                @endforeach
                            </div>
                            <a href="{{ url($category->link()) }}" class="btn read-more mt-4 bg-kangen"><i class="feather icon-chevrons-right"></i> Xem thêm</a>
                        </div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>