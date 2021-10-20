<div class="hotline-phone-ring-wrap {{ $class ?? '' }}">
    <div class="hotline-phone-ring">
        <div class="hotline-phone-ring-circle"></div>
        <div class="hotline-phone-ring-circle-fill"></div>
        <div class="hotline-phone-ring-img-circle">
            <a href="tel:{{ str_replace('.','', $phone) }}" class="pps-btn-img">
                <img class="lazy" data-src="{{ asset('themes/kangen/images/icon-call.png') }}" alt="Gọi điện thoại" width="50">
            </a>
        </div>
    </div>
    <div class="hotline-bar">
        <a href="tel:{{ str_replace('.','', $phone) }}">
            <span class="text-hotline">{{ $phone }}</span>
        </a>
    </div>
</div>