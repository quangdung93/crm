@extends('admin.body')
@php
    $pageName = 'Nhật ký quản trị';
    $routeName = getCurrentSlug();
@endphp
@section('title', $pageName)
@section('content')
    @include('admin.components.page-header')
    <!-- Page-body start -->
    <div class="page-body">
        <div class="row ">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-block">
                        <h4 class="sub-title">{{ $pageName }}</h4>
                        <div class="dt-responsive table-responsive">
                            <table id="datatable" class="table stableweb-table center w100">
                                <thead>
                                    <tr>
                                        <th>Người dùng</th>
                                        <th>Hành động</th>
                                        <th>Loại</th>
                                        <th>Tiêu đề</th>
                                        <th>Địa chỉ IP</th>
                                        <th>Thời gian</th>
                                        <th>Xem chi tiết</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page-body end -->
@endsection

@section('javascript')
<script type="text/javascript">
    $(document).ready(function(){
        const ajax_url = "{!! route('logs.view') !!}";
        var columns = [
            { data: 'user_id',name: 'user_id'},
            { data: 'action',name: 'action'},
            { data: 'logable_type',name: 'logable_type', className: 'nowrap'},
            { data: 'title',name: 'title', searchable: false, width: '25%'},
            { data: 'ip',name: 'ip'},
            { data: 'created_at',name: 'created_at'},
            { data: 'action_btn',name: 'action_btn'},
        ];

        showDataTableServerSide($('#datatable'), ajax_url, columns);
    });
</script>
@endsection