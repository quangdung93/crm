@extends('themes.kangen.body')
@section('title', 'Trang chủ')
@section('content')
    {{-- Main Banner --}}
    @include('themes.kangen.components.main-banner')

    @php
        $section_1 = category(theme('home_section_2'));
    @endphp

    @include('themes.kangen.components.product-slider', [
        'title' => $section_1->name, 
        'url' => $section_1->link(), 
        'products' => $section_1->products->take(8)
    ])

    {{-- Banner --}}
    @include('themes.kangen.components.banner', [
        'link' => theme('home_section_3.link'),
        'image' => theme('home_section_3.image'),
        'imageMobile' => theme('home_section_3.mobile'),
    ])

    @php
        $section_4 = category(theme('home_section_4'));
    @endphp

    @include('themes.kangen.components.product-slider', [
        'title' => $section_4->name, 
        'url' => $section_4->link(), 
        'products' => $section_4->products->take(8)
    ])


    @php
        $section_5 = category(theme('home_section_5'));
    @endphp

    @include('themes.kangen.components.product-slider', [
        'title' => $section_5->name, 
        'url' => $section_5->link(), 
        'products' => $section_5->products->take(8)
    ])

    {{-- Youtube --}}
    @include('themes.kangen.components.youtube')

    {{-- Giải pháp đầu nguồn --}}
    @include('themes.kangen.components.solution')

    {{-- Sản phẩm nổi bật --}}
    @include('themes.kangen.components.product-featured')

    {{-- Banner --}}
    @include('themes.kangen.components.banner', [
        'link' => theme('home_section_8.link'),
        'image' => theme('home_section_8.image'),
        'imageMobile' => theme('home_section_8.mobile'),
    ])

    {{-- Post --}}
    @include('themes.kangen.components.news')

    @include('themes.kangen.components.call-to-action')

    {{-- Lợi ích --}}
    @include('themes.kangen.components.benefit')

    {{-- Tại sao chọn chúng tôi --}}
    @include('themes.kangen.components.about')

    {{-- KH nói về chúng tôi --}}
    @include('themes.kangen.components.customer')

@endsection

@section('javascript')
<script>
    $(document).ready(function(){
        //Youtube
        if($('.youtube').length > 0){
            generateYoutubeLazyLoad();
        }

        $('.youtube-item').on('click', function(e){
            e.preventDefault();
            $('.youtube-item').removeClass('active');
            $(this).addClass('active');
            let embed = $(this).find('.video-thumb .youtube-list').data('embed'),
                youtube = renderIframeYoutube(embed);
            $('.section-youtube .preview-intro-video .youtube').html(youtube);
        });

        function generateYoutubeLazyLoad() {
            var youtube = document.querySelectorAll('.youtube');
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

        function generateYoutube() {
            var youtube = document.querySelectorAll(".youtube");
            for (var i = 0; i < youtube.length; i++) {
                // thumbnail image source.
                var source = "https://img.youtube.com/vi/" + youtube[i].dataset.embed + "/hqdefault.jpg"; //sddefault.jpg
                // Load t image asynchronously    
                var image = new Image();
                image.src = source;
                image.addEventListener("load", function () {
                    youtube[i].appendChild(image);
                }(i));
                youtube[i].addEventListener("click", function () {
                    var iframe = document.createElement("iframe");
                    iframe.setAttribute("frameborder", "0");
                    iframe.setAttribute("class", "youtube-video");
                    iframe.setAttribute("allowfullscreen", "");
                    iframe.setAttribute("src", "https://www.youtube.com/embed/" + this.dataset.embed + "?rel=0&showinfo=0&autoplay=1");
                    this.innerHTML = "";
                    this.appendChild(iframe);
                });
            }
        }

        function renderIframeYoutube(embed){
            let iframe = document.createElement("iframe");
                iframe.setAttribute("frameborder", "0");
                iframe.setAttribute("class", "youtube-video");
                iframe.setAttribute("width", "100%");
                iframe.setAttribute("height", "100%");
                iframe.setAttribute("allowfullscreen", "");
                iframe.setAttribute("src", "https://www.youtube.com/embed/" + embed + "?rel=0&showinfo=0&autoplay=1");
                return iframe;
        }
    });
</script>
@endsection