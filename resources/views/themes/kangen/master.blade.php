<!DOCTYPE html>
<html lang="vi">
<head>
    <title>@yield('title') | Kangen Việt Nam</title>  
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="robots" content="noindex, nofollow" />
    <!-- Favicon icon -->
    <link rel="icon" href="{{asset(setting('site_favicon'))}}" type="image/x-icon">
    <!-- Google font-->
    {{-- <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&amp;subset=vietnamese" rel="stylesheet"> --}}
    <meta property="og:image" content="{{ asset(setting('thumbnail')) }}" />
    <meta property="og:title" content="{{ setting('site_title') }}" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:type" content="article">
    <meta property="og:description" content="{{ setting('site_description') }}" />
    <meta property="twitter:card" content="summary"/>
    <meta property="twitter:image" content="{{ asset(setting('thumbnail')) }}" />
    <meta property="twitter:title" content="{{ setting('site_title') }}" />
    <meta property="twitter:url" content="{{ url()->current() }}" />
    <meta property="twitter:description" content="{{ setting('site_description') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('themes/kangen/css/app.min.css') }}"> 
    <link rel="stylesheet" type="text/css" href="{{ asset('themes/kangen/css/styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('themes/kangen/css/product.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('themes/kangen/css/post.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('themes/kangen/css/responsive.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script type="text/javascript">
        var BASE_URL = '{{ asset('') }}';
    </script>
    @yield('styles')
</head>
<body>
    @yield('body')
    <script src="{{ asset('themes/kangen/js/app.min.js') }}"></script>
    <script src="{{ asset('themes/kangen/js/custom.js') }}"></script>
    {{-- Option scripts --}}
    @yield('javascript')
    @stack('javascript')
</body>
</html>