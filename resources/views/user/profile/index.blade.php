@extends ('user.layouts.master')

@section ('style')

@endsection

@section ('content')
    <!-- Content Wrapper START -->
    <div class="main-content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="row m-v-30">
                        <div class="col-sm-3">
                            @if (Auth::user()->images == null)
                                {{ Html::image(asset(config('common.img') . 'avatar-5.png'), '', ['class' => 'img-fluid rounded-circle d-block mx-auto m-b-30']) }}
                            @else
                                {{ Html::image(asset(config('common.image_paths.user') . Auth::user()->images), '', ['class' => 'img-fluid rounded-circle d-block mx-auto m-b-30']) }}
                            @endif
                        </div>
                        <div class="col-sm-4 text-center text-sm-left">
                            <h2 class="m-b-5">{{ Auth::user()->name }}</h2>
                            <p class="text-opacity m-b-20 font-size-13"><span>@</span>{{ Auth::user()->nick_name }}</p>
                            <p class="text-dark"><i class="fa fa-envelope m-r-10" aria-hidden="true"></i> {{ Auth::user()->email }}</p>
                            <p class="text-dark"><i class="fa fa-phone m-r-10" aria-hidden="true"></i> {{ Auth::user()->phone }}</p>
                            <p class="text-dark"><i class="fa fa-address-card m-r-10" aria-hidden="true"></i> {{ Auth::user()->address }}</p>
                            @if (Auth::user()->gender == 1)
                                <p class="text-dark"><i class="fa fa-mars m-r-10" aria-hidden="true"></i> Nam</p>
                            @else
                                <p class="text-dark"><i class="fa fa-venus m-r-10" aria-hidden="true"></i> Nữ</p>
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
            <div class="row">
                <div class="col-sm-8">
                    <div class="card">
                        <div class="feed-header">
                            <ul class="list-media">
                                <li class="list-item">
                                    <div class="p-h-30 p-t-30">
                                        <div class="media-img">
                                            {{ Html::image(asset(config('common.img') . 'thumb-1.jpg')) }}
                                        </div>
                                        <div class="info">
                                            <span class="title">Marshall Nichols</span>
                                            <span class="sub-title">@marshallnichole</span>
                                            <div class="float-item">
                                                <span>2 min ago</span>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="p-30">
                            <p>Remember, a Jedi can feel the Force flowing through him. You mean it controls your
                                actions? Partially. But it also obeys your commands. Hokey religions and ancient weapons
                                are no match for a good blaster at your side, kid. You don't believe in the Force, do
                                you? Kid, I've flown from one side of this galaxy to the other.</p>
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
                </div>
                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-body">
                            <img class="img-fluid d-block mx-auto" src="{{ asset(config('common.img' . 'bell.png')) }}"
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
@endsection

@section ('script')

@endsection
