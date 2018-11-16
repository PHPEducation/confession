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
                <div class="col-sm-8">
                    @foreach($posts as $post)
                        <div class="card">
                            <div class="feed-header">
                                <ul class="list-media">
                                    <li class="list-item">
                                        <div class="p-h-30 p-t-30">
                                            <div class="media-img">
                                                @if (Auth::user()->images == null)
                                                    {{ Html::image(asset(config('common.img') . 'thumb-3.jpg'), '') }}
                                                @else
                                                    {{ Html::image(asset(config('common.image_paths.user') . Auth::user()->images)) }}
                                                @endif
                                            </div>
                                            <div class="info">
                                                <span class="title">{{ Auth::user()->name }}</span>
                                                <span class="">@</span>{{ Auth::user()->nick_name }}
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
                                <b class="font-size-15">
                                    {{ $post->title }} &nbsp; <i class="fa fa-caret-right font-size-17"
                                                                 aria-hidden="true"></i> &nbsp;
                                    <a href="{{ route('topic.show', $topic->id) }}">{{ $post->topic->name }}</a>
                                </b>
                                <p class="font-size-13 m-t-10">{{ $post->body }}</p>
                                <ul class="list-inline m-t-20 p-v-15">
                                    <li class="m-r-25">
                                        @if($post->liked($post->id))
                                            <i id="unlike_{{ $post->id }}"
                                               class="text-gray font-size-16 dislike"
                                               title="" data-typeid=""
                                               data-postid="{{ $post->id }}"
                                               data-userid="{{ Auth::user()->id }}"
                                               data-likeid="">
                                                <i class="fa fa-thumbs-up text-info p-r-5"></i>
                                            </i>
                                            <span id="countLike_{{ $post->id }}">{{ DB::table('likes')->where([['post_id', $post->id], ['type', 1]])->count() }}</span>
                                        @else
                                            <i id="like_{{ $post->id }}"
                                               class="text-gray font-size-16 like"
                                               title="" data-typeid=""
                                               data-postid="{{ $post->id }}"
                                               data-userid="{{ Auth::user()->id }}"
                                               data-likeid="">
                                                <i class="fa fa-thumbs-o-up text-info p-r-5"></i>
                                            </i>
                                            <span id="countLike_{{ $post->id }}">{{ DB::table('likes')->where([['post_id', $post->id], ['type', 1]])->count() }}</span>
                                        @endif
                                    </li>

                                    <li class="m-r-20">
                                        <a class="text-gray font-size-16" title="Comment">
                                            <i class="ti-comments text-success p-r-5"></i>
                                        </a>
                                        <span class="countComment">{{ DB::table('comments')->where([['post_id', $post->id], ['deleted_at', '=', null]])->count() }}</span>
                                    </li>

                                    <li class="m-r-20">
                                        @if($post->reported($post->id))
                                            <i id="reported_{{ $post->id }}"
                                               class="text-gray font-size-16 reported" title=""
                                               data-typeid=""
                                               data-postid="{{ $post->id }}"
                                               data-userid="{{ Auth::user()->id }}"
                                               data-reportid="">
                                                <i class="fa fa-flag text-primary p-r-5"></i>
                                            </i>
                                            <span id="countReport_{{ $post->id }}">{{ DB::table('reports')->where([['post_id', $post->id], ['type', 1]])->count() }}</span>
                                        @else
                                            <i id="report_{{ $post->id }}"
                                               class="text-gray font-size-16 report"
                                               title="" data-typeid=""
                                               data-postid="{{ $post->id }}"
                                               data-userid="{{ Auth::user()->id }}"
                                               data-reportid="">
                                                <i class="fa fa-flag-o text-primary p-r-5"></i>
                                            </i>
                                            <span id="countReport_{{ $post->id }}">{{ DB::table('reports')->where([['post_id', $post->id], ['type', 1]])->count() }}</span>
                                        @endif
                                    </li>

                                    <li class="m-r-20">
                                        <a href="" class="text-gray font-size-16" title="Delete">
                                            <i class="ti-trash text-danger p-r-5"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <div class="social-footer">
                                @foreach ($post->comments as $comment)
                                    <div class="social-comment" id="comment{{ $comment->id }}">
                                        <a href="#" class="pull-left">

                                            @if ($comment->users->images == null)
                                                {{ Html::image(asset(config('common.img') . 'avatar-5.png')) }}
                                            @else
                                                {{ Html::image(asset(config('common.img') . $comment->users->images)) }}
                                            @endif
                                        </a>
                                        <div class="media-body">
                                            <a href="#">
                                                {{ $comment->users->name }}
                                            </a> -
                                            <small class="text-muted">{{ $comment->created_at }}</small>
                                            -
                                            @if (Auth::check())
                                                @if (Auth::user()->id == $comment->users->id)
                                                    <a data-id="{{ $comment->id }}" class="text-danger btnDelete"
                                                       title="Delete" onclick="deleteComment({{ $comment->id }})"><i
                                                                class="fa fa-trash"></i></a>
                                                @endif
                                            @endif
                                            <br>
                                            {{ $comment->body }}
                                            <br>
                                        </div>
                                    </div>
                                @endforeach
                                <div id="load_comment_{{ $post->id }}"></div>
                                @if (Auth::check())
                                    {{ Form::open(['method' => 'POST', 'id' => 'comment_form_'. $post->id]) }}
                                    {!! Form::hidden('post_id', $post->id, ['id' => 'post_id']) !!}
                                    {!! Form::hidden('user_id', Auth::user()->id, ['id' => 'user_id']) !!}
                                    <div class="social-comment">
                                        <a href="#" class="pull-left">
                                            @if (Auth::user()->images == null)
                                                {{ Html::image(asset(config('common.img') . 'avatar-5.png')) }}
                                            @else
                                                {{ Html::image(asset(config('common.image_paths.user') . Auth::user()->images)) }}
                                            @endif
                                        </a>
                                        <div class="media-body">
                                            {{ Form::textarea('body', null, ['id' => 'body', 'class' => 'form-control body', 'placeholder' => __('message.write_comment'), 'rows' => '2']) }}
                                            <br>
                                            {!! Form::button('Comment', ['name' => 'comment', 'class' => 'btn btn-success btnComment', 'id' => 'comment', 'onclick' => 'postComment(' . $post->id . ')']) !!}
                                        </div>
                                    </div>
                                    {{ Form::close() }}
                                @endif
                            </div>
                        </div>
                    @endforeach
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
