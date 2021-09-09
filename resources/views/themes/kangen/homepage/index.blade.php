@extends('themes.kangen.body')
@section('title', 'Trang chủ')
@section('content')
    <div class="main-banner">
        <div class="container">
            <div class="row">
                <div class="content-wrap">
                    <div class="item left">
                        <div class="title">{{ theme('home_banner.title') }}</div>
                        <div class="content">{{ theme('home_banner.content') }}</div>
                        <a href="{{ theme('home_banner.link') }}" class="btn read-more">Xem thêm <i class="feather icon-chevrons-right"></i></a>
                    </div>
                    <div class="item right">
                        <img class="img-fluid" src="{{ asset(theme('home_banner.image')) }}" alt="Banner main"/>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @php
        $section_1 = category(theme('home_section_2'));
    @endphp

    @include('themes.kangen.components.product-slider', [
        'title' => $section_1->name, 
        'products' => $section_1->products
    ])

    <section class="section-banner">
        <div class="container">
            <a href="{{ theme('home_section_3.link') }}">
                <img class="img-fluid lazy" data-src="{{ theme('home_section_3.image') }}" alt="Banner ảnh" />
            </a>
        </div>
    </section>

    @php
        $section_4 = category(theme('home_section_4'));
    @endphp

    @include('themes.kangen.components.product-slider', [
        'title' => $section_4->name, 
        'products' => $section_4->products
    ])


    @php
        $section_5 = category(theme('home_section_5'));
    @endphp

    @include('themes.kangen.components.product-slider', [
        'title' => $section_5->name, 
        'products' => $section_5->products
    ])

    <section class="section-youtube">
        <div class="container">
            <div class="section-title">
                <a href="https://www.youtube.com/channel/UCzW_KWk1LHq6OkAj0of3iAA" class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="#E41818" class="bi bi-youtube" viewBox="0 0 16 16">
                        <path d="M8.051 1.999h.089c.822.003 4.987.033 6.11.335a2.01 2.01 0 0 1 1.415 1.42c.101.38.172.883.22 1.402l.01.104.022.26.008.104c.065.914.073 1.77.074 1.957v.075c-.001.194-.01 1.108-.082 2.06l-.008.105-.009.104c-.05.572-.124 1.14-.235 1.558a2.007 2.007 0 0 1-1.415 1.42c-1.16.312-5.569.334-6.18.335h-.142c-.309 0-1.587-.006-2.927-.052l-.17-.006-.087-.004-.171-.007-.171-.007c-1.11-.049-2.167-.128-2.654-.26a2.007 2.007 0 0 1-1.415-1.419c-.111-.417-.185-.986-.235-1.558L.09 9.82l-.008-.104A31.4 31.4 0 0 1 0 7.68v-.123c.002-.215.01-.958.064-1.778l.007-.103.003-.052.008-.104.022-.26.01-.104c.048-.519.119-1.023.22-1.402a2.007 2.007 0 0 1 1.415-1.42c.487-.13 1.544-.21 2.654-.26l.17-.007.172-.006.086-.003.171-.007A99.788 99.788 0 0 1 7.858 2h.193zM6.4 5.209v4.818l4.157-2.408L6.4 5.209z"/>
                    </svg>
                </a>
                <h3><a href="#">Youtube Đại Lâm Thịnh</a></h3>
            </div>
            <div class="content">
                @php
                    $youtube = array_values(theme('home_section_youtube'));
                @endphp
                <div class="row">
                    @if(count($youtube) > 0)
                        <div class="col-12 col-sm-8 pr-2">
                            <div class="preview-intro-video">
                                <div class="youtube" data-embed="{{ get_embed_youtube($youtube[0]['link']) }}">
                                    <div class="play-button"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-4 p-0 mt-mb-4">
                            <div class="collect-youtube">
                                @foreach($youtube as $value)
                                    <a href="#" class="youtube-item {{ $loop->first ? 'active' : '' }}">
                                        <div class="video-thumb">
                                            <div class="youtube-list" data-embed="{{ get_embed_youtube($value['link']) }}">
                                                <img class="lazy" data-src="https://img.youtube.com/vi/{{ get_embed_youtube($value['link']) }}/hqdefault.jpg"/>
                                            </div>
                                        </div>
                                        <div class="youtube-title">{{ $value['title'] }}</div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <a href="#" class="btn read-more mt-4">Xem kênh youtube <i class="feather icon-chevrons-right"></i></a>
        </div>
    </section>

    <section class="section-solution">
        <div class="container">
            <div class="section-title">
                <div class="icon">
                    <i class="feather icon-activity"></i>
                </div>
                <h3><a href="#">Giải Pháp Đầu Nguồn</a></h3>
            </div>
            <div class="content">
                @php
                    $section_6 = theme('home_section_6');
                @endphp
                <div class="row">
                    @foreach($section_6 as $value)
                        <div class="col-12 col-sm-4">
                            <div class="img">
                                <img class="img-fluid lazy" data-src="{{ asset($value['image']) }}" alt=""/>
                            </div>
                            <a href="{{ $value['link'] }}" class="btn read-more mt-4"><i class="feather icon-chevrons-right"></i> Xem thông tin</a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="section-solution">
        <div class="container">
            <div class="section-title">
                <div class="icon">
                    <i class="feather icon-star"></i>
                </div>
                <h3><a href="#">Sản Phẩm Nổi Bật</a></h3>
            </div>
            <div class="content">
                @php
                    $section_7 = theme('home_section_7');
                @endphp
                <div class="row">
                    <div class="col-12 col-sm-6">
                        <div class="img">
                            <img class="img-fluid lazy" data-src="{{ asset($section_7[0]['image']) }}" alt="{{ $section_7[0]['title'] }}"/>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="info">
                            <h4>{{ $section_7[0]['title'] }}</h4>
                            <p>{{ $section_7[0]['content'] }}</p>
                        </div>
                        <div class="info-logo">
                            <img class="img-fluid lazy" data-src="{{ asset($section_7[0]['logo']) }}" alt="{{ $section_7[0]['title'] }}"/>
                        </div>
                        <a href="#" class="btn read-more mt-4"><i class="feather icon-chevrons-right"></i> Xem thông tin</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-sm-6">
                        <div class="info mt-5">
                            <h4>{{ $section_7[1]['title'] }}</h4>
                            <p>{{ $section_7[1]['content'] }}</p>
                        </div>
                        <div class="info-logo">
                            <img class="img-fluid lazy" data-src="{{ asset($section_7[1]['logo']) }}" alt="{{ $section_7[1]['title'] }}"/>
                        </div>
                        <a href="#" class="btn read-more mt-4"><i class="feather icon-chevrons-right"></i> Xem thông tin</a>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="img">
                            <img class="img-fluid lazy" data-src="{{ asset($section_7[1]['image']) }}" alt="{{ $section_7[1]['title'] }}"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <section class="section-banner">
        <div class="container">
            <a href="{{ theme('home_section_8.link') }}">
                <img class="img-fluid lazy" data-src="{{ theme('home_section_8.image') }}" alt="Banner ảnh 2" />
            </a>
        </div>
    </section>

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
                                <h4><a href="#">{{ $post->name }}</a></h4>
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

    @include('themes.kangen.components.call-to-action')

    <section class="section-benefit">
        <div class="container">
            <div class="section-title">
                <div class="icon">
                    <i class="feather icon-award"></i>
                </div>
                <h3><a href="#">Lợi Ích Của Máy Lọc Nước Kangen</a></h3>
            </div>
            <div class="content">
                @php
                    $section_11 = theme('home_section_11');
                @endphp
                <div class="row">
                    @foreach($section_11 as $value)
                        <div class="col-6 col-sm-3">
                            <div class="benefit-item">
                                <div class="icon"><i class="{{ $value['icon'] }}"></i></div>
                                <div class="info">
                                    {!! render_split_textarea($value['content']) !!}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="section-contact">
        <div class="container">
            <div class="section-title text-left">
                <h3><a href="#">TẠI SAO CHỌN CHÚNG TÔI?</a></h3>
                <p>Chúng tôi tự hào là nhà phân phối Ủy Quyền của công ty Kangen Việt Nam.</p>
            </div>
            <div class="content">
                @php
                    $section12 = theme('home_section_12');
                @endphp
                <div class="row">
                    <div class="col-sm-8">
                        @foreach(array_chunk($section12, 2) as $value)
                            <div class="contact-home-block">
                                @foreach($value as $item)
                                    <div class="item">
                                        <div class="image">
                                            <img class="img-fuild lazy" data-src="{{ asset($item['image']) }}" alt="{{ $item['title'] }}" />
                                        </div>
                                        <div class="info">
                                            <p>{{ $item['title'] }}</p>
                                            <p>{{ $item['content'] }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                    <div class="col-sm-4">
                        <div class="contact-form">
                            <div class="frm-title">Yêu Cầu Gọi Lại</div>
                            <form action="" method="POST">
                                <div class="form-group">
                                    <input type="text" name="" value="" class="form-control" placeholder="Họ và tên" />
                                </div>
                                <div class="form-group">
                                    <input type="text" name="" value="" class="form-control" placeholder="Số điện thoại" />
                                </div>
                                <div class="form-group">
                                    <textarea name="" placeholder="Lời nhắn" class="form-control"></textarea>
                                </div>
                                <div class="form-group">
                                    <button class="btn read-more mt-4">Gửi Yêu Cầu</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-customer">
        <div class="container">
            <div class="section-title">
                <div class="icon">
                    <i class="feather icon-users"></i>
                </div>
                <h3><a href="#">KHÁCH HÀNG NÓI GÌ VỀ CHÚNG TÔI</a></h3>
                <p class="mt-4">Đừng nghe chúng tôi nói, hãy nhìn vào những nhận xét của khách hàng đã sử dụng dịch vụ của chúng tôi.</p>
            </div>
            <div class="content">
                <div class="cusomter-slider">
                    <div class="item">
                        <div class="image">
                            <img class="img-fuild lazy" data-src="https://kangenvietnam.vn/wp-content/uploads/2018/02/ts-ngo-duc-vuong-150x150.jpg" alt="" />
                        </div>
                        <div class="info">Nước kiềm Kangen của tập toàn Enagic là nguồn nước hỗ trợ chữa bệnh cho tôi. Nguồn nước Kangen có tính dương nên khi uống sẽ quân bình tính âm trong cơ thể bạn. Tôi khuyên dùng trong việc điều trị chữa bệnh và dưỡng sinh.</div>
                        <div class="customer-name">
                            <h5>TS. NGÔ ĐỨC VƯỢNG</h5>
                            <p>Lương Y Quốc Gia - ĐH Quốc Gia HN</p>
                        </div>
                    </div>
                    <div class="item">
                        <div class="image">
                            <img class="img-fuild lazy" data-src="https://kangenvietnam.vn/wp-content/uploads/2018/07/bac-si-tien-si-HIROMI-SHINYA-150x150.jpg" alt="" />
                        </div>
                        <div class="info">Với 6 - 10 ly nước Kangen 9.5 mỗi ngày sẽ giúp cơ thể loại bỏ được một lượng axit gây hại trong cơ thể. Nước Kangen giúp tăng lượng hồng huyết cầu lên não giúp phòng chống được bệnh tai biến mạch mãu não và đột quỵ.</div>
                        <div class="customer-name">
                            <h5>GS-BS. HIROMI SHINYA</h5>
                            <p>Giáo Sư - Bác Sĩ phẫu thuật ĐH Y Khoa Albert Einstein</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('javascript')
<script>
    $(document).ready(function(){
        //generateYoutubeItem();

        $('.youtube-list img').each(function(){
            $(this).lazyload();
        });

        $('.youtube-item').on('click', function(e){
            e.preventDefault();
            $('.youtube-item').removeClass('active');
            $(this).addClass('active');
            let embed = $(this).find('.video-thumb .youtube-list').data('embed'),
                youtube = renderIframeYoutube(embed);
            $('.section-youtube .preview-intro-video .youtube').html(youtube);
        });

        function generateYoutubeItem() {
            var youtube = document.querySelectorAll('.youtube-list');
            for (var i = 0; i < youtube.length; i++) {
                // thumbnail image source.
                var source = "https://img.youtube.com/vi/" + youtube[i].dataset.embed + "/hqdefault.jpg"; //sddefault.jpg
                // Load t image asynchronously    
                var image = new Image();
                image.setAttribute("class", "lazy");
                image.setAttribute("data-src", source);
                image.addEventListener("load", function () {
                    youtube[i].appendChild(image);
                    youtubeLazyLoad(youtube[i].querySelectorAll('.lazy'));
                }(i));
            }
        }

        function youtubeLazyLoad(element, timeout = 0) {
            setTimeout(function () {
                $(element).lazyload().addClass('youtube-loaded');
            }, timeout);
        }
    });
</script>
@endsection