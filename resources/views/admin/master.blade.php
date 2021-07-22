<!DOCTYPE html>
<html lang="vi">
<head>
    <title>Admin</title>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="robots" content="noindex, nofollow" />
    <!-- Favicon icon -->
    <link rel="icon" href="{{asset(setting('site_favicon'))}}" type="image/x-icon">
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="{{asset('admin/bower_components/bootstrap/css/bootstrap.min.css')}}">
    <!-- feather Awesome -->
    <link rel="stylesheet" type="text/css" href="{{asset('admin/assets/icon/feather/css/feather.css')}}">
    <!-- Date-time picker css --> 
    <link rel="stylesheet" type="text/css" href="{{asset('admin/assets\pages\advance-elements\css\bootstrap-datetimepicker.css')}}">
    <!-- notify js Fremwork -->
    <link rel="stylesheet" type="text/css" href="{{asset('admin\bower_components\pnotify\css\pnotify.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin\bower_components\pnotify\css\pnotify.brighttheme.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin\bower_components\pnotify\css\pnotify.buttons.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin\bower_components\pnotify\css\pnotify.history.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin\bower_components\pnotify\css\pnotify.mobile.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin\assets\pages\pnotify\notify.css')}}">
     <!-- Data Table Css -->
    <link rel="stylesheet" type="text/css" href="{{asset('admin\bower_components\datatables.net-bs4\css\dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin\assets\pages\data-table\css\buttons.dataTables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin\bower_components\datatables.net-responsive-bs4\css\responsive.bootstrap4.min.css')}}">
    <!-- Switch component css -->
    <link rel="stylesheet" type="text/css" href="{{asset('admin\bower_components\switchery\css\switchery.min.css')}}">
    <!-- Select 2 css -->
    <link rel="stylesheet" href="{{asset('admin\bower_components\select2\css\select2.min.css')}}">
    @yield('style_admin')
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="{{asset('admin/assets/css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/assets/css/jquery.mCustomScrollbar.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/css/theme.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/css/custom.css')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script type="text/javascript">
        var URL_MAIN = '{{ asset('') }}';
    </script>
    @yield('styles')
</head>
<body>
    @yield('body')

    <!-- Required Jquery -->
    {{-- <script data-cfasync="false" src="{{asset('admin/..\..\cdn-cgi\scripts\5c5dd728\cloudflare-static\email-decode.min.js')}}"></script> --}}
    <script type="text/javascript" src="{{asset('admin/bower_components/jquery/js/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin/bower_components/jquery-ui/js/jquery-ui.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin/bower_components/popper.js/js/popper.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin/bower_components/bootstrap/js/bootstrap.min.js')}}"></script>
    <!-- jquery slimscroll js -->
    <script type="text/javascript" src="{{asset('admin/bower_components/jquery-slimscroll/js/jquery.slimscroll.js')}}"></script>
    <!-- modernizr js -->
    <script type="text/javascript" src="{{asset('admin/bower_components/modernizr/js/modernizr.js')}}"></script>
    <!-- Chart js -->
    <script type="text/javascript" src="{{asset('admin/bower_components/chart.js/js/Chart.js')}}"></script>
    <!-- amchart js -->
    <script src="{{asset('admin/assets/pages/widget/amchart/amcharts.js')}}"></script>
    <script src="{{asset('admin/assets/pages/widget/amchart/serial.js')}}"></script>
    <script src="{{asset('admin/assets/pages/widget/amchart/light.js')}}"></script>
    <script src="{{asset('admin/assets/js/jquery.mCustomScrollbar.concat.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin/assets/js/SmoothScroll.js')}}"></script>
    <script src="{{asset('admin/assets/js/pcoded.min.js')}}"></script>
    <!-- TinyMCE Editor -->
    <script src="{{asset('tinymce/js/tinymce/tinymce.min.js')}}"></script>
    <!-- DATETIME PICKER JS -->
    <script src="{{asset('admin\assets\pages\advance-elements\moment-with-locales.min.js')}}"></script>
    <script src="{{asset('admin\bower_components\bootstrap-datepicker\js\bootstrap-datepicker.min.js')}}"></script>
    <script src="{{asset('admin\assets\pages\advance-elements\bootstrap-datetimepicker.min.js')}}"></script>
    <!-- pnotify js -->
    <script type="text/javascript" src="{{asset('admin\bower_components\pnotify\js\pnotify.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin\bower_components\pnotify\js\pnotify.desktop.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin\bower_components\pnotify\js\pnotify.buttons.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin\bower_components\pnotify\js\pnotify.confirm.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin\bower_components\pnotify\js\pnotify.callbacks.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin\bower_components\pnotify\js\pnotify.animate.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin\bower_components\pnotify\js\pnotify.history.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin\bower_components\pnotify\js\pnotify.mobile.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin\bower_components\pnotify\js\pnotify.nonblock.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin\assets\pages\pnotify\notify.js')}}"></script>
    <!-- data-table js -->
    <script src="{{asset('admin\bower_components\datatables.net\js\jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('admin\bower_components\datatables.net-buttons\js\dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('admin\assets\pages\data-table\js\jszip.min.js')}}"></script>
    <script src="{{asset('admin\assets\pages\data-table\js\pdfmake.min.js')}}"></script>
    <script src="{{asset('admin\assets\pages\data-table\js\vfs_fonts.js')}}"></script>
    <script src="{{asset('admin\bower_components\datatables.net-buttons\js\buttons.print.min.js')}}"></script>
    <script src="{{asset('admin\bower_components\datatables.net-buttons\js\buttons.html5.min.js')}}"></script>
    <script src="{{asset('admin\bower_components\datatables.net-bs4\js\dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('admin\bower_components\datatables.net-responsive\js\dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('admin\bower_components\datatables.net-responsive-bs4\js\responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('admin\assets\pages\data-table\js\data-table-custom.js')}}"></script>
    <script src="{{asset('admin\assets\pages\data-table\extensions\fixed-header\js\dataTables.fixedHeader.min.js')}}"></script>
    <!-- Switch component js -->
    <script src="{{asset('admin\bower_components\switchery\js\switchery.min.js')}}" type="text/javascript"></script>
    <!-- Select 2 js -->
    <script type="text/javascript" src="{{asset('admin\bower_components\select2\js\select2.full.min.js')}}"></script>
    {{-- Lodash --}}
    <script type="text/javascript" src="{{asset('admin\assets\js\lodash.min.js')}}"></script>
    {{-- nestable --}}
    <script type="text/javascript" src="{{asset('admin/assets/pages/nestable/jquery.nestable.js')}}"></script>
    <!-- custom js -->
    <script src="{{asset('admin/assets/js/vartical-layout.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin/assets/pages/dashboard/custom-dashboard.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin/assets/js/script.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin/js/common-admin.js')}}"></script>

    <!--Custom TinyMCE Editor -->
    <script type="text/javascript" src="{{asset('admin/js/tinymce-custom.js')}}"></script>
    @yield('javascript')
    @stack('javascript')
</body>
</html>