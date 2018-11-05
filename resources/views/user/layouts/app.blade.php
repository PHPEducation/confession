<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>F_Confession</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('images/icon.png') }}">
    <!-- page css -->
    @yield('style')
    <!-- core css -->
    <link href="{{ asset('bower_components/demo-bower/confession/user/fonts/material-icon/css/material-design-iconic-font.min.css') }}" rel="stylesheet">
    <link href="{{ asset('bower_components/demo-bower/confession/user/css/style.css') }}" rel="stylesheet">

</head>

<body>
    @yield('content')

    <script src="{{ asset('bower_components/demo-bower/confession/user/js/login/jquery.min.js') }}"></script>

    <script src="{{ asset('bower_components/demo-bower/confession/user/js/login/main.js') }}"></script>

    <!-- page js -->
    @yield('script')

</body>

</html>
