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
                <div class="col-sm-3">
                    <div class="card">
                        <div class="card-body">
                            <ul class="list-media">
                                <li class="list-item">
                                    <div class="p-b-15">
                                        <div class="media-img">
                                            {{ Html::image(asset(config('common.img') . 'icon.png'), '') }}
                                        </div>
                                        <div class="info">
                                            <span class="title">F_Confession</span>
                                            <span class="sub-title">@f_confession</span>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <p>{{ __('message.info') }}</p>
                        </div>
                        <div class="card-footer">
                            <p class="text-dark font-size-13"><b>{{ __('message.follow_me') }}</b></p>
                            <ul class="list-inline">
                                <li class="m-r-15">
                                    <a class="text-gray" href="">
                                        <i class="mdi mdi-instagram font-size-25"></i>
                                    </a>
                                </li>
                                <li class="m-r-15">
                                    <a class="text-gray" href="">
                                        <i class="mdi mdi-facebook font-size-25"></i>
                                    </a>
                                </li>
                                <li class="m-r-15">
                                    <a class="text-gray" href="">
                                        <i class="mdi mdi-twitter font-size-25"></i>
                                    </a>
                                </li>
                                <li class="m-r-15">
                                    <a class="text-gray" href="">
                                        <i class="mdi mdi-dribbble font-size-25"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title m-b-25">{{ __('message.topic') }}</h4>
                            <div class="row">
                                @foreach ($topics as $key => $topic)
                                    <div class="box8">
                                        {{ Html::image(asset(config('common.topics') . $topic->images), '') }}
                                        <h3 class="title">{{ $topic->name }}</h3>
                                        <div class="box-content">
                                            {{--follow--}}
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
                                            </ul>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="border top p-v-15 p-h-20 text-center">
                            <a href="" class="text-semibold text-dark d-block">{{ __('message.more') }}</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card">
                        <div class="social-footer">

                            <div class="social-comment">
                                <a href="" class="pull-left">
                                    @if (Auth::check())
                                        @if (Auth::user()->images == null)
                                            {{ Html::image(asset(config('common.img') . 'thumb-3.jpg'), '') }}
                                        @else
                                            {{ Html::image(asset(config('common.image_paths.user') . Auth::user()->images)) }}
                                        @endif
                                    @else
                                        {{ Html::image(asset(config('common.img') . 'avatar-5.png'), '') }}
                                    @endif
                                </a>
                                <div class="media-body">
                                    @if (Auth::check())
                                        {{ Form::open(['route' => 'posts.store', 'method' => 'POST', 'files' => true]) }}
                                        <div class="m-b-5">
                                            {{ Form::text('title', null, ['id' => 'title', 'class' => 'form-control', 'placeholder' => __('message.title')]) }}
                                            {{ Form::hidden('slug', null, ['id' => 'slug']) }}
                                        </div>
                                        <div class="m-b-5">
                                            {{ Form::textarea('body', null, ['class' => 'form-control', 'placeholder' => __('message.your_mean'), 'rows' => '3']) }}
                                        </div>
                                        <div class="row m-b-5">
                                            <div class="col-md-4">
                                                {{ Form::select('topic', $topicAll, '', ['class' => 'form-control', 'placeholder' => __('message.select_topic')]) }}
                                            </div>
                                            <div class="col-md-4">
                                                {{ Form::select('type', ['0' => __('message.anomyous'), '1' => __('message.not_anomyous')], '', ['class' => 'form-control', 'placeholder' => __('message.select_type')]) }}
                                            </div>
                                            <div class="col-md-4">
                                                {{ Form::file('filename[]', ['id' => 'images', 'multiple']) }}
                                            </div>
                                        </div>
                                        <div class="row" id="image_preview"></div>
                                        <br>
                                        {{ Form::submit('Submit', ['class' => 'btn btn-success btn-rounded']) }}
                                        {{ Form::close() }}
                                    @else
                                        {{ Form::open(['route' => 'posts.store', 'method' => 'POST', 'files' => true]) }}
                                        <div class="m-b-5">
                                            {{ Form::text('title', null, ['onkeyup' => 'ChangeToSlug()', 'id' => 'title', 'class' => 'form-control', 'placeholder' => __('message.title')]) }}
                                            {{ Form::hidden('slug', null, ['id' => 'slug']) }}
                                        </div>
                                        <div class="m-b-5">
                                            {{ Form::textarea('body', null, ['class' => 'form-control', 'placeholder' => __('message.your_mean'), 'rows' => '3']) }}
                                        </div>
                                        <div class="row m-b-5">
                                            <div class="col-md-4">
                                                {{ Form::select('type', ['0' => __('message.anomyous')], '0', ['class' => 'form-control', 'placeholder' => __('message.select_type')]) }}
                                            </div>
                                            <div class="col-md-4">
                                                {{ Form::file('filename[]', ['id' => 'images', 'multiple']) }}
                                            </div>
                                        </div>
                                        <div class="row" id="image_preview"></div>
                                        <br>
                                        {{ Form::submit('Submit', ['class' => 'btn btn-success btn-rounded']) }}
                                        {{ Form::close() }}
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        @foreach ($posts as $key => $post)
                            <div class="feed-header">
                                <ul class="list-media">
                                    <li class="list-item">
                                        <div class="p-h-30 p-t-30">
                                            @if ($post->type == 0)
                                                <div class="media-img">
                                                    {{ Html::image(asset(config('common.img') . 'avatar-5.png'), '') }}
                                                </div>
                                                <div class="info">
                                                    <span class="title">F-Confession</span>
                                                    <span class="sub-title">@Anomyous</span>
                                                    <div class="float-item">
                                                        <span>{{ $post->created_at }}</span>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="media-img">
                                                    @if ($post->users->images == null)
                                                        {{ Html::image(asset(config('common.img') . 'thumb-3.jpg')) }}
                                                    @else
                                                        {{ Html::image(asset(config('common.image_paths.user') . $post->users->images), $post->users->name) }}
                                                    @endif
                                                </div>
                                                <div class="info">
                                                    @if (Auth::id() == $post->users->id)
                                                        <span class="title">
                                                            <a href="{{ route('profiles.index') }}">
                                                                {{ $post->users->name }}
                                                            </a>
                                                        </span>
                                                    @else
                                                        <span class="title">
                                                            <a href="{{ route('detailUser', $post->users->id) }}">
                                                                {{ $post->users->name }}
                                                            </a>
                                                        </span>
                                                    @endif
                                                    <span class="sub-title"><span>@</span>{{ $post->users->nick_name }}</span>
                                                    <div class="float-item">
                                                        @php
                                                            $created_at = $post->created_at;
                                                            $created_at = \Carbon\Carbon::parse($created_at);
                                                            $elapsed = $created_at->diffForHumans(\Carbon\Carbon::now());
                                                        @endphp
                                                        <span>{{ $elapsed }}</span>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="p-15">
                                <a class="m-b-5 font-size-15" href="{{ route('posts.show', $post->id) }}">
                                    {{ $post->title }}
                                </a>
                                &nbsp <i class="fa fa-caret-right font-size-17" aria-hidden="true"></i> &nbsp;
                                <a href="#">
                                    {{ $post->topic->name }}
                                </a>
                                <p class="m-b-15">{{ $post->body }}</p>
                                <div class="row">
                                    @foreach ($post->images as $image)
                                        <div class="col-md-4">
                                            {{ Html::image(asset(config('common.image_paths.post') . $image->filename), '', ['width' => '100%']) }}
                                        </div>
                                    @endforeach
                                </div>
                                <ul class="list-inline m-t-20 p-v-15">
                                    @if (Auth::check())
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
                                    @endif
                                    <li class="m-r-20">
                                        <a class="text-gray font-size-16" title="Comment">
                                            <i class="ti-comments text-success p-r-5"></i>
                                        </a>
                                        <span id="countComment_{{ $post->id }}">{{ DB::table('comments')->where([['post_id', $post->id], ['deleted_at', '=', null]])->count() }}</span>
                                    </li>
                                    @if (Auth::check())
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
                                    @endif
                                    @if (Auth::check())
                                        <li class="m-r-20">
                                            <a href="" class="text-gray font-size-16" title="Delete">
                                                <i class="ti-trash text-danger p-r-5"></i>
                                            </a>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                            <div class="social-footer">
                                @foreach ($post->comments as $comment)
                                    <div class="social-comment" id="comment{{ $comment->id }}">
                                        <a href="#" class="pull-left">
                                            @if ($comment->users->images == null)
                                                {{ Html::image(asset(config('common.img') . 'avatar-5.png')) }}
                                            @else
                                                {{ Html::image(asset(config('common.image_paths.user') . $comment->users->images)) }}
                                            @endif
                                        </a>
                                        <div class="media-body">
                                            @if (Auth::id() == $post->users->id)
                                                <span class="title">
                                                    <a href="{{ route('profiles.index') }}">
                                                        {{ $comment->users->name }}
                                                    </a> -
                                                </span>
                                            @else
                                                <span class="title">
                                                    <a href="{{ route('detailUser', $post->users->id) }}">
                                                        {{ $comment->users->name }}
                                                    </a> -
                                                </span>
                                            @endif
                                            <small class="text-muted">{{ $comment->created_at }}</small> &nbsp;
                                            @if (Auth::check())
                                                @if (Auth::user()->id == $comment->users->id)
                                                    <a data-id="{{ $comment->id }}" class="text-danger btnDelete"
                                                       title="Delete" data-postid="{{ $post->id }}"
                                                       onclick="deleteComment({{ $comment->id . ',' . $post->id }})"><i
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
    {{ Form::hidden('message_yes', __('message.yes'), ['id' => 'message_yes']) }}
    {{ Form::hidden('message_no', __('message.no'), ['id' => 'message_no']) }}
    {{ Form::hidden('config', asset(config('common.img') . 'avatar-5.png'), ['id' => 'config']) }}
    {{ Form::hidden('url', asset(config('common.image_paths.user')), ['id' => 'url']) }}
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
