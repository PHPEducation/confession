{!! Form::open(['route' => 'permissions/bulk_update', 'method' => 'POST', 'class' => 'form-inline']) !!}
<div id="_token" class="hidden" data-token="{{ csrf_token() }}"></div>
<table class="table table-striped table-bordered table-advance table-hover">
    <thead>
    <tr>
        <th>
            <i class="fa fa-bookmark-o"> </i> {{ trans('message.permission_name') }}
        </th>
        <th>
            <i class="fa fa-bookmark-o"> </i> {{ trans('message.permission_display_name') }}
        </th>
        <th>
            <i class="fa fa-bookmark-o"> </i> {{ trans('message.permission_desc') }}
        </th>
        <th>
            <i class="fa fa-calendar-check-o"> </i> {{ trans('message.created_at') }}
        </th>
        <th></th>
    </tr>
    </thead>

    <tbody>
    @foreach($permissions as $permission)
        <tr>
            <td class="highlight">
                @if ($permission->id % 3 == 0)
                    <div class="success"></div>
                @elseif ($permission->id % 3 == 1)
                    <div class="info"></div>
                @elseif ($permission->id % 3 == 2)
                    <div class="warning"></div>
                @endif
                <a href="#" class="testEdit editable editable-click" data-type="text" data-column="name"
                   data-url="{{ route('permissions/update', ['id' => $permission->id]) }}"
                   data-pk="{{ $permission->id }}" data-title="change" data-name="name">
                    {{ $permission->name }}
                </a>
            </td>
            <td>{{ $permission->display_name }}</td>
            <td>{{ $permission->description }}</td>
            <td>{{ $permission->created_at }}</td>
            <td>
                <a href="{{ route('permissions.edit', $permission->id) }}"
                   class="btn btn-outline btn-circle btn-sm purple">
                    <i class="fa fa-edit"></i> {{ trans('message.btn_edit') }} </a>
                {!! Form::open(['method' => 'DELETE', 'class' => 'display_form', 'route' => ['permissions.destroy', 'id' => $permission->id]]) !!}
                {!! Form::button('<i class="fa fa-trash-o"></i> ' . trans('message.btn_delete'), ['class' => 'btn btn-outline btn-circle btn-sm red-thunderbird', 'type' => 'submit']) !!}
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
{!! $permissions->links() !!}
{!! Form::close() !!}
