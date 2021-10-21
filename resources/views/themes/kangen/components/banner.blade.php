<section class="section-banner">
    <div class="container">
        <a href="{{ $link }}">
            @if(detectDevice() == 'desktop')
                <img class="img-fluid lazy" data-src="{{ $image }}" alt="Banner ảnh" />
            @else
                <img class="img-fluid lazy" data-src="{{ $imageMobile }}" alt="Banner ảnh" />
            @endif
        </a>
    </div>
</section>