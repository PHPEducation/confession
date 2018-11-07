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
                <a href="{{ route('topics.index') }}">{{ trans('message.topic_list_title') }}</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>{{ trans('message.show_topic_title') }}</span>
            </li>
        </ul>
    </div>
    <!-- END PAGE BAR -->
    <!-- END PAGE HEADER-->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN SAMPLE TABLE PORTLET-->
            <div class="portlet">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-list-ul"></i>{{ trans('message.show_topic_title') }}
                    </div>
                    <div class="actions">
                        {{--edit--}}
                        <a href="{{ route('topics.edit', $topic->id) }}"
                           class="btn purple mt-ladda-btn ladda-button btn-circle btn-outline">
                            <i class="glyphicon glyphicon-edit"></i> {{ trans('message.btn_edit') }} </a>

                        {{--delete--}}
                        {!! Form::open(['method' => 'DELETE', 'class' => 'display_form', 'route' => ['topics.destroy', 'id' => $topic->id]]) !!}
                        {!! Form::button('<i class="fa fa-trash-o"></i> ' . trans('message.btn_delete'), ['class' => 'btn btn-outline btn-circle btn-sm red-thunderbird', 'type' => 'submit']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                    @php
                        $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . '://$_SERVER[HTTP_HOST]';
                      //result: http://127.0.0.1:8000
                    @endphp
                    <!-- BEGIN SAMPLE TABLE PORTLET-->
                        <div class="portlet box green">
                            <div class="portlet-title">
                                <div class="caption">
                                    {{ trans('message.title_detail') }}
                                </div>
                                <div class="tools">
                                    <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="table-scrollable">
                                    <table class="table table-bordered table-hover">
                                        <tr>
                                            <th>{{ trans('message.topic_name') }}</th>
                                            <td>{{ $topic->name }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ trans('message.slug') }}</th>
                                            <td>{{ $topic->slug }}</td>
                                        </tr>
                                        @if($topic->images != null)
                                            <tr>
                                                <th>{{ trans('message.topic_images') }}</th>
                                                <td>
                                                    <img class="fix_size_image"
                                                         src="{{ url(config('common.topics') . $topic->images) }}"/>
                                                </td>
                                            </tr>
                                        @endif
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- END SAMPLE TABLE PORTLET-->
                    </div>
                    <div class="col-md-4">
                        <!-- BEGIN CONDENSED TABLE PORTLET-->
                        <div class="portlet box red">
                            <div class="portlet-title">
                                <div class="caption">
                                    {{ trans('message.title_general') }}
                                </div>
                                <div class="tools">
                                    <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="table-scrollable">
                                    <table class="table table-bordered table-hover">
                                        <tr>
                                            <th>{{ trans('message.topic_id') }}</th>
                                            <td>{{ $topic->id }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ trans('message.topic_user') }}</th>
                                            <td>{{ $topic->users->name }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ trans('message.created_at') }}</th>
                                            <td>{{ $topic->created_at }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ trans('message.updated_at') }}</th>
                                            <td>{{ $topic->updated_at }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ trans('message.status') }}</th>
                                            <td>
                                                @if ($topic->status == 1)
                                                    <label class="btn btn-xs btn-circle green-jungle">
                                                        {{ trans('message.active') }}
                                                    </label>
                                                @else
                                                    <label class="btn btn-xs btn-circle grey-mint">
                                                        {{ trans('message.deactivate') }}
                                                    </label>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>{{ trans('message.set_time') }}</th>
                                            <td>
                                                @if ($topic->set_time == 1)
                                                    <label class="btn btn-xs btn-circle blue-madison">
                                                        {{ trans('message.timer') }}
                                                    </label>
                                                @else
                                                    <label class="btn btn-xs btn-circle grey-salt">
                                                        {{ trans('message.no_timer') }}
                                                    </label>
                                                @endif
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- END CONDENSED TABLE PORTLET-->
                    </div>
                </div>
            </div>
            <!-- END SAMPLE TABLE PORTLET-->
        </div>
    </div>
@endsection
