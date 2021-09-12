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
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-block">
                        <h4 class="sub-title">Thông tin khách hàng</h4>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label text-right font-weight-bold">Tên khách hàng</label>
                            <div class="col-sm-9 col-form-label">{{ $customer->name }}</div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label text-right font-weight-bold">Số điện thoại</label>
                            <div class="col-sm-9 col-form-label">{{ $customer->phone }}</div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label text-right font-weight-bold">Loại đăng ký</label>
                            <div class="col-sm-9 col-form-label">{{ $customer->type }}</div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label text-right font-weight-bold">Ghi chú</label>
                            <div class="col-sm-9 col-form-label">{{ $customer->note }}</div>
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