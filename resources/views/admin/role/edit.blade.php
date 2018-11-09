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
                <a href="{{ route('roles.index') }}">{{ trans('message.list_roles') }}</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>{{ trans('message.edit_role') }}</span>
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
                        <i class="fa fa-list-ul"></i>{{ trans('message.edit_role') }}
                    </div>
                </div>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-8">
                {!! Form::model($role, ['method' => 'PUT', 'route' => ['roles/updateAll', $role->id], 'class' => 'form-horizontal']) !!}
                <div class="form-body">
                    {{--name--}}
                    <div class="form-group form-md-line-input {{ $errors->has('name') ? 'has-error' : '' }}">
                        <label class="col-md-3 control-label"
                               for="form_control_1">{{ trans('message.role_name') }} <span
                                    class="required"> * </span></label>
                        <div class="col-md-9">
                            {!! Form::text('name', old('name'), ['id' => 'name_role', 'class' => 'form-control']) !!}
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                            <div class="form-control-focus"></div>
                            <span class="help-block">{{ trans('message.hint_topic_name') }}</span>
                        </div>
                    </div>

                    {{--display_name--}}
                    <div class="form-group form-md-line-input">
                        <label class="col-md-3 control-label"
                               for="form_control_1">{{ trans('message.role_display_name') }}</label>
                        <div class="col-md-9">
                            {!! Form::text('display_name', old('display_name'), ['id' => 'display_name', 'class' => 'form-control']) !!}
                            <div class="form-control-focus"></div>
                            <span class="help-block">{{ trans('message.hint_topic_name') }}</span>
                        </div>
                    </div>

                    {{--description_name--}}
                    <div class="form-group form-md-line-input">
                        <label class="col-md-3 control-label"
                               for="form_control_1">{{ trans('message.role_desc') }}</label>
                        <div class="col-md-9">
                            {!! Form::text('description', old('description'), ['id' => 'description', 'class' => 'form-control']) !!}
                            <div class="form-control-focus"></div>
                            <span class="help-block">{{ trans('message.hint_topic_name') }}</span>
                        </div>
                    </div>

                    {{--permission--}}
                    <div class="form-group form-md-line-input">
                        <label class="col-md-3 control-label"
                               for="form_control_1">{{ trans('message.role_permission') }}</label>
                        <div class="col-md-9">
                            {{--Input Permission--}}
                            {{--@foreach($permissions as $permission)--}}
                            {{--chon nhung truong hop da chon,true: ứng với checked của thẻ input, false: ngược lại--}}
                            {{--{{ Form::checkbox('permission[]', $permission->id, in_array($permission->id, $rolePermissions) ? true : false) }} {{ $permission->display_name }} <br>--}}
                            {{--@endforeach--}}
                            {{ Form::select('permission[]', $permissions, $rolePermissions, ['multiple' => true, 'id' => 'my-select']) }}
                            <div class="form-control-focus"></div>
                            <span class="help-block">{{ trans('message.hint_topic_name') }}</span>
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-3 col-md-9">
                            {!! Form::submit(trans('message.btn_submit'), ['class' => 'btn green']) !!}
                            <a href="{{ route('roles.index') }}"
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
    <link href="{{ asset('bower_components/demo-bower/confession/admin/assets/global/plugins/bootstrap-select/css/bootstrap-select.css') }}"
          rel="stylesheet" type="text/css"/>
    <link href="{{ asset('bower_components/demo-bower/confession/admin/assets/global/plugins/jquery-multi-select/css/multi-select.css') }}"
          rel="stylesheet" type="text/css"/>
    <script src="{{ asset('bower_components/demo-bower/confession/admin/assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('bower_components/demo-bower/confession/admin/assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('bower_components/demo-bower/confession/admin/assets/global/plugins/select2/js/select2.full.min.js') }}"
            type="text/javascript"></script>
    <script>
        $('#my-select').multiSelect();
    </script>
@endsection
