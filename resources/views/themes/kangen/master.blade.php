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
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&amp;subset=vietnamese" rel="stylesheet">
    
    <link rel="stylesheet" type="text/css" href="{{ asset('themes/kangen/css/app.min.css') }}"> 
    <link rel="stylesheet" type="text/css" href="{{ asset('themes/kangen/css/styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('themes/kangen/css/responsive.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script type="text/javascript">
        var BASE_URL = '{{ asset('') }}';
    </script>
    @yield('styles')
</head>
<body>
    @yield('body')
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="{{ asset('themes/kangen/js/app.min.js') }}"></script>
    <script src="{{ asset('themes/kangen/js/custom.js') }}"></script>
    {{-- Option scripts --}}
    @yield('javascript')
    @stack('javascript')
</body>
</html>