@extends('admin.body')
@php
    $pageName = 'Đơn hàng';
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
                                        <th>Mã đơn</th>
                                        <th>Tên khách hàng</th>
                                        <th>Điện thoại</th>
                                        <th>Khu vực</th>
                                        <th>Ngày tạo</th>
                                        <th>Tổng tiền</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($orders)
                                        @foreach($orders as $row)
                                            <tr>
                                                <td> {{$row->id}} </td>
                                                <td> {{$row->customer_name}} </td>
                                                <td> {{$row->customer_phone}} </td>
                                                <td> {{optional($row->province)->name}} </td>
                                                <td>{{ format_date($row->created_at) }}</td>
                                                <td>{{ number_format($row->total) }} đ</td>
                                                <td>
                                                    <a class="btn btn-success" href="/admin/orders/detail/{{ $row->id }}" title="Xem chi tiết"> <i class="feather icon-eye"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
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
</script>
@endsection