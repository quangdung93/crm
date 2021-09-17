<!DOCTYPE html>
<html lang="vi">
<head>
    <title>{{ $metaData['title'] ?? setting('site_title') }} | Kangen Việt Nam</title>  
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, maximum-scale=1.0, user-scalable=0, initial-scale=1.0" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="robots" content="index, follow" />
    <meta name="description" content="{{ $metaData['description'] ?? setting('site_description') }}" />
    <meta name="keywords" content="{{ $metaData['keyword'] ?? setting('site_keyword') }}" />
    <!-- Favicon icon -->
    <link rel="icon" href="{{asset(setting('site_favicon'))}}" type="image/x-icon">
    <!-- Google font-->
    {{-- <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&amp;subset=vietnamese" rel="stylesheet"> --}}
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
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('themes/kangen/css/styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('themes/kangen/css/product.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('themes/kangen/css/post.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('themes/kangen/css/responsive.css') }}"> --}}
    @yield('styles')
    
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script type="text/javascript">
        var BASE_URL = '{{ asset('') }}';
    </script>
</head>
<body>
    @yield('body')
    <script src="{{ mix('themes/kangen/js/app.min.js') }}"></script>
    {{-- <script src="{{ asset('themes/kangen/js/custom.js') }}"></script> --}}
    {{-- <script src="{{ asset('themes/kangen/js/cart.js') }}"></script> --}}
    {{-- Option scripts --}}
    @yield('javascript')
    @stack('javascript')
</body>
</html>