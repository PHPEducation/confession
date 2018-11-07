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
                <span>{{ trans('message.topic_create_title') }}</span>
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

            <div class="portlet">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-list-ul"></i>{{ trans('message.create_title') }}
                    </div>
                </div>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-8">
                {{--<form action="#" class="form-horizontal">--}}
                {!! Form::open(['method' => 'POST', 'route' => ['topics.store'], 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}
                <div class="form-body">
                    {{--name--}}
                    <div class="form-group form-md-line-input {{ $errors->has('name') ? 'has-error' : '' }}">
                        <label class="col-md-3 control-label"
                               for="form_control_1">{{ trans('message.label_topic_name') }} <span
                                    class="required"> * </span></label>
                        <div class="col-md-9">
                            {{--<input type="text" class="form-control input_slug" placeholder="" name="name_topic">--}}
                            {!! Form::text('name', old('name_topic'), ['id' => 'title', 'class' => 'form-control', 'onkeyup' => 'ChangeToSlug()']) !!}
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                            <div class="form-control-focus"></div>
                            <span class="help-block">{{ trans('message.hint_topic_name') }}</span>
                        </div>
                    </div>
                    {{--slug--}}
                    <div class="form-group form-md-line-input {{ $errors->has('slug') ? 'has-error' : '' }}">
                        <label class="col-md-3 control-label"
                               for="form_control_1">{{ trans('message.label_slug') }} <span class="required"> * </span></label>
                        <div class="col-md-9">
                            {!! Form::text('slug', old('slug_topic'), ['id' => 'slug', 'class' => 'form-control ']) !!}
                            <span class="text-danger">{{ $errors->first('slug') }}</span>
                            <div class="form-control-focus"></div>
                            <span class="help-block">{{ trans('message.hint_topic_name') }}</span>
                        </div>
                    </div>

                    {{--image--}}
                    <div class="form-group form-md-line-input {{ $errors->has('image_topic') ? 'has-error' : '' }}">
                        <label class="col-md-3 control-label"
                               for="form_control_1">{{ trans('message.label_image') }}</label>
                        <div class="col-md-9">
                            <!-- Upload  -->
                            <div id="file-upload-form" class="uploader">
                                {!! Form::file('image_topic', ['id' => 'file-upload', 'accept' => 'image/*', 'enctype' => 'multipart/form-data']) !!}
                                <span class="text-danger">{{ $errors->first('image_topic') }}</span>
                                <label for="file-upload" id="file-drag">
                                    {{ Html::image('', '', ['id' => 'file-image', 'class' => 'hidden']) }}
                                    {{ Form::text('images', '', ['id' => 'file-image-input', 'class' => 'hidden']) }}
                                    <div id="start">
                                        <i class="fa fa-download" aria-hidden="true"></i>
                                        <div>{{ trans('message.select_a_file') }}</div>
                                        <div id="notimage" class="hidden">{{ trans('message.please_image') }}</div>
                                        <span id="file-upload-btn"
                                              class="btn btn-primary fix_text_file">{{ trans('message.select_file') }}</span>
                                    </div>

                                    <div id="response" class="hidden">
                                        <div id="messages"></div>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>

                    {{--status--}}
                    <div class="form-group form-md-line-input {{ $errors->has('status') ? 'has-error' : '' }}">
                        <label class="col-md-3 control-label"
                               for="form_control_1">{{ trans('message.label_status') }}</label>
                        <div class="col-md-9">
                            <div class="radio">
                                <label class="mt-radio mt-radio-outline padding-left">
                                    {{ Form::radio('status', '1', true, ['id' => 'radClickChecked']) }}
                                    {{ trans('message.active') }}
                                    <span></span>
                                </label>
                            </div>
                            <div class="radio">
                                <label class="mt-radio mt-radio-outline padding-left">
                                    {{ Form::radio('status', '0', false, ['id' => 'radClickChecked']) }}
                                    {{ trans('message.deactivate') }}
                                    <span></span>
                                </label>
                            </div>
                        </div>
                    </div>

                    {{--set_time--}}
                    <div class="form-group form-md-line-input {{ $errors->has('set_time') ? 'has-error' : '' }}">
                        <label class="col-md-3 control-label"
                               for="form_control_1">{{ trans('message.label_set_time') }}</label>
                        <div class="col-md-9">
                            <div class="radio">
                                <label class="mt-radio mt-radio-outline padding-left">
                                    {{ Form::radio('set_time', '1', true, ['id' => 'radClickChecked', 'onclick' => 'select_time_cacular()']) }}
                                    {{ trans('message.timer') }}
                                    <span></span>
                                </label>
                            </div>
                            <div class="radio">
                                <label class="mt-radio mt-radio-outline padding-left">
                                    {{ Form::radio('set_time', '0', false, ['id' => 'radClickChecked', 'onclick' => 'hidden_select_time()']) }}
                                    {{ trans('message.no_timer') }}
                                    <span></span>
                                </label>
                            </div>
                        </div>
                    </div>

                    {{--select time scheduling--}}
                    <div id="show_select_time_cacular"
                         class="form-group form-md-line-input {{ $errors->has('select_time') ? 'has-error' : '' }}">
                        <label class="col-md-3 control-label"
                               for="form_control_1">{{ trans('message.label_select_time') }}</label>
                        <div class="col-md-9">
                            <div class="input-group">
                                {!! Form::text('select_time', old('select_time'), ['id' => 'time', 'class' => 'form-control timepicker timepicker-24']) !!}
                                <span class="input-group-btn">
                                    <button class="btn default" type="button">
                                        <i class="fa fa-clock-o"></i>
                                    </button>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-actions">
                <div class="row">
                    <div class="col-md-offset-3 col-md-9">
                        {!! Form::submit(trans('message.btn_submit'), ['class' => 'btn green']) !!}
                        <a href="{{ route('topics.index') }}"
                           class="btn default">{{ trans('message.btn_cancel') }}</a>
                    </div>
                </div>
            </div>
            {{--</form>--}}
            {!! Form::close() !!}
        </div>
    </div>
    </div>
@endsection
@section('script')
    <link href="{{ asset('bower_components/demo-bower/confession/admin/assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}"
          rel="stylesheet" type="text/css"/>
    <script src="{{ asset('js/upload_file.js') }}" type="text/javascript"></script>
    <script src="{{ asset('bower_components/demo-bower/confession/admin/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('bower_components/demo-bower/confession/admin/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('bower_components/demo-bower/confession/admin/assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('bower_components/demo-bower/confession/admin/assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('bower_components/demo-bower/confession/admin/assets/pages/scripts/components-date-time-pickers.min.js') }}"
            type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#time').timepicker();
        });

        function hidden_select_time() {
            document.getElementById('show_select_time_cacular').style.display = 'none';
        }

        function select_time_cacular() {
            document.getElementById('show_select_time_cacular').style.display = 'block';
        }
    </script>
@endsection
