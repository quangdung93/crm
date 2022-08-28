@extends('admin.body')
@php
    $pageName = 'Khách hàng';
    $routeName = getCurrentSlug();
@endphp
@section('title', $pageName)
@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-6">
        <div class="row breadcrumbs-top">
        <div class="col-12">
            <h2 class="content-header-title float-left mb-0">Thông tin khách hàng</h2>
            <div class="breadcrumb-wrapper">
                {{-- <ol class="breadcrumb">
        
                        <li class="breadcrumb-item">
                                <a href="https://vuexy.test">
                                        Home
                                    </a>
                            </li>
                        <li class="breadcrumb-item">
                                <a href="javascript:void(0)">
                                        Pages
                                    </a>
                            </li>
                        <li class="breadcrumb-item">
                                <a href="javascript:void(0)">
                                        Blog
                                    </a>
                            </li>
                        <li class="breadcrumb-item">
                                    Edit
                                </li>
                    </ol> --}}
            </div>
        </div>
        </div>
    </div>
    <div class="content-header-right text-md-right col-md-6 d-md-block d-none">
        <div class="form-group breadcrumb-right">
        <a href="#" class="btn-icon btn btn-primary btn-round"><i data-feather="shopping-cart"></i> <span>Đặt hàng</span></a>
        <a href="#" data-toggle="modal" data-target="#modal-customer-care" class="btn-icon btn btn-primary btn-round"><i data-feather="plus"></i> <span>Tạo chăm sóc</span></a>
        <a href="{{ url('admin/customers/edit/'.$customer->id) }}" class="btn-icon btn btn-primary btn-round"><i data-feather="edit"></i> <span>Sửa</span></a>
    </div>
    </div>
</div>
<section class="app-user-edit">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label text-right font-weight-bold">Tên khách hàng</label>
                        <div class="col-sm-8 col-form-label">{{ $customer->name }}</div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label text-right font-weight-bold">Số điện thoại</label>
                        <div class="col-sm-8 col-form-label">{{ $customer->phone }}</div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label text-right font-weight-bold">Giới tính</label>
                        <div class="col-sm-8 col-form-label">{{ $customer->gender ? 'Nữ' : 'Nam' }}</div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label text-right font-weight-bold">Nhóm khách hàng</label>
                        <div class="col-sm-8 col-form-label">{{ $customer->customer_group ? 'Khách lẻ' : 'Khách sỉ' }}</div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label text-right font-weight-bold">Điểm tích lũy</label>
                        <div class="col-sm-8 col-form-label">{{ $points }}</div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label text-right font-weight-bold">Địa chỉ</label>
                        <div class="col-sm-8 col-form-label">{{ $customer->address }}</div>
                    </div>
                    @if($points > 0)
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label text-right font-weight-bold">Số điểm tích lũy trừ</label>
                        <div class="col-sm-8 col-form-label">
                            <input class="form-control" type="number" value="" placeholder="Nhập số điểm tích lũy trừ" id="minus-points"/>
                            <a href="#" class="btn btn-primary mt-1">Xác nhận</a>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="col-sm-6">
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label text-right font-weight-bold">Mã khách hàng</label>
                        <div class="col-sm-8 col-form-label">{{ $customer->customer_code }}</div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label text-right font-weight-bold">Email</label>
                        <div class="col-sm-8 col-form-label">{{ $customer->email ?: '(Chưa có)' }}</div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label text-right font-weight-bold">Ngày sinh</label>
                        <div class="col-sm-8 col-form-label">{{ is_numeric($customer->birthday) ? Carbon\Carbon::parse((int)$customer->birthday)->format('d/m/Y') : $customer->birthday }}</div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label text-right font-weight-bold">Ghi chú</label>
                        <div class="col-sm-8 col-form-label">{{ $customer->note ?: '(Chưa có)' }}</div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label text-right font-weight-bold">Loại thành viên</label>
                        <div class="col-sm-8 col-form-label">{{ $typeCustomer }}</div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label text-right font-weight-bold">Tình trạng da</label>
                        <div class="col-sm-8 col-form-label">{{ $customer->note_skin }}</div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label text-right font-weight-bold">Tích cách</label>
                        <div class="col-sm-8 col-form-label">{{ $customer->note_genitive }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header border-bottom">
            <h4 class="card-title">Lịch sử mua hàng</h4>
        </div>
        <div class="card-datatable table-responsive p-2">
            <table class="datatable-orders table">
                <thead class="thead-light">
                    <tr>
                        <th>Mã đơn hàng</th>
                        <th>Kho xuất</th>
                        <th>Ngày bán</th>
                        <th>Thua ngân</th>
                        <th>Khách hàng</th>
                        <th>Tổng SL</th>
                        <th>Tổng tiền</th>
                        <th>Hình thức</th>
                        <th>Trạng thái</th>
                    </tr>
                </thead>
                <tbody>
                    @if(!empty($orders))
                        @foreach($orders as $row)
                            <tr>
                                <td><a href="#" class="btn-detail-order" data-id="{{$row->id}}" data-code="{{$row->code}}" data-toggle="modal" data-target="#modal-order-detail">{{$row->code}}</a></td>
                                <td>{{$row->store_id}}</td>
                                <td>{{format_date($row->created_at)}}</td>
                                <td>{{optional($row->user)->name}}</td>
                                <td>{{optional($row->customer)->name}}</td>
                                <td>{{$row->total_quantity}}</td>
                                <td>{{number_format($row->total_price)}}</td>
                                <td>
                                    @if($row->payment_method == 1)
                                        <span class="badge badge-pill badge-light-success">Tiền mặt</span>
                                    @else
                                    <span class="badge badge-pill badge-light-success">Chuyển khoản</span>
                                    @endif
                                </td>
                                <td>
                                    @if($row->status == 0)
                                        <span class="badge badge-pill badge-light-primary">Khởi tạo</span>
                                    @elseif($row->status == 1)
                                        <span class="badge badge-pill badge-light-success">Hoàn thành</span>
                                    @elseif($row->status == 3)
                                        <span class="badge badge-pill badge-light-danger">Đang giao</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    <div class="card">
        <div class="card-header border-bottom">
            <h4 class="card-title">Lịch sử chăm sóc</h4>
        </div>
        <div class="card-datatable table-responsive p-2">
            <table class="datatable-orders table">
                <thead class="thead-light">
                    <tr>
                        <th>STT</th>
                        <th>Công việc</th>
                        <th>Ghi chú</th>
                        <th>Ngày tạo</th>
                        <th>Người tạo</th>
                    </tr>
                </thead>
                <tbody>
                    @if(!empty($customerCares))
                        @foreach($customerCares as $row)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    @if($row->task == 'phone')
                                    <span class="badge badge-pill badge-light-success">Gọi điện</span>
                                    @elseif($row->task == 'message')
                                    <span class="badge badge-pill badge-light-info">Nhắn tin</span>
                                    @elseif($row->task == 'advise')
                                    <span class="badge badge-pill badge-light-danger">Tư vấn</span>
                                    @endif
                                </td>
                                <td>{{$row->note}}</td>
                                <td>{{format_date($row->created_at, 'd-m-Y h:i')}}</td>
                                <td>{{optional($row->user)->name}}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</section>

<div class="modal fade" id="modal-order-detail">
    <div class="modal-dialog" role="document" style="max-width: 80%">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Chi tiết đơn hàng <span id="order-code"></span></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-customer-care">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tạo chăm sóc khách hàng <span id="order-code"></span></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <form class="form-validate" action="{{url(route('customers.care'))}}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="customer_id" value="{{ $customer->id }}">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <x-selectbox 
                                    title="Công việc" 
                                    name="task" 
                                    :lists="[
                                        [
                                            'id' => 'phone',
                                            'name' => 'Gọi điện',
                                        ],
                                        [
                                            'id' => 'message',
                                            'name' => 'Nhắn tin',
                                        ],
                                        [
                                            'id' => 'advise',
                                            'name' => 'Tư vấn',
                                        ]
                                    ]" 
                                    value="id" 
                                    display="name" 
                                    selected=""
                                />
                            </div>
                            <div class="col-sm-12">
                                <x-textarea type="" title="Ghi chú" name="note" value="" />
                            </div>
                            <div class="col-12 d-flex flex-sm-row justify-content-end flex-column mt-2">
                                <button type="reset" class="btn btn-outline-secondary mr-sm-1">Hủy bỏ</button>
                                <button type="submit" class="btn btn-primary mb-1 mb-sm-0 mr-0">Lưu</button>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('javascript')
<script src="{{ asset('app-assets/js/scripts/tables/table-datatables-advanced.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function(){
        showDefaultDatatable($('.datatable-orders'));

        $(document).on('click', '.btn-detail-order', function(){
            let order_id = $(this).data('id');
            let order_code = $(this).data('code');

            if(!order_id){
                return;
            }

            $.get(`${URL_MAIN}admin/orders/detail/${order_id}`, {}, function(response){
                if(response.error == 0){
                    $('#order-code').text(order_code);
                    $('#modal-order-detail .modal-body').html(response.data);
                }
            });
        });
    });
</script>
@endsection