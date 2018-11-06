@extends ('user.layouts.app')

@section ('style')

@endsection

@section ('content')
    <!-- Content Wrapper START -->
    <div class="main">
        <!-- Sing in  Form -->
        <section class="sign-in">
            <div class="container">
                <div class="signin-content">
                    <div class="signin-image">
                        <figure>
                            {{ Html::image(asset(config('common.images' . 'signin-image.ipg')), '') }}
                        </figure>
                        <a href="{{ route('user.register_form') }}" class="signup-image-link">{{ __('message.create_account') }}</a>
                    </div>

                    <div class="signin-form">
                        <h2 class="form-title">{{ __('message.login') }}</h2>
                        {{ Form::open(['route' => 'user.login', 'method' => 'POST', 'class' => 'register-form', 'id' => 'login-form']) }}
                        <div class="form-group">
                            <label for="your_name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                            {{ Form::text('email', null, ['id' => 'email', 'placeholder' => __('message.email')]) }}
                            @if ($errors->has('email'))
                                <span class="label-agree-term" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="your_pass"><i class="zmdi zmdi-lock"></i></label>
                            {{ Form::password('password', ['id' => 'password', 'placeholder' => __('message.password')]) }}
                            @if ($errors->has('password'))
                                <span class="label-agree-term" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            {{ Form::checkbox('remember-me', null, '', ['id' => 'remember-me', 'class' => 'agree-term']) }}
                            <label for="remember-me" class="label-agree-term"><span><span></span></span>{{ __('message.remember') }}</label>
                        </div>
                        <div class="form-group form-button">
                            {{ Form::submit(__('message.login', ['name' => 'signin', 'id' => 'signin', 'class' => 'form-submit'])) }}
                        </div>
                        {{ Form::close() }}
                        <div class="social-login">
                            <span class="social-label">{{ __('mesasge.login_with') }}</span>
                            <ul class="socials">
                                <li><a href=""><i class="display-flex-center zmdi zmdi-facebook"></i></a></li>
                                <li><a href=""><i class="display-flex-center zmdi zmdi-twitter"></i></a></li>
                                <li><a href=""><i class="display-flex-center zmdi zmdi-google"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
    <!-- Content Wrapper END -->
@endsection

@section ('script')

@endsection
