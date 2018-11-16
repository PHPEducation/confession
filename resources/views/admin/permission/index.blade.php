@extends('admin.index')
@section('content')
    <div class="theme-panel hidden-xs hidden-sm">
    </div>
    <!-- END THEME PANEL -->
    <!-- BEGIN PAGE BAR -->
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{ route('dashboard.index') }}">{{ trans('message.home') }}</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>{{ trans('message.list_permissions') }}</span>
            </li>
        </ul>
    </div>
    <!-- END PAGE BAR -->
    <!-- END PAGE HEADER-->
    <div class="row">
        <div class="col-md-12">
            {{--alert success--}}
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
        @endif
        <!-- BEGIN SAMPLE TABLE PORTLET-->
            <div class="portlet">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-list-ul"></i>{{ trans('message.list_permissions') }}
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="actions">
                        {{--create--}}
                        <a href="{{ route('permissions.create') }}"
                           class="btn blue mt-ladda-btn ladda-button btn-circle">
                            {{ trans('message.btn_create') }} </a>
                    </div>
                    <div class="table-scrollable" id="table_data_permissions">
                        {{--phân trang--}}
                        @include('admin.permission.pagination_data_permission')
                    </div>
                </div>
            </div>
            <!-- END SAMPLE TABLE PORTLET-->
        </div>
    </div>
@endsection

@section('script')
    <link href="{{ asset('bower_components/demo-bower/confession/admin/assets/global/plugins/bootstrap-editable/bootstrap-editable/css/bootstrap-editable.css') }}"
          rel="stylesheet" type="text/css"/>
    <script src="{{ asset('bower_components/demo-bower/confession/admin/assets/global/plugins/bootstrap-editable/bootstrap-editable/js/bootstrap-editable.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('js/editable_name.js') }}" type="text/javascript"></script>
    <script>
        //goi ham nay o editable_name.js. Ham co chuc nang edit truc tiep o index.
        editable_name();

        //pagination
        $(document).ready(function () {
            $(document).on('click', '.pagination a', function (event) {
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                fetchData(page);
            })
        });

        function fetchData(page) {
            $.ajax({
                type: 'GET',
                url: 'permissions?page=' + page,
                success: function (data) {
                    $('#table_data_permissions').html(data);

                    // xử lý edit trực tiếp trên từng trang. Nếu không phân trang thì vứt nó ra ngoài
                    editable_name();
                }
            })
        }
    </script>
@endsection
