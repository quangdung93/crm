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
                    <div class="info-logo">
                        <img class="img-fluid lazy" data-src="{{ asset($section_7[0]['logo']) }}" alt="{{ $section_7[0]['title'] }}"/>
                    </div>
                </div>
                <div class="col-12 col-sm-6 align-self-center">
                    <div class="info">
                        <h4>{{ $section_7[0]['title'] }}</h4>
                        <p>{{ $section_7[0]['content'] }}</p>
                    </div>
                    <a href="#" class="btn read-more mt-4"><i class="feather icon-chevrons-right"></i> Xem thông tin</a>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-sm-6 align-self-center">
                    <div class="info mt-5">
                        <h4>{{ $section_7[1]['title'] }}</h4>
                        <p>{{ $section_7[1]['content'] }}</p>
                    </div>
                    <a href="#" class="btn read-more mt-4"><i class="feather icon-chevrons-right"></i> Xem thông tin</a>
                </div>
                <div class="col-12 col-sm-6">
                    <div class="img">
                        <img class="img-fluid lazy" data-src="{{ asset($section_7[1]['image']) }}" alt="{{ $section_7[1]['title'] }}"/>
                    </div>
                    <div class="info-logo">
                        <img class="img-fluid lazy" data-src="{{ asset($section_7[1]['logo']) }}" alt="{{ $section_7[1]['title'] }}"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>