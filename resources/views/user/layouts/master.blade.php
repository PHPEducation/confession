<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>F_Confession</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset(config('common.img') . 'icon.png') }}">

    <!-- core dependcies css -->
    <link rel="stylesheet" href="{{ asset('bower_components/demo-bower/confession/user/css/bootstrap.css') }}"/>
    <link rel="stylesheet"
          href="{{ asset('bower_components/demo-bower/confession/user/css/pace-theme-minimal.css') }}"/>
    <link rel="stylesheet"
          href="{{ asset('bower_components/demo-bower/confession/user/css/perfect-scrollbar.min.css') }}"/>

    <!-- page css -->
    @yield('style')
    <!-- core css -->
    <link href="{{ asset('bower_components/demo-bower/confession/user/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('bower_components/demo-bower/confession/user/css/themify-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('bower_components/demo-bower/confession/user/css/materialdesignicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('bower_components/demo-bower/confession/user/css/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('bower_components/demo-bower/confession/user/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
<div class="app header-success-gradient">
    <div class="layout">
        <!-- Header START -->
        <div class="header navbar">
            <div class="header-container">
                <div class="nav-logo">
                    <a href="{{ route('cfs') }}">
                        {{ Html::image(asset(config('common.img') . 'framgia3.png'), 'F-Confession' ) }}
                    </a>
                </div>
                <ul class="nav-right">
                    <li class="notifications dropdown dropdown-animated scale-left">
                        <span class="counter">2</span>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="mdi mdi-bell-ring-outline"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-lg p-v-0">
                            <li class="p-v-15 p-h-20 border bottom text-dark">
                                <h5 class="m-b-0">
                                    <i class="mdi mdi-bell-ring-outline p-r-10"></i>
                                    <span>{{ __('message.notifications') }}</span>
                                </h5>
                            </li>
                            <li>
                                <ul class="list-media overflow-y-auto relative scrollable">
                                    <li class="list-item border bottom">
                                        <a href="javascript:void(0);" class="media-hover p-15">
                                            <div class="media-img">
                                                <div class="icon-avatar bg-success">
                                                    <i class="ti-user"></i>
                                                </div>
                                            </div>
                                            <div class="info">
                                                    <span class="title">
                                                        {{ __('message.new_notifications') }}
                                                    </span>
                                                <span class="sub-title">12 min ago</span>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="p-v-15 p-h-20 text-center">
                                    <span>
                                        <a href="#" class="text-gray">{{ __('message.all') }}<i class="ei-right-chevron p-l-5 font-size-10"></i></a>
                                    </span>
                            </li>
                        </ul>
                    </li>
                    <li class="user-profile dropdown dropdown-animated scale-left">
                        @if (Auth::check())
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                @if (Auth::user()->images == null)
                                    {{ Html::image(asset(config('common.img') . 'avatar-5.png'), Auth::user()->name, ['class' => 'profile-img img-fluid']) }}
                                @else
                                    {{ Html::image(Auth::user()->images, Auth::user()->name, ['class' => 'profile-img img-fluid']) }}
                                @endif
                            </a>
                            <ul class="dropdown-menu dropdown-md p-v-0">
                                <li>
                                    <ul class="list-media">
                                        <li class="list-item p-15">
                                            <div class="media-img">
                                                @if (Auth::user()->images == null)
                                                    {{ Html::image(asset(config('common.img') . 'avatar-5.png'), Auth::user()->name, ['class' => 'profile-img img-fluid']) }}
                                                @else
                                                    {{ Html::image(Auth::user()->images, Auth::user()->name, ['class' => 'profile-img img-fluid']) }}
                                                @endif
                                            </div>
                                            <div class="info">
                                                <span class="title text-semibold">{{ Auth::user()->name }}</span>
                                                <span class="sub-title"><span>@</span>{{ Auth::user()->nick_name }}</span>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li role="separator" class="divider"></li>
                                <li>
                                    <a href="">
                                        <i class="ti-user p-r-10"></i>
                                        <span>{{ __('message.profile') }}</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('user.logout') }}">
                                        <i class="ti-power-off p-r-10"></i>
                                        <span>{{ __('message.logout') }}</span>
                                    </a>
                                </li>
                            </ul>
                        @else
                            <a href="{{ route('user.login_form') }}">{{ __('message.login') }}</a>
                        @endif
                    </li>
                </ul>
            </div>
        </div>
        <!-- Header END -->

        <!-- Page Container START -->
        <div class="page-container">

        @yield('content')

        <!-- Footer START -->
            <footer class="content-footer">
                <div class="footer">
                    <div class="text-center copyright">
                        <span>Copyright © 2018 <b class="text-dark">F_Confession</b>. All rights reserved.</span>
                    </div>
                </div>
            </footer>
            <!-- Footer END -->

        </div>
        <!-- Page Container END -->

    </div>
</div>

<script src="{{ asset('bower_components/demo-bower/confession/user/js/vendor.js') }}"></script>

<script src="{{ asset('bower_components/demo-bower/confession/user/js/app.min.js') }}"></script>

<!-- page js -->

@yield('script')

</body>

</html>
