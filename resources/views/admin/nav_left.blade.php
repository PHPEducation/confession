<!-- BEGIN SIDEBAR -->
<div class="page-sidebar navbar-collapse collapse">
    <!-- BEGIN SIDEBAR MENU -->
    <ul class="page-sidebar-menu  page-header-fixed padding-top-ul" data-keep-expanded="false"
        data-auto-scroll="true"
        data-slide-speed="200">
        <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
        <li class="sidebar-toggler-wrapper hide">
            <div class="sidebar-toggler">
                <span></span>
            </div>
        </li>
        <!-- END SIDEBAR TOGGLER BUTTON -->
        <li class="sidebar-search-wrapper">
            <!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
            <form class="sidebar-search" action="#" method="POST">
                <a href="javascript:" class="remove">
                    <i class="icon-close"></i>
                </a>
                <div class="input-group">
                    {{ Form::text('search', ['class' => 'form-control']) }}
                    <span class="input-group-btn">
                        <a href="javascript:" class="btn submit">
                            <i class="icon-magnifier"></i>
                        </a>
                    </span>
                </div>
            </form>
            <!-- END RESPONSIVE QUICK SEARCH FORM -->
        </li>
        <li class="nav-item start active open">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="icon-home"></i>
                <span class="title">{{ trans('message.home') }}</span>
                <span class="selected"></span>
                <span class="arrow open"></span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item start active open">
                    <a href="{{ route('dashboard.index') }}" class="nav-link ">
                        <i class="icon-bar-chart"></i>
                        <span class="title">{{ trans('message.home') }}</span>
                        <span class="selected"></span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="heading">
            <h3 class="uppercase">{{ trans('message.manages') }}</h3>
        </li>

        {{--topic--}}
        <li class="nav-item  ">
            <a href="javascript:" class="nav-link nav-toggle">
                <i class="icon-diamond"></i>
                <span class="title">{{ trans('message.title_topic') }}</span>
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item  ">
                    <a href="{{ route('topics.index') }}" class="nav-link ">
                        <span class="title">{{ trans('message.title_list_topic') }}</span>
                    </a>
                </li>
                <li class="nav-item  ">
                    <a href="{{ route('topics.create') }}" class="nav-link ">
                        <span class="title">{{ trans('message.title_create_topic') }}</span>
                    </a>
                </li>
            </ul>
        </li>

        {{--confession--}}
        <li class="nav-item  ">
            <a href="javascript:" class="nav-link nav-toggle">
                <i class="icon-diamond"></i>
                <span class="title">{{ trans('message.title_confession') }}</span>
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item  ">
                    <a href="{{ route('confessions.index') }}" class="nav-link ">
                        <span class="title">{{ trans('message.title_list_confession') }}</span>
                    </a>
                </li>
            </ul>
        </li>

        {{--post--}}
        <li class="nav-item  ">
            <a href="javascript:" class="nav-link nav-toggle">
                <i class="icon-diamond"></i>
                <span class="title">{{ trans('message.title_post') }}</span>
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item  ">
                    <a href="{{ route('posts.index') }}" class="nav-link ">
                        <span class="title">{{ trans('message.title_list_post') }}</span>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
    <!-- END SIDEBAR MENU -->
</div>
<!-- END SIDEBAR -->
