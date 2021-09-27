@php
    $facebook = setting('site_facebook_link');
    $zalo = setting('site_zalo');
@endphp
<div class="social">
    @if($facebook)
        <a href="{{ $facebook }}" class="item-social btn-facebook"><i class="feather icon-facebook"></i></a>
    @endif

    @if($zalo)
        <a href="{{ $zalo }}" class="item-social btn-zalo">
            <img width="40" height="40" src="{{ asset('themes/kangen/images/zalo.png') }}" alt="Zalo" />
        </a>
    @endif
</div>