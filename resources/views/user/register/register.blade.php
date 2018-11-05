@extends ('user.layouts.app')

@section ('style')

@endsection

@section ('content')
    <!-- Content Wrapper START -->
    <div class="main">

        <!-- Sign up form -->
        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">{{ __('message.register') }}</h2>
                        {{ Form::open(['route' => 'user.register', 'method' => 'POST', 'class' => 'register-form', 'id' => 'register-form']) }}
                        <div class="form-group">
                            <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                            {{ Form::text('name', null, ['id' => 'name', 'placeholder' => __('message.your_name')]) }}
                            @if ($errors->has('name'))
                                <a class="signup-image-link" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </a>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                            {{ Form::text('nick_name', null, ['id' => 'nick_name', 'placeholder' => __('message.nick_nam')]) }}
                            @if ($errors->has('nick_name'))
                                <a class="signup-image-link" role="alert">
                                    <strong>{{ $errors->first('nick_name') }}</strong>
                                </a>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="email"><i class="zmdi zmdi-email"></i></label>
                            {{ Form::text('email', null, ['type' => 'email', 'id' => 'email', 'placeholder' => __('message.email')]) }}
                            @if ($errors->has('email'))
                                <a class="signup-image-link" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </a>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                            {{ Form::password('password', ['id' => 'password', 'placeholder' => __('message.password')]) }}
                            @if ($errors->has('password'))
                                <a class="signup-image-link" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </a>
                            @endif
                        </div>
                        <div class="form-group form-button">
                            {{ Form::submit('Register', ['name' => 'signup', 'id' => 'signup', 'class' => 'form-submit']) }}
                        </div>
                        {{ Form::close() }}
                    </div>
                    <div class="signup-image">
                        <figure>
                            {{ Html::image(asset(config('common.images' . 'signup-image.ipg')), '') }}
                        </figure>
                        <a href="" class="signup-image-link">{{ __('message.ready') }}</a>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- Content Wrapper END -->
@endsection

@section ('script')

@endsection
