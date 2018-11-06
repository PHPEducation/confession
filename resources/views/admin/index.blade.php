<!DOCTYPE html>
<!--[if IE 8]>
<html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]>
<html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->

<head>
    <meta charset="utf-8"/>
    <title>{{ trans('message.title_admin') }}</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset(config('common.img') . 'icon.png') }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <meta content="Preview page of Metronic Admin Theme #1 for statistics, charts, recent events and reports"
          name="description"/>
    <meta content="" name="author"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="{{ asset('bower_components/demo-bower/confession/admin/fonts/fonts.woff2') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('bower_components/demo-bower/confession/admin/assets/global/plugins/font-awesome/css/font-awesome.min.css') }}"
          rel="stylesheet" type="text/css"/>
    <link href="{{ asset('bower_components/demo-bower/confession/admin/assets/global/plugins/simple-line-icons/simple-line-icons.min.css') }}"
          rel="stylesheet" type="text/css"/>
    <link href="{{ asset('bower_components/demo-bower/confession/admin/assets/global/plugins/bootstrap/css/bootstrap.min.css') }}"
          rel="stylesheet" type="text/css"/>
    <link href="{{ asset('bower_components/demo-bower/confession/admin/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css') }}"
          rel="stylesheet" type="text/css"/>
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="{{ asset('bower_components/demo-bower/confession/admin/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css') }}"
          rel="stylesheet" type="text/css"/>
    <link href="{{ asset('bower_components/demo-bower/confession/admin/assets/global/plugins/morris/morris.css') }}"
          rel="stylesheet" type="text/css"/>
    <link href="{{ asset('bower_components/demo-bower/confession/admin/assets/global/plugins/fullcalendar/fullcalendar.min.css') }}"
          rel="stylesheet" type="text/css"/>
    <link href="{{ asset('bower_components/demo-bower/confession/admin/assets/global/plugins/jqvmap/jqvmap/jqvmap.css') }}"
          rel="stylesheet" type="text/css"/>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="{{ asset('bower_components/demo-bower/confession/admin/assets/global/css/components.min.css') }}"
          rel="stylesheet" id="style_components" type="text/css"/>
    <link href="{{ asset('bower_components/demo-bower/confession/admin/assets/global/css/plugins.min.css') }}"
          rel="stylesheet" type="text/css"/>
    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->
    <link href="{{ asset('bower_components/demo-bower/confession/admin/assets/layouts/layout/css/layout.min.css') }}"
          rel="stylesheet" type="text/css"/>
    <link href="{{ asset('bower_components/demo-bower/confession/admin/assets/layouts/layout/css/themes/darkblue.min.css') }}"
          rel="stylesheet" type="text/css" id="style_color"/>
    <link href="{{ asset('bower_components/demo-bower/confession/admin/assets/layouts/layout/css/custom.min.css') }}"
          rel="stylesheet" type="text/css"/>
    <!-- END THEME LAYOUT STYLES -->

    <link href="{{ asset('bower_components/demo-bower/confession/admin/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}"/>
    <link href="{{ asset('bower_components/demo-bower/confession/admin/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}"/>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css"/>
</head>

<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
<div class="page-wrapper">
{{--nav_top_header--}}
@include('admin.nav_top')

<!-- BEGIN HEADER & CONTENT DIVIDER -->
    <div class="clearfix"></div>
    <!-- END HEADER & CONTENT DIVIDER -->

    <!-- BEGIN CONTAINER -->
    <div class="page-container">
        <!-- BEGIN SIDEBAR -->
        <div class="page-sidebar-wrapper">
            @include('admin.nav_left')
        </div>
        <!-- END SIDEBAR -->

        <!-- BEGIN CONTENT -->
        <div class="page-content-wrapper">
            <!-- BEGIN CONTENT BODY -->
            <div class="page-content">
                @yield('content')
            </div>
            <!-- END CONTENT BODY -->
        </div>
        <!-- END CONTENT -->
    </div>
    <!-- END CONTAINER -->

    <!-- BEGIN FOOTER -->
    <div class="page-footer">
        @include('admin.footer');
    </div>
    <!-- END FOOTER -->
</div>

<!-- BEGIN CORE PLUGINS -->
<script src="{{ asset('bower_components/demo-bower/confession/admin/assets/global/plugins/jquery.min.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('bower_components/demo-bower/confession/admin/assets/global/plugins/bootstrap/js/bootstrap.min.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('bower_components/demo-bower/confession/admin/assets/global/plugins/js.cookie.min.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('bower_components/demo-bower/confession/admin/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('bower_components/demo-bower/confession/admin/assets/global/plugins/jquery.blockui.min.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('bower_components/demo-bower/confession/admin/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"
        type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="{{ asset('bower_components/demo-bower/confession/admin/assets/global/plugins/moment.min.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('bower_components/demo-bower/confession/admin/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('bower_components/demo-bower/confession/admin/assets/global/plugins/morris/morris.min.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('bower_components/demo-bower/confession/admin/assets/global/plugins/morris/raphael-min.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('bower_components/demo-bower/confession/admin/assets/global/plugins/counterup/jquery.waypoints.min.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('bower_components/demo-bower/confession/admin/assets/global/plugins/counterup/jquery.counterup.min.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('bower_components/demo-bower/confession/admin/assets/global/plugins/amcharts/amcharts/amcharts.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('bower_components/demo-bower/confession/admin/assets/global/plugins/amcharts/amcharts/serial.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('bower_components/demo-bower/confession/admin/assets/global/plugins/amcharts/amcharts/pie.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('bower_components/demo-bower/confession/admin/assets/global/plugins/amcharts/amcharts/radar.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('bower_components/demo-bower/confession/admin/assets/global/plugins/amcharts/amcharts/themes/light.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('bower_components/demo-bower/confession/admin/assets/global/plugins/amcharts/amcharts/themes/patterns.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('bower_components/demo-bower/confession/admin/assets/global/plugins/amcharts/amcharts/themes/chalk.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('bower_components/demo-bower/confession/admin/assets/global/plugins/amcharts/ammap/ammap.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('bower_components/demo-bower/confession/admin/assets/global/plugins/amcharts/ammap/maps/js/worldLow.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('bower_components/demo-bower/confession/admin/assets/global/plugins/amcharts/amstockcharts/amstock.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('bower_components/demo-bower/confession/admin/assets/global/plugins/fullcalendar/fullcalendar.min.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('bower_components/demo-bower/confession/admin/assets/global/plugins/horizontal-timeline/horizontal-timeline.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('bower_components/demo-bower/confession/admin/assets/global/plugins/flot/jquery.flot.min.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('bower_components/demo-bower/confession/admin/assets/global/plugins/flot/jquery.flot.resize.min.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('bower_components/demo-bower/confession/admin/assets/global/plugins/flot/jquery.flot.categories.min.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('bower_components/demo-bower/confession/admin/assets/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('bower_components/demo-bower/confession/admin/assets/global/plugins/jquery.sparkline.min.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('bower_components/demo-bower/confession/admin/assets/global/plugins/jqvmap/jqvmap/jquery.vmap.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('bower_components/demo-bower/confession/admin/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('bower_components/demo-bower/confession/admin/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('bower_components/demo-bower/confession/admin/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('bower_components/demo-bower/confession/admin/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('bower_components/demo-bower/confession/admin/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('bower_components/demo-bower/confession/admin/assets/global/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js') }}"
        type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="{{ asset('bower_components/demo-bower/confession/admin/assets/global/scripts/app.min.js') }}"
        type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="{{ asset('bower_components/demo-bower/confession/admin/assets/pages/scripts/dashboard.min.js') }}"
        type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="{{ asset('bower_components/demo-bower/confession/admin/assets/layouts/layout/scripts/layout.min.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('bower_components/demo-bower/confession/admin/assets/layouts/layout/scripts/demo.min.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('bower_components/demo-bower/confession/admin/assets/layouts/global/scripts/quick-sidebar.min.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('bower_components/demo-bower/confession/admin/assets/layouts/global/scripts/quick-nav.min.js') }}"
        type="text/javascript"></script>
<!-- END THEME LAYOUT SCRIPTS -->
{{--<script src="{{ asset('js/admin.js') }}" type="text/javascript"></script>--}}
{{--<script src="{{ asset('js/app.js') }}"></script>--}}
@yield('script')
<script>
    $(document).ready(function () {
        $('#clickmewow').click(function () {
            $('#radio1003').attr('checked', 'checked');
        });
    });
</script>
</body>
</html>
