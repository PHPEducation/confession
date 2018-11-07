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
                <span>{{ trans('message.topic_list_title') }}</span>
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
                        <i class="fa fa-list-ul"></i>{{ trans('message.list_title_topic') }}
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="actions">
                        {{--create--}}
                        <a href="{{ route('topics.create') }}"
                           class="btn blue mt-ladda-btn ladda-button btn-circle">
                            {{ trans('message.btn_create') }} </a>
                    </div>
                    <div class="table-scrollable">
                        {!! Form::open(['route' => 'topics/bulk_update', 'method' => 'POST', 'class' => 'form-inline']) !!}
                        <div id="_token" class="hidden" data-token="{{ csrf_token() }}"></div>
                        <table class="table table-striped table-bordered table-advance table-hover">
                            <thead>
                            <tr>
                                <th>
                                    <i class="fa fa-bookmark-o"> </i> {{ trans('message.topic_name') }}
                                </th>
                                <th>
                                    <i class="fa fa-calendar-check-o"> </i> {{ trans('message.created_at') }}
                                </th>
                                <th>
                                    <i class="fa fa-calendar-check-o"> </i> {{ trans('message.user_at') }}
                                </th>
                                <th>
                                    <i class="fa fa-calendar-check-o"> </i> {{ trans('message.status') }}
                                </th>
                                <th>
                                    <i class="fa fa-calendar-check-o"> </i> {{ trans('message.set_time') }}
                                </th>
                                <th></th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($topics as $topic)
                                <tr>
                                    <td class="highlight">
                                        @if($topic->id % 3 == 0)
                                            <div class="success"></div>
                                        @elseif($topic->id % 3 == 1)
                                            <div class="info"></div>
                                        @elseif($topic->id % 3 == 2)
                                            <div class="warning"></div>
                                        @endif
                                        <a href="#" class="testEdit" data-type="text" data-column="name"
                                           data-url="{{ route('topics/update', ['id' => $topic->id]) }}"
                                           data-pk="{{ $topic->id }}" data-title="change" data-name="name">
                                            {{ $topic->name }}
                                        </a>
                                    </td>
                                    <td>{{ $topic->created_at }}</td>
                                    <td>{{ $topic->users->name }}</td>
                                    <td>
                                        @if ($topic->status == 1)
                                            <label class="btn btn-xs btn-circle green-jungle ladda-label">
                                                {{ trans('message.active') }}
                                            </label>
                                        @else
                                            <label class="btn btn-xs btn-circle grey-mint">
                                                {{ trans('message.deactivate') }}
                                            </label>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($topic->set_time == 1)
                                            <label class="btn btn-xs btn-circle green-sharp">
                                                {{ trans('message.timer') }}
                                            </label>
                                        @else
                                            <label class="btn btn-xs btn-circle yellow-soft">
                                                {{ trans('message.no_timer') }}
                                            </label>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('topics.show', $topic->id) }}"
                                           class="btn btn-outline btn-circle btn-sm green-jungle">
                                            <i class="fa fa-eye"></i> {{ trans('message.btn_show') }} </a>
                                        {!! Form::open(['method' => 'DELETE', 'class' => 'display_form', 'route' => ['topics.destroy', 'id' => $topic->id]]) !!}
                                        {!! Form::button('<i class="fa fa-trash-o"></i> ' . trans('message.btn_delete'), ['class' => 'btn btn-outline btn-circle btn-sm red-thunderbird', 'type' => 'submit']) !!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
            <!-- END SAMPLE TABLE PORTLET-->
        </div>
    </div>
@endsection

@section('script')
    <link href="{{ asset('bower_components/demo-bower/confession/admin/assets/global/plugins/bootstrap-editable/bootstrap-editable/css/bootstrap-editable.css') }}"
          rel="stylesheet" type="text/css"/>
    <script src="{{ asset('bower_components/demo-bower/confession/admin/assets/global/plugins/bootstrap-editable/bootstrap-editable/js/bootstrap-editable.js') }}"
            type="text/javascript"></script>

    <script>
        // $.fn.editable.defaults.mode = 'inline';
        $(document).ready(function () {
            $('.testEdit').editable({
                params: function (params) {
                    // add additional params from data-attributes of trigger element
                    params._token = $('#_token').data('token');
                    params.name = $(this).editable().data('name');

                    return params;
                },
                error: function (response, newValue) {
                    if (response.status === 500) {

                        return trans('message.server_error');
                    } else {

                        return response.responseText;
                    }
                }
            });
        });
    </script>
@endsection
