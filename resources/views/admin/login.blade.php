<!DOCTYPE html>
<!--[if IE 8]>
<html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]>
<html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8"/>
    <title>{{ trans('message.login_admin_title') }}</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset(config('common.img') . 'icon.png') }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <meta content="" name="author"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="{{ asset('bower_components/demo-bower/confession/admin/fonts/fonts.woff2') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('bower_components/demo-bower/confession/admin/assets/global/plugins/font-awesome/css/font-awesome.min.css') }}"
          rel="stylesheet" type="text/css"/>
    <link href="{{ asset('bower_components/demo-bower/confession/admin/assets/global/plugins/simple-line-icons/simple-line-icons.min.css') }}"
          rel="stylesheet" type="text/css"/>
    <link href="{{ asset('bower_components/demo-bower/confession/admin/assets/global/plugins/bootstrap/css/bootstrap.min.css') }}"
          rel="stylesheet" type="text/css"/>
    <link href="{{ asset('bower_components/demo-bower/confession/admin/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css') }}"
          rel="stylesheet" type="text/css"/>
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="{{ asset('bower_components/demo-bower/confession/admin/assets/global/plugins/select2/css/select2.min.css') }}"
          rel="stylesheet" type="text/css"/>
    <link href="{{ asset('bower_components/demo-bower/confession/admin/assets/global/plugins/select2/css/select2-bootstrap.min.css') }}"
          rel="stylesheet" type="text/css"/>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="{{ asset('bower_components/demo-bower/confession/admin/assets/global/css/components.min.css') }}"
          rel="stylesheet" id="style_components" type="text/css"/>
    <link href="{{ asset('bower_components/demo-bower/confession/admin/assets/global/css/plugins.min.css') }}"
          rel="stylesheet" type="text/css"/>
    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link href="{{ asset('bower_components/demo-bower/confession/admin/assets/pages/css/login-3.min.css') }}"
          rel="stylesheet" type="text/css"/>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css"/>
    <!-- END PAGE LEVEL STYLES -->
    <!-- END HEAD -->

<body class=" login">
<!-- BEGIN LOGO -->
<div class="logo">
    <a href="#">
        <img src="{{ asset(config('common.img') . 'logo.png') }}" alt=""/> </a>
</div>
<!-- END LOGO -->
<!-- BEGIN LOGIN -->
<div class="content">
    @if (Session::has('danger'))
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert"
                    aria-hidden="true">{{ trans('message.btn_x') }}</button>
            <strong>{{ trans('message.title_danger') }}</strong> {{ Session::get('danger') }}
        </div>
    @endif
    <div class="clearfix"></div>
    <!-- BEGIN LOGIN FORM -->
    {!! Form::open(['method' => 'POST', 'route' => ['loginAdmin'], 'class' => 'login-form']) !!}
    <h3 class="form-title">{{ trans('message.title_form_login') }}</h3>
    <div class="alert alert-danger display-hide">
        <button class="close" data-close="alert"></button>
        <span> {{ trans('message.alert_null_email_password') }} </span>
    </div>
    <div class="form-group">
        <label class="control-label visible-ie8 visible-ie9">{{ trans('message.label_email') }}</label>
        <div class="input-icon">
            <i class="fa fa-user"></i>
            {{ Form::text('email', old('email'), ['class' => 'form-control placeholder-no-fix margin_bottom', 'autocomplete' => 'off', 'placeholder' => trans('message.label_email')]) }}
        </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">{{ trans('message.label_password') }}</label>
            <div class="input-icon">
                <i class="fa fa-lock"></i>
                {{ Form::password('password', ['class' => 'form-control placeholder-no-fix margin_bottom', 'autocomplete' => 'off', 'placeholder' => trans('message.label_password')]) }}
            </div>
            <div class="form-actions">
                <label class="rememberme mt-checkbox mt-checkbox-outline">
                    <input type="checkbox" name="remember" value="1"/> {{ trans('message.remember_me') }}
                    <span></span>
                </label>
                {!! Form::submit(trans('message.btn_login'), ['class' => 'btn green pull-right']) !!}
            </div>
            {!! Form::close() !!}
        </div>
        <!-- END LOGIN -->
        <!-- BEGIN COPYRIGHT -->
        <div class="copyright">{{ trans('message.copyright') }}</div>
        <!-- END COPYRIGHT -->
        <!-- BEGIN CORE PLUGINS -->
        <script src="{{ asset('bower_components/demo-bower/confession/admin/assets/global/plugins/jquery.min.js') }}"
                type="text/javascript"></script>
        <script src="{{ asset('bower_components/demo-bower/confession/admin/assets/global/plugins/bootstrap/js/bootstrap.min.js') }}"
                type="text/javascript"></script>
        <script src="{{ asset('bower_components/demo-bower/confession/admin/assets/global/plugins/js.cookie.min.js') }}"
                type="text/javascript"></script>
        <script src="{{ asset('bower_components/demo-bower/confession/admin/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}"
                type="text/javascript"></script>
        <script src="{{ asset('bower_components/demo-bower/confession/admin/assets/global/plugins/jquery.blockui.min.js') }}"
                type="text/javascript"></script>
        <script src="{{ asset('bower_components/demo-bower/confession/admin/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"
                type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="{{ asset('bower_components/demo-bower/confession/admin/assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}"
                type="text/javascript"></script>
        <script src="{{ asset('bower_components/demo-bower/confession/admin/assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}"
                type="text/javascript"></script>
        <script src="{{ asset('bower_components/demo-bower/confession/admin/assets/global/plugins/select2/js/select2.full.min.js') }}"
                type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="{{ asset('bower_components/demo-bower/confession/admin/assets/global/scripts/app.min.js') }}"
                type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="{{ asset('bower_components/demo-bower/confession/admin/assets/pages/scripts/login.min.js') }}"
                type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <!-- END THEME LAYOUT SCRIPTS -->
        <script>
            $(document).ready(function () {
                $('#clickmewow').click(function () {
                    $('#radio1003').attr('checked', 'checked');
                });
            })
        </script>
    </div>
</div>
</body>
</html>
