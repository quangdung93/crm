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
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-block">
                        <h4 class="sub-title">Thông tin khách hàng</h4>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label text-right font-weight-bold">Tên khách hàng</label>
                            <div class="col-sm-9 col-form-label">{{ $order->customer_name }}</div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label text-right font-weight-bold">Số điện thoại</label>
                            <div class="col-sm-9 col-form-label">{{ $order->customer_phone }}</div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label text-right font-weight-bold">Email</label>
                            <div class="col-sm-9 col-form-label">{{ $order->customer_email }}</div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label text-right font-weight-bold">Tỉnh/thành phố</label>
                            <div class="col-sm-9 col-form-label">{{ optional($order->province)->name }}</div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label text-right font-weight-bold">Quận/huyện</label>
                            <div class="col-sm-9 col-form-label">{{ optional($order->district)->name }}</div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label text-right font-weight-bold">Phường/xã</label>
                            <div class="col-sm-9 col-form-label">{{ optional($order->ward)->name }}</div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label text-right font-weight-bold">Số nhà, tên đường</label>
                            <div class="col-sm-9 col-form-label">{{ $order->customer_address }}</div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label text-right font-weight-bold">Ghi chú</label>
                            <div class="col-sm-9 col-form-label">{{ $order->note }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-block">
                        <h4 class="sub-title">Thông tin đơn hàng</h4>
                        <div class="dt-responsive table-responsive">
                            <table class="table stableweb-table center w100">
                                <thead>
                                    <tr>
                                        <th>Sản phẩm</th>
                                        <th class="text-right">Đơn giá</th>
                                        <th>Số lượng</th>
                                        <th>Thành tiền</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($order->detail)
                                        @foreach($order->detail as $row)
                                            <tr>
                                                <td class="text-left">
                                                    <img width="50" src="{{ asset($row->image) }}" alt="{{ $row->name }}">
                                                    <span>{{$row->name}}</span>
                                                </td>
                                                <td class="text-right"> {{ number_format($row->pivot->price) }} đ</td>
                                                <td> {{$row->pivot->qty}} </td>
                                                <td class="text-right">{{ number_format($row->pivot->subtotal) }} đ</td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td class="text-right" colspan="4">
                                                <span class="font-weight-bold">Tổng tiền: </span>
                                                <span class="font-weight-bold text-danger">{{ number_format($order->total) }} đ</span>
                                            </td>
                                        </tr>
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