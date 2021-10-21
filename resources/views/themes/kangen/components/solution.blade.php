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