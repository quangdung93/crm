const mix = require('laravel-mix');

//Vendor CSS Site
mix.styles([
    'resources/css/bootstrap.min.css',
    'resources/css/animate.min.css',
    'public/admin/assets/icon/feather/css/feather.css',
    'resources/css/common.css',
    'resources/css/slick.css',

    ], 'public/themes/kangen/css/app.min.css');

//Javascripts Site
mix.scripts([
    'resources/js/jquery.min.js',
    'resources/js/boostrap.min.js',
    'resources/js/slick.min.js',
    'resources/js/lazyload.min.js',
], 'public/themes/kangen/js/app.min.js');



// *********************** ADMIN PAGE ********************************

//Vendor CSS Admin
mix.styles([
    //Bootstrap
    'public/admin/bower_components/bootstrap/css/bootstrap.min.css',

    //Datetime Picker
    'public/admin/assets/pages/advance-elements/css/bootstrap-datetimepicker.css',

    //Font
    'public/admin/assets/icon/feather/css/feather.css',

    //Notify
    'public/admin/bower_components/pnotify/css/pnotify.css',
    'public/admin/bower_components/pnotify/css/pnotify.brighttheme.css',
    'public/admin/bower_components/pnotify/css/pnotify.buttons.css',
    'public/admin/bower_components/pnotify/css/pnotify.history.css',
    'public/admin/bower_components/pnotify/css/pnotify.mobile.css',
    'public/admin/assets/pages/pnotify/notify.css',

    //Datatable
    'public/admin/bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css',
    'public/admin/assets/pages/data-table/css/buttons.dataTables.min.css',
    'public/admin/bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css',

    //Switch component css
    'public/admin/bower_components/switchery/css/switchery.min.css',

    //Select 2
    'public/admin/bower_components/select2/css/select2.min.css',
    'public/admin/assets/css/style.css',
    'public/admin/assets/css/jquery.mCustomScrollbar.css',

    ], 'public/admin/css/vendor.min.css');

//Vendor JS
// mix.scripts([
//     'public/admin/bower_components/jquery/js/jquery.min.js',
//     'public/admin/bower_components/bootstrap/js/bootstrap.min.js',
//     'public/admin/bower_components/jquery-ui/js/jquery-ui.min.js',
//     'public/admin/bower_components/popper.js/js/popper.min.js',

//     //Jquery slimscroll js
//     'public/admin/bower_components/jquery-slimscroll/js/jquery.slimscroll.js',
//     //Modernizr js
//     'public/admin/bower_components/modernizr/js/modernizr.js',

//     //Chart
//     // 'public/admin/bower_components/chart.js/js/Chart.js',
//     // 'public/admin/assets/pages/widget/amchart/amcharts.js',
//     'public/admin/assets/pages/widget/amchart/serial.js',
//     'public/admin/assets/pages/widget/amchart/light.js',
//     'public/admin/assets/js/jquery.mCustomScrollbar.concat.min.js',
//     'public/admin/assets/js/SmoothScroll.js',
//     'public/admin/assets/js/pcoded.min.js',

//     //TinyMCE
//     'public/tinymce/js/tinymce/tinymce.min.js',

//     //Datetime Picker
//     'public/admin/assets/pages/advance-elements/moment-with-locales.min.js',
//     'public/admin/bower_components/bootstrap-datepicker/js/bootstrap-datepicker.min.js',
//     'public/admin/assets/pages/advance-elements/bootstrap-datetimepicker.min.js',
    
//     //Notify js
//     'public/admin/bower_components/pnotify/js/pnotify.js',
//     'public/admin/bower_components/pnotify/js/pnotify.desktop.js',
//     'public/admin/bower_components/pnotify/js/pnotify.buttons.js',
//     'public/admin/bower_components/pnotify/js/pnotify.confirm.js',
//     'public/admin/bower_components/pnotify/js/pnotify.callbacks.js',
//     'public/admin/bower_components/pnotify/js/pnotify.animate.js',
//     'public/admin/bower_components/pnotify/js/pnotify.history.js',
//     'public/admin/bower_components/pnotify/js/pnotify.mobile.js',
//     'public/admin/bower_components/pnotify/js/pnotify.nonblock.js',
//     'public/admin/assets/pages/pnotify/notify.js',

//     //Datatables
//     'public/admin/bower_components/datatables.net/js/jquery.dataTables.min.js',
//     'public/admin/bower_components/datatables.net-buttons/js/dataTables.buttons.min.js',
//     'public/admin/assets/pages/data-table/js/jszip.min.js',
//     'public/admin/assets/pages/data-table/js/pdfmake.min.js',
//     'public/admin/assets/pages/data-table/js/vfs_fonts.js',
//     'public/admin/bower_components/datatables.net-buttons/js/buttons.print.min.js',
//     'public/admin/bower_components/datatables.net-buttons/js/buttons.html5.min.js',
//     'public/admin/bower_components/datatables.net-bs4/js/dataTables.bootstrap4.min.js',
//     'public/admin/bower_components/datatables.net-responsive/js/dataTables.responsive.min.js',
//     'public/admin/bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js',
//     'public/admin/assets/pages/data-table/js/data-table-custom.js',
//     'public/admin/assets/pages/data-table/extensions/fixed-header/js/dataTables.fixedHeader.min.js',
    
//     //Switch component
//     'public/admin/bower_components/switchery/js/switchery.min.js',

//     //Select 2
//     'public/admin/bower_components/select2/js/select2.full.min.js',

//     //Lodash
//     'public/admin/assets/js/lodash.min.js',

//     //Nestable
//     'public/admin/assets/pages/nestable/jquery.nestable.js',

//     //Layout
//     'public/admin/assets/js/vartical-layout.min.js',
//     'public/admin/assets/js/script.min.js',

//     ], 'public/admin/js/vendor.min.js');

// if(mix.inProduction()){
//     mix.version()
// }else{
//     mix.sourceMaps()
// }

mix.disableNotifications();