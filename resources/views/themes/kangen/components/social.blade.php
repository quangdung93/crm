@php
    $facebook = setting('site_facebook_link');
    $google = setting('site_google_plus');
    $twitter = setting('site_twitter');
    $instagram = setting('site_instagram');
    $youtube = setting('site_youtube');
@endphp
<div class="social">
    @if($facebook)
        <a href="{{ $facebook }}" class="item-social btn-facebook"><i class="feather icon-facebook"></i></a>
    @endif

    @if($google)
    <a href="{{ $google }}" class="item-social btn-zalo">
        <img width="40" height="40" src="{{ asset('themes/kangen/images/zalo.png') }}" alt="Zalo" />
    </a>
    @endif
</div>