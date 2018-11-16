@extends ('user.layouts.master')

@section ('style')
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
            <div class="row">
                <div class="col-md-9">
                    <div class="row">
                        @foreach ($topics as $key => $topic)
                            <div class="col-md-4 box8">
                                {{ Html::image(asset(config('common.topics') . $topic->images), '') }}
                                <h3 class="title">{{ $topic->name }}</h3>
                                <div class="box-content">
                                    <ul class="icon">
                                        @if (Auth::check())
                                            <li>
                                                @if ($topic->followed($topic->id))
                                                    <i id="following_{{ $topic->id }}"
                                                       class="btn btn-info btn-rounded btn-xs following"
                                                       data-id="{{ $topic->id }}"
                                                       data-userid="{{ Auth::user()->id }}"
                                                       data-type="App\Models\Topic">
                                                        {{ trans('message.following') }}
                                                    </i>
                                                @else
                                                    <i id="follow_{{ $topic->id }}"
                                                       class="btn btn-info btn-rounded btn-xs follow"
                                                       data-id="{{ $topic->id }}"
                                                       data-userid="{{ Auth::user()->id }}"
                                                       data-type="App\Models\Topic">
                                                        {{ trans('message.follow') }}
                                                    </i>
                                                @endif
                                            </li>
                                        @endif
                                        <li>
                                            <a class="btn btn-info btn-rounded btn-xs"
                                               href="{{ route('topics.show', $topic->id) }}"><i class="fa fa-link"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title m-b-25">{{ __('message.friends') }}</h4>
                            <ul class="list-media">
                                @foreach($users as $user)
                                    <li class="list-item">
                                        <div class="p-b-15">
                                            <div class="media-img">
                                                @if ($user->images == null)
                                                    {{ Html::image(asset(config('common.img') . 'thumb-3.jpg'), '') }}
                                                @else
                                                    {{ Html::image(asset(config('common.image_paths.user') . $user->images)) }}
                                                @endif
                                            </div>
                                            <div class="info">
                                                @if (Auth::id() == $user->id)
                                                    <span class="title">
                                                            <a href="{{ route('profiles.index') }}">
                                                                {{ $user->name }}
                                                            </a>
                                                        </span>
                                                @else
                                                    <span class="title">
                                                            <a href="{{ route('detailUser', $user->id) }}">
                                                                {{ $user->name }}
                                                            </a>
                                                        </span>
                                                @endif

                                                <span class="sub-title"><span>@</span>{{ $user->nick_name }}</span>
                                                <div id="follow_user">
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
                                                               class="btn btn-info btn-rounded btn-xs followUser"
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
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="border top p-v-15 p-h-20 text-center">
                            <a href="" class="text-semibold text-dark d-block">{{ __('message.more') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{ Form::hidden('message_delete_comment', __('message.delete_comment'), ['id' => 'message_delete_comment']) }}
    {{ Form::hidden('message_delete_post', __('message.delete_post'), ['id' => 'message_delete_post']) }}
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

    <script type="text/javascript">

    </script>
@endsection
