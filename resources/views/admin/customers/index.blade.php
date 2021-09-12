@extends('admin.body')
@php
    $pageName = 'Khách hàng';
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
                                        <th>Tên khách hàng</th>
                                        <th>Điện thoại</th>
                                        <th>Ghi chú</th>
                                        <th>Loại đăng ký</th>
                                        <th>Ngày đăng ký</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($customers)
                                        @foreach($customers as $row)
                                            <tr>
                                                <td> {{$row->name}} </td>
                                                <td> {{$row->phone}} </td>
                                                <td> {{$row->note}} </td>
                                                <td> {{$row->type}} </td>
                                                <td>{{ format_date($row->created_at) }}</td>
                                                <td>
                                                    <a class="btn btn-success" href="/admin/customers/detail/{{ $row->id }}" title="Xem chi tiết"> <i class="feather icon-eye"></i></a>
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