@extends ('user.layouts.master')

@section ('style')
    <script>
        var loadFile = function (event) {
            var reader = new FileReader();
            reader.onload = function () {
                var output = document.getElementById('imagePreview');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        };
    </script>
    <link href="{{ asset('bower_components/demo-bower/confession/user/css/jasny-bootstrap.min.css') }}"
          rel="stylesheet">
    <link href="{{ asset('bower_components/demo-bower/confession/user/css/selectize.default.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css"
          href="{{ asset('bower_components/demo-bower/confession/user/css/sweet-alert.css') }}">
    <link rel="stylesheet" type="text/css"
          href="{{ asset('bower_components/demo-bower/confession/user/css/toastr.min.css') }}">
@endsection

@section ('content')
    <!-- Content Wrapper START -->
    <div class="main-content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="row m-v-30">
                        <div class="col-sm-3 text-center">
                            <div class="">
                                @if ($user->images == null)
                                    {{ Html::image(asset(config('common.img') . 'thumb-3.jpg'), '', ['class' => 'img-fluid rounded-circle d-block mx-auto']) }}
                                @else
                                    {{ Html::image(asset(config('common.image_paths.user') . $user->images), '', ['class' => 'img-fluid rounded-circle d-block mx-auto']) }}
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-4 text-center text-sm-left">
                            <h2 class="m-b-5">
                                {{ $user->name }}
                            </h2>
                            <p class="text-opacity m-b-20 font-size-13"><span>@</span>{{ $user->nick_name }}</p>
                            <p class="text-dark"><i class="fa fa-envelope m-r-10"
                                                    aria-hidden="true"></i> {{ $user->email }}</p>
                            <p class="text-dark"><i class="fa fa-phone m-r-10"
                                                    aria-hidden="true"></i> {{ $user->phone }}</p>
                            <p class="text-dark"><i class="fa fa-address-card m-r-10"
                                                    aria-hidden="true"></i> {{ $user->address }}</p>
                            @if ($user->gender == 1)
                                <p class="text-dark"><i class="fa fa-mars m-r-10"
                                                        aria-hidden="true"></i>{{ trans('message.female') }}</p>
                            @else
                                <p class="text-dark"><i class="fa fa-venus m-r-10"
                                                        aria-hidden="true"></i>{{ trans('message.male') }}</p>
                            @endif
                        </div>
                        <div class="col">
                            <p class="text-dark font-size-13"><b>{{ __('message.follow_me') }}</b></p>
                            <ul class="list-inline">
                                <li class="m-r-15">
                                    <a class="text-gray" href="#">
                                        <i class="mdi mdi-instagram font-size-25"></i>
                                    </a>
                                </li>
                                <li class="m-r-15">
                                    <a class="text-gray" href="#">
                                        <i class="mdi mdi-facebook font-size-25"></i>
                                    </a>
                                </li>
                                <li class="m-r-15">
                                    <a class="text-gray" href="#">
                                        <i class="mdi mdi-twitter font-size-25"></i>
                                    </a>
                                </li>
                                <li class="m-r-15">
                                    <a class="text-gray" href="#">
                                        <i class="mdi mdi-dribbble font-size-25"></i>
                                    </a>
                                </li>
                            </ul>
                            <div class="row">
                                <div class="col-lg-9">
                                    <p class="m-t-30 lh-2-2">{{ trans('message.demo_content') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-8">
                    @foreach($posts as $post)
                        <div class="card">
                            <div class="feed-header">
                                <ul class="list-media">
                                    <li class="list-item">
                                        <div class="p-h-30 p-t-30">
                                            <div class="media-img">
                                                @if ($user->images == null)
                                                    {{ Html::image(asset(config('common.img') . 'thumb-3.jpg'), '') }}
                                                @else
                                                    {{ Html::image(asset(config('common.image_paths.user') . $user->images)) }}
                                                @endif
                                            </div>
                                            <div class="info">
                                                <span class="title">{{ $user->name }}</span>
                                                <span class="">@</span>{{ $user->nick_name }}
                                                <div class="float-item">
                                                    {{--xu ly thoi gian thuc so voi thoi gian tao bai--}}
                                                    @php
                                                        $created_at = $post->created_at;
                                                        $created_at = \Carbon\Carbon::parse($created_at);
                                                        $elapsed = $created_at->diffForHumans(\Carbon\Carbon::now());
                                                    @endphp
                                                    <span>{{ $elapsed }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="p-30">
                                <a class="m-b-5 font-size-15" href="{{ route('posts.show', $post->id) }}">
                                    {{ $post->title }}
                                </a>
                                &nbsp <i class="fa fa-caret-right font-size-17" aria-hidden="true"></i> &nbsp;
                                <a href="#">
                                    {{ $post->topic->name }}
                                </a>
                                <p class="font-size-13 m-t-10">{{ $post->body }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-body">
                            <img class="img-fluid d-block mx-auto" src="{{ asset(config('common.img') . 'bell.png') }}"
                                 alt="">
                            <div class="text-center">
                                <h5 class="text-dark font-size-18"><b>{{ __('message.follow') }}</b></h5>
                                {{--data-id: la id duoc theo doi, data-userid: la user theo doi--}}
                                @if (Auth::check())
                                    @if ($user->followed($user->id))
                                        <i id="followingUser_{{ $user->id }}"
                                           class="btn btn-info btn-rounded btn-outline btn-xs followingUser"
                                           data-id="{{ $user->id }}"
                                           data-userid="{{ Auth::user()->id }}"
                                           data-type="App\Models\User">
                                            {{ trans('message.following') }}
                                        </i>
                                    @else
                                        <i id="followUser_{{ $user->id }}"
                                           class="btn btn-info btn-xs followUser"
                                           data-id="{{ $user->id }}"
                                           data-userid="{{ Auth::user()->id }}"
                                           data-type="App\Models\User">
                                            {{ trans('message.follow') }}
                                        </i>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{ Form::hidden('message_delete_comment', __('message.delete_comment'), ['id' => 'message_delete_comment']) }}
    {{ Form::hidden('message_yes', __('message.yes'), ['id' => 'message_yes']) }}
    {{ Form::hidden('message_no', __('message.no'), ['id' => 'message_no']) }}
    {{ Form::hidden('config', asset(config('common.img') . 'avatar-5.png'), ['id' => 'config']) }}
    <!-- Content Wrapper END -->
@endsection

@section ('script')
    <script src="{{ asset('bower_components/demo-bower/confession/user/js/jasny-bootstrap.min.js') }}"></script>
    <script src="{{ asset('bower_components/demo-bower/confession/user/js/selectize.min.js') }}"></script>
    <script src="{{ asset('bower_components/demo-bower/confession/user/js/sweet-alert.min.js') }}"></script>
    <script src="{{ asset('bower_components/demo-bower/confession/user/js/toastr.min.js') }}"></script>
    @routes
    <script src="{{ asset('js/user.js') }}" type="text/javascript"></script>
@endsection
