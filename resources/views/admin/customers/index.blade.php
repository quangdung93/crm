@extends('admin.body')
@php
    $pageName = 'Khách hàng';
    $routeName = getCurrentSlug();
@endphp
@section('title', $pageName)
@section('content')
<section class="app-user-list">
    <div class="col-sm-12">
        <div class="text-right mb-2">
            <a href="{{ route('customers.add') }}" class="btn btn-primary"><i data-feather="plus" class="font-medium-2 mr-1"></i> Thêm mới</a>
        </div>
    </div>
    <div class="card">
        <div class="card-datatable table-responsive">
            <table class="datatable-customer table">
                <thead class="thead-light">
                    <tr>
                        <th>Mã KH</th>
                        <th>Tên KH</th>
                        <th>Ngày bán</th>
                        <th>Ngày chăm sóc</th>
                        <th>Nhân viên</th>
                        <th>Bán hàng</th>
                        <th>Chỉnh sửa</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</section>
@endsection

@section('javascript')
<script type="text/javascript">
    $(document).ready(function(){
        const ajax_url = "{!! route('customers.view') !!}";
        var columns = [
            { data: 'customer_code',name: 'customer_code',orderable: false, searchable: false},
            { data: 'name',name: 'name',width: '25%'},
            { data: 'joindate',name: 'joindate'},
            { data: 'customer_date',name: 'customer_date'},
            { data: 'created_by',name: 'created_by'},
            { data: 'sale', orderable: false, searchable: false, className: 'nowrap'},
            { data: 'action',orderable: false, searchable: false, className: 'nowrap'}
        ];

        showDataTableServerSide($('.datatable-customer'), ajax_url, columns);
    });
</script>
@endsection