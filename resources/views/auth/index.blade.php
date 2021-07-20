<!DOCTYPE html>
<html lang="en">

<head>
    <title>Đăng nhập</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="#">
    <!-- Favicon icon -->
    
    <link rel="icon" href="{{asset('admin\images\logo.png')}}" type="image/x-icon">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="{{asset('admin/bower_components\bootstrap\css\bootstrap.min.css')}}">
    <!-- themify-icons line icon -->
    <link rel="stylesheet" type="text/css" href="{{asset('admin/assets\icon\themify-icons\themify-icons.css')}}">
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="{{asset('admin/assets\icon\icofont\css\icofont.css')}}">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="{{asset('admin/assets\css\style.css')}}">
    <link rel="stylesheet" href="{{asset('admin/assets/css/login.css')}}">
</head>
<body>
    @yield('content')
    <!-- Warning Section Ends -->
    <script type="text/javascript" src="{{asset('admin/bower_components\jquery\js\jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin/bower_components\jquery-ui\js\jquery-ui.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin/bower_components\popper.js\js\popper.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin/bower_components\bootstrap\js\bootstrap.min.js')}}"></script>
    <!-- jquery slimscroll js -->
    <script type="text/javascript" src="{{asset('admin/bower_components\jquery-slimscroll\js\jquery.slimscroll.js')}}"></script>
    <!-- modernizr js -->
    <script type="text/javascript" src="{{asset('admin/bower_components\modernizr\js\modernizr.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin/bower_components\modernizr\js\css-scrollbars.js')}}"></script>
    <!-- i18next.min.js -->
    <script type="text/javascript" src="{{asset('admin/bower_components\i18next\js\i18next.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin/bower_components\i18next-xhr-backend\js\i18nextXHRBackend.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin/bower_components\i18next-browser-languagedetector\js\i18nextBrowserLanguageDetector.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin/bower_components\jquery-i18next\js\jquery-i18next.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin/assets\js\common-pages.js')}}"></script>
</body>
</html>