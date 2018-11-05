<!-- BEGIN HEADER -->
<div class="page-header navbar navbar-fixed-top">
    <!-- BEGIN HEADER INNER -->
    <div class="page-header-inner ">
        <!-- BEGIN LOGO -->
        <div class="page-logo">
            <a href="#">
                <img src="{{ asset(config('common.img') . 'logo.png') }}" alt="logo" class="resize_logo_img"/>
            </a>
            <div class="menu-toggler sidebar-toggler">
                <span></span>
            </div>
        </div>
        <!-- END LOGO -->

        <!-- BEGIN RESPONSIVE MENU TOGGLER -->
        <a href="javascript:" class="menu-toggler responsive-toggler" data-toggle="collapse"
           data-target=".navbar-collapse">
            <span></span>
        </a>
        <!-- END RESPONSIVE MENU TOGGLER -->

        <!-- BEGIN TOP NAVIGATION MENU -->
        <div class="top-menu">
            <ul class="nav navbar-nav pull-right">
                {{--language--}}
                <li class="dropdown dropdown-user">
                    <a href="javascript:" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
                       data-close-others="true">
                        <span class="username username-hide-on-mobile">{{ trans('message.language') }}</span>
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-default">
                        <li>
                            <a href="{!! route('change_lang', ['en']) !!}">
                                <i class="icon-user"></i>{{ trans('message.en') }}
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="{!! route('change_lang', ['vi']) !!}">
                                <i class="icon-key"></i>{{ trans('message.vi') }}
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- BEGIN USER LOGIN DROPDOWN -->
                <li class="dropdown dropdown-user">
                    <a href="javascript:" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
                       data-close-others="true">
                        @if(Auth::check())
                            <img alt="" class="img-circle" src="{{ asset(config('common.img').'avatar3_small.jpg') }}"/>
                            <span class="username username-hide-on-mobile"> {{ Auth::user()->name }} </span>
                            <i class="fa fa-angle-down"></i>
                        @endif
                    </a>
                    <ul class="dropdown-menu dropdown-menu-default">
                        <li>
                            <a href="#">
                                <i class="icon-user"></i>{{ trans('message.profile') }}
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="{{ route('logout') }}">
                                <i class="icon-key"></i>{{ trans('message.logout') }}
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- END USER LOGIN DROPDOWN -->
            </ul>
        </div>
        <!-- END TOP NAVIGATION MENU -->
    </div>
    <!-- END HEADER INNER -->
</div>
<!-- END HEADER -->
