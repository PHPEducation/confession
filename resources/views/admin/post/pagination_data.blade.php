<div class="table-scrollable">
    <table class="table table-striped table-bordered table-advance table-hover">
        <thead>
        <tr>
            <th>
                <i class="fa fa-bookmark-o"> </i> {{ trans('message.post_title') }}
            </th>
            <th>
                <i class="fa fa-share-square-o"> </i> {{ trans('message.post_topic') }}
            </th>
            <th>
                <i class="fa fa-user"> </i> {{ trans('message.post_user') }}
            </th>
            <th>
                <i class="fa fa-calendar-check-o"> </i> {{ trans('message.created_at') }}
            </th>
            <th></th>
        </tr>
        </thead>
        <tbody>

        @foreach($posts as $post)
            @php
                $count = $post->count($post->id);
            @endphp
            <tr class="{{ ($count < 3) ? '' : 'text-danger' }}">
                <td class="highlight">
                    @if ($post->id % 3 == 0)
                        <div class="success"></div>
                    @elseif ($post->id % 3 == 1)
                        <div class="info"></div>
                    @elseif ($post->id % 3 == 2)
                        <div class="warning"></div>
                    @endif
                    <a href=""
                       class="{{ ($count < 3) ? '' : 'text-danger' }}">{{ $post->title }}</a>
                </td>
                {{--@dd($post->type)--}}
                <td>
                    {{--@if ($post->topic->name == null)--}}
                    {{--{{ trans('message.') }}--}}
                    {{--@else--}}
                    {{ $post->topic->name }}
                    {{--@endif--}}
                </td>
                <td>
                    @if ($post->type == 1)
                        {{ $post->users->name }}
                    @elseif ($post->type == 0)
                        {{ trans('message.anonymous') }}
                    @endif
                </td>
                <td>{{ $post->created_at }}</td>
                <td>
                    <a href="{{ route('postShowAdmin', $post->id) }}"
                       class="btn btn-outline btn-circle btn-sm green-jungle">
                        <i class="fa fa-eye"></i> {{ trans('message.btn_show') }} </a>
                    {!! Form::open(['method' => 'DELETE', 'class' => 'display_form', 'route' => ['postDelAdmin', 'id' => $post->id]]) !!}
                    {!! Form::button('<i0 class="fa fa-trash-o"></i> ' . trans('message.btn_delete'), ['class' => 'btn btn-outline btn-circle btn-sm red-thunderbird', 'type' => 'submit']) !!}
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {!! $posts->links() !!}
</div>
