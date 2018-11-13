@extends ('user.layouts.master')

@section ('style')
    {{--<link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}
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
                                @if (Auth::user()->images == null)
                                    {{ Html::image(asset(config('common.img') . 'thumb-3.jpg'), '', ['class' => 'img-fluid rounded-circle d-block mx-auto']) }}
                                @else
                                    {{ Html::image(asset(config('common.image_paths.user') . Auth::user()->images), '', ['class' => 'img-fluid rounded-circle d-block mx-auto']) }}
                                @endif
                            </div>
                            <div class="m-t-15">

                                {{ Form::open(['method' => 'POST', 'route' => ['user.upload_images', Auth::id()], 'enctype' => 'multipart/form-data']) }}
                                <a title="select image" onclick="document.getElementById('myFileInput').click()"><i
                                            class="fa fa-camera"></i>
                                </a>
                                <input name="image_user" id="myFileInput" onchange="loadFile(event)" type='file'
                                       class="display_none"/>
{{--                                {!! Form::file('image_user', ['id' => 'myFileInput', 'class' => 'display_none', 'onechange' => 'loadFile(event)']) !!}--}}

                                <button type="submit" title="upload"><i class="fa fa-upload"></i></button>
                                {{ Form::close() }}

                            </div>
                            <div class="m-t-10">
                                <img width="100%" id="imagePreview"/>
                                {{ Form::text('images', '', ['id' => 'file-image-input', 'class' => 'hidden']) }}
                            </div>
                            {{--<div class="avatar-upload">--}}
                            {{--<form action="{{ route('user.upload_images') }}" method="POST">--}}
                            {{--<div class="avatar-edit">--}}
                            {{--<a title="select image" onclick="document.getElementById('myFileInput').click()"><i class="fa fa-camera"></i>--}}
                            {{--</a>--}}
                            {{--<input id="myFileInput" onchange="loadFile(event)" type='file' accept=".png, .jpg, .jpeg" style="display: none" />--}}
                            {{--</div>--}}
                            {{--<div class="avatar-preview">--}}
                            {{--@if (Auth::user()->images == null)--}}
                            {{--{{ Html::image(asset(config('common.img') . 'thumb-3.jpg')) }}--}}
                            {{--@else--}}
                            {{--{{ Html::image(asset(config('common.image_paths.user') . Auth::user()->images)) }}--}}
                            {{--@endif--}}
                            {{--</div>--}}
                            {{--<div class="m-t-5">--}}
                            {{--<img width="100%" id="imagePreview"/>--}}
                            {{--</div>--}}
                            {{--<div class="text-center">--}}

                            {{--<button type="submit" title="upload"><i class="fa fa-upload"></i></button>--}}

                            {{--</div>--}}
                            {{--</form>--}}
                            {{--</div>--}}
                            {{--<form id="img-upload-form" method="post" accept-charset="utf-8"
                                  onsubmit="return submitImageForm(this)">
                                <img id="logo-img" onclick="document.getElementById('add-new-logo').click();"
                                     src="{{ asset(config('common.img') . 'thumb-3.jpg') }}"/>
                                <input type="file" style="display: none" id="add-new-logo" name="file" accept="image/*"
                                       onchange="addNewLogo(this)"/>
                            </form>--}}
                        </div>
                        <div class="col-sm-4 text-center text-sm-left">
                            <div class="avatar-edit">
                                <a id="call_edit_user" data-id="{{ Auth::id() }}"
                                   title="{{ trans('message.btn_edit') }}" data-tooltip="tooltip">
                                    <i class="fa fa-pencil"></i>
                                </a>
                            </div>
                            <h2 class="m-b-5">
                                {{ Auth::user()->name }}

                            </h2>
                            <p class="text-opacity m-b-20 font-size-13"><span>@</span>{{ Auth::user()->nick_name }}</p>
                            <p class="text-dark"><i class="fa fa-envelope m-r-10"
                                                    aria-hidden="true"></i> {{ Auth::user()->email }}</p>
                            <p class="text-dark"><i class="fa fa-phone m-r-10"
                                                    aria-hidden="true"></i> {{ Auth::user()->phone }}</p>
                            <p class="text-dark"><i class="fa fa-address-card m-r-10"
                                                    aria-hidden="true"></i> {{ Auth::user()->address }}</p>
                            @if (Auth::user()->gender == 1)
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
                                    <p class="m-t-30 lh-2-2">Climb leg rub face on everything give attitude nap all day
                                        for under the bed. Chase mice attack feet but rub face on everything hopped up
                                        on goofballs.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{--@dd($posts);--}}
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
                            {{--@dd($post->topic->name)--}}
                            <div class="p-30">
                                <b class="font-size-15">
                                    {{ $post->title }} &nbsp; <i class="fa fa-caret-right font-size-17"
                                                                 aria-hidden="true"></i> &nbsp;
                                    <a href="#">{{ $post->topic->name }}</a>
                                </b>
                                <p class="font-size-13 m-t-10">{{ $post->body }}</p>
                                <ul class="list-inline m-t-20 p-v-15">
                                    <li class="m-r-25">
                                        <a href="#" class="text-gray font-size-16 ">
                                            <i class="ti-heart text-danger p-r-5"></i>
                                            <span>168</span>
                                        </a>
                                    </li>
                                    <li class="m-r-20">
                                        <a href="#" class="text-gray font-size-16">
                                            <i class="ti-comments text-success p-r-5"></i>
                                            <span>18</span>
                                        </a>
                                    </li>
                                </ul>
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
                                <button class="btn btn-info m-t-20">{{ __('message.subscribe') }}</button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Content Wrapper END -->

    {{--modal--}}
    <div class="modal fade" id="edit_user_modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>{{ trans('message.edit_user') }}</h4>
                </div>
                <div class="modal-body">
                    {{ Form::open(['method' => 'PUT', 'id' => 'edit_user_form', 'name' => 'edit_user_form']) }}

                    {{ Form::hidden('user_id', '', ['class' => 'form-control', 'id' => 'user_id']) }}

                    <div class="row">
                        <div class="col-md-7">
                            {{--name--}}
                            <div id="add-group" class="form-group form-md-line-input form-md-floating-label">
                                {{ Form::text('name', '', ['class' => 'form-control', 'id' => 'edit_name']) }}
                            </div>
                        </div>

                        <div class="col-md-5">
                            {{--nick_name--}}
                            <div id="add-group" class="form-group form-md-line-input form-md-floating-label">
                                {{ Form::text('nick_name', '', ['class' => 'form-control', 'id' => 'edit_nick_name']) }}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-8">
                            <div id="add-group" class="form-group form-md-line-input form-md-floating-label">
                                {{ Form::text('email', '', ['class' => 'form-control', 'id' => 'edit_email', 'readonly']) }}
                            </div>
                        </div>
                        <div class="col-md-4">
                            {{--phone--}}
                            <div id="add-group" class="form-group form-md-line-input form-md-floating-label">
                                {{ Form::text('phone', '', ['class' => 'form-control', 'id' => 'edit_phone']) }}
                            </div>
                        </div>
                    </div>

                    {{--address--}}
                    <div id="add-group" class="form-group form-md-line-input form-md-floating-label">
                        {{ Form::text('address', '', ['class' => 'form-control', 'id' => 'edit_address']) }}
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div id="add-group" class="form-group form-md-line-input form-md-floating-label">
                                {{ Form::select('gender', ['0' => trans('message.male'), '1' => trans('message.female')], '', ['class' => 'form-control', 'id' => 'edit_gender']) }}
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer no-border">
                        {{ Form::button(trans('message.btn_cancel'), ['class' => 'btn btn-default', 'data-dismiss' => 'modal']) }}
                        {{ Form::button(trans('message.btn_edit'), ['class' => 'btn btn-success', 'id' => 'edit_user']) }}
                    </div>
                    {{ Form::close() }}
                </div>

            </div>
        </div>

    </div>
@endsection

@section ('script')
    <script src="{{ asset('js/user.js') }}" type="text/javascript"></script>
    <script>
        // Goi modal edit user
        $(document).on('click', '#call_edit_user', function () {
            $('#edit_user_modal').modal('show');

            var user_id = $(this).data('id');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'GET',
                url: '/cfs/profiles/' + user_id + '/edit',
                success: function (res) {
                    $('#edit_name').val(res.user['name']);
                    $('#edit_nick_name').val(res.user['nick_name']);
                    $('#edit_email').val(res.user['email']);
                    $('#edit_address').val(res.user['address']);
                    $('#edit_phone').val(res.user['phone']);
                    $('#edit_gender').val(res.user['gender']);
                    $('#user_id').val(res.user['id']);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    toastr.error(thrownError);
                }
            });
        });

        //update
        $('#edit_user').on('click', function (event) {
            event.preventDefault();
            var user_id = $('#user_id').val();
            var form = $('#edit_user_form');
            var formData = form.serialize();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'PUT',
                url: 'profiles/' + user_id,
                data: formData,
                success: function (res) {
                    if (res.error == 'valid') {
                        var arr = res.message;
                        var key = Object.keys(arr);
                        for (var i = 0; i < key.length; i++) {
                            // toastr.error(arr[key[i]]);
                        }
                    } else if (res.error == false) {
                        // toastr.success("Cập nhật người dùng thành công!");
                        $('#edit_user_modal').modal('hide');
                        setTimeout(function () {
                            window.location.reload();
                        }, 1000);
                    } else {
                        //
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    //
                }
            });
        })
    </script>
@endsection
