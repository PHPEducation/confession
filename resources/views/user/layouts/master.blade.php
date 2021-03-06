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
    <link href="{{ asset('bower_components/demo-bower/confession/user/css/materialdesignicons.min.css') }}"
          rel="stylesheet">
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
                    <li class="notifications dropdown dropdown-animated scale-left dropdown-notifications">
                        <span class="counter">0</span>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i data-count="0" class="mdi mdi-bell-ring-outline"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-lg p-v-0 notification">
                            @if (Auth::check())
                                {!! Form::hidden('user_id', Auth::user()->id, ['id' => 'auth_id']) !!}
                            @endif
                            <li class="p-v-15 p-h-20 text-center">
                                    <span>
                                        <a href="#" class="text-gray">{{ __('message.all') }}<i
                                                    class="ei-right-chevron p-l-5 font-size-10"></i></a>
                                    </span>
                            </li>
                        </ul>
                    </li>
                    <li class="user-profile dropdown dropdown-animated scale-left">
                        @if (Auth::check())
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                @if (Auth::user()->images == null)
                                    {{ Html::image(asset(config('common.img') . 'thumb-3.jpg'), Auth::user()->name, ['class' => 'profile-img img-fluid']) }}
                                @else
                                    {{ Html::image(asset(config('common.image_paths.user') . Auth::user()->images), Auth::user()->name, ['class' => 'profile-img img-fluid']) }}
                                @endif
                            </a>
                            <ul class="dropdown-menu dropdown-md p-v-0">
                                <li>
                                    <ul class="list-media">
                                        <li class="list-item p-15">
                                            <div class="media-img">
                                                @if (Auth::user()->images == null)
                                                    {{ Html::image(asset(config('common.img') . 'thumb-3.jpg'), '') }}
                                                @else
                                                    {{ Html::image(asset(config('common.image_paths.user') . Auth::user()->images), '') }}
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
                                    <a href="{{ route('profiles.index') }}">
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

<script src="{{ asset('bower_components/demo-bower/confession/user/js/pusher.min.js') }}"></script>

<!-- page js -->

@yield('script')

</body>

</html>
