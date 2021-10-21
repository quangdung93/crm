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
                        <div class="youtube-main-title">{{ $youtube[0]['title'] }}</div>
                    </div>
                    <div class="col-12 col-sm-4 p-0 mt-mb-4">
                        <div class="text-center">
                            <div class="btn bg-kangen mb-2">Click bên dưới để xem thêm video <i class="animated backInDown feather icon-chevrons-down"></i></div>
                        </div>
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