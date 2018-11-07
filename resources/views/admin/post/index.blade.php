@extends('admin.index')
@section('content')
    <div class="theme-panel hidden-xs hidden-sm">
    </div>
    <!-- END THEME PANEL -->
    <!-- BEGIN PAGE BAR -->
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{ route('dashboard.index') }}">{{ trans('message.home') }}</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>{{ trans('message.post_list_title') }}</span>
            </li>
        </ul>
    </div>
    <!-- END PAGE BAR -->
    <!-- END PAGE HEADER-->
    <div class="row">
        <div class="col-md-12">
            {{--alert success--}}
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
        @endif
        <!-- BEGIN SAMPLE TABLE PORTLET-->
            <div class="portlet">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-list-ul"></i>{{ trans('message.list_title_post') }}
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-scrollable">
                        <table class="table table-striped table-bordered table-advance table-hover">
                            <thead>
                            <tr>
                                <th>
                                    <i class="fa fa-bookmark-o"> </i> {{ trans('message.post_title') }}
                                </th>
                                <th>
                                    <i class="fa fa-share-square-o"> </i> {{ trans('message.post_topic') }}
                                </th>
                                <th>
                                    <i class="fa fa-user"> </i> {{ trans('message.post_user') }}
                                </th>
                                <th>
                                    <i class="fa fa-calendar-check-o"> </i> {{ trans('message.created_at') }}
                                </th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($posts as $post)
                                {{--{{ $count = 0 }}--}}
                                {{--xu li report bi report 5 lan --}}
                                {{--@foreach($reports as $report)--}}
                                {{--@if ($report->post_id == $post->id)--}}
                                {{--count++;--}}
                                {{--@endif--}}
                                {{--@endforeach--}}

                                {{--check tất cả dữ liệu bảng report để đếm số lượng report của 1 post.--}}
                                {{--if dưới 5 thì như bình thường, còn ngược lại > =5 thì sẽ bôi đỏ dòng đó để cho admin biết bài bị report quá--}}
                                {{--và tiến hành xử lý: xóa hoặc vẫn để bài post đó lại--}}
                                {{--@if ($count < 5)--}}
                                <tr>
                                    <td class="highlight">
                                        @if($post->id % 3 == 0)
                                            <div class="success"></div>
                                        @elseif($post->id % 3 == 1)
                                            <div class="info"></div>
                                        @elseif($post->id % 3 == 2)
                                            <div class="warning"></div>
                                        @endif
                                        <a href="javascript:;">{{ $post->title }}</a>
                                    </td>
                                    <td>{{ $post->topic->name }}</td>
                                    <td>
                                        @if ($post->type == 1)
                                            {{ $post->users->name }}
                                        @elseif ($post->type == 0)
                                            {{ trans('message.anonymous') }}
                                        @endif
                                    </td>
                                    <td>{{ $post->created_at }}</td>
                                    <td>
                                        <a href="{{ route('postShowAdmin', $post->id) }}"
                                           class="btn btn-outline btn-circle btn-sm green-jungle">
                                            <i class="fa fa-eye"></i> {{ trans('message.btn_show') }} </a>
                                        {!! Form::open(['method' => 'DELETE', 'class' => 'display_form', 'route' => ['postDelAdmin', 'id' => $post->id]]) !!}
                                        {!! Form::button('<i0 class="fa fa-trash-o"></i> ' . trans('message.btn_delete'), ['class' => 'btn btn-outline btn-circle btn-sm red-thunderbird', 'type' => 'submit']) !!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- END SAMPLE TABLE PORTLET-->
        </div>
    </div>
@endsection
