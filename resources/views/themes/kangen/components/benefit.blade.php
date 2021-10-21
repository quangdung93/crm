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