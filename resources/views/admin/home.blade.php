@extends('admin.index')
@section('content')
    <!-- BEGIN PAGE BAR -->
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{ route('dashboard.index') }}">{{ trans('message.home') }}</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>{{ trans('message.home') }}</span>
            </li>
        </ul>
    </div>
    <!-- END PAGE BAR -->
    <!-- BEGIN PAGE TITLE-->
    <h1 class="page-title">
        {{ trans('message.framgia_cfs') }}
    </h1>
    <!-- END PAGE TITLE-->
@endsection
