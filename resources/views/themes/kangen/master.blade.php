<!DOCTYPE html>
<html lang="vi">
<head>
    <title>{{ $metaData['title'] ?? setting('site_title') }} | Kangen Việt Nam</title>  
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, maximum-scale=1.0, user-scalable=0, initial-scale=1.0" />
    <meta name="robots" content="index, follow" />
    <meta name="description" content="{{ $metaData['description'] ?? setting('site_description') }}" />
    <meta name="keywords" content="{{ $metaData['keyword'] ?? setting('site_keyword') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{asset(setting('site_favicon'))}}" type="image/x-icon">
    <meta property="og:image" content="{{ $metaData['image'] ?? asset(setting('thumbnail')) }}" />
    <meta property="og:title" content="{{ $metaData['title'] ?? setting('site_title') }}" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:type" content="article">
    <meta property="og:description" content="{{ $metaData['description'] ?? setting('site_description') }}" />
    <meta property="twitter:card" content="summary"/>
    <meta property="twitter:image" content="{{ $metaData['image'] ?? asset(setting('thumbnail')) }}" />
    <meta property="twitter:title" content="{{ $metaData['title'] ?? setting('site_title') }}" />
    <meta property="twitter:url" content="{{ url()->current() }}" />
    <meta property="twitter:description" content="{{ $metaData['description'] ?? setting('site_description') }}" />

    {{-- Styles --}}
    <link rel="stylesheet" type="text/css" href="{{ mix('themes/kangen/css/app.min.css') }}"> 
    @yield('styles')

    {{-- Schema --}}
    @yield('schema')
    <script type="text/javascript">
        var BASE_URL = '{{ asset('') }}';
    </script>
    @php
        $google_analytics_id = setting('site_google_analytics_tracking_id');
    @endphp
    @if($google_analytics_id)
    <script>
        (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer', {{ $google_analytics_id }});
    </script>
    @endif

    {{-- Chat --}}
    <script src="https://uhchat.net/code.php?f=cd62d4"></script>
</head>
<body>
    @if($google_analytics_id)
        <noscript>
            <iframe src="https://www.googletagmanager.com/ns.html?id={{ $google_analytics_id }}" height="0" width="0" style="display:none;visibility:hidden"></iframe>
        </noscript> 
    @endif
    @yield('body')
    <script src="{{ mix('themes/kangen/js/app.min.js') }}"></script>

    {{-- Option scripts --}}
    @yield('javascript')
    @stack('javascript')
</body>
</html>