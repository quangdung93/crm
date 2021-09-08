<section class="section-products border-section">
    <div class="container">
        <div class="section-title">
            <div class="icon">
                <i class="feather icon-slack"></i>
            </div>
            <h3><a href="#">{{ $title }}</a></h3>
        </div>
        <div class="content">
            <div class="sliders row" data-slick='{"dots": false, "pauseOnHover": true, "infinite": true, "slidesToShow": 4, "slidesToScroll": 4, "speed": 600, "arrows": false, "autoplay": false, "autoplaySpeed": 3000, "swipe": true, "draggable": true, "rtl": false,  "responsive": [ {"breakpoint": 1100, "settings": { "slidesToShow": 4 } }, {"breakpoint": 990, "settings": { "slidesToShow": 2 } }, {"breakpoint": 650, "settings": { "slidesToShow": 2, "dots": false, "arrows": false } } ] }'>
                {!! product_template($products) !!}
            </div>
        </div>
    </div>
</section>