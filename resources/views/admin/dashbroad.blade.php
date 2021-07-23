@extends('admin.body')
@section('content')
<div class="page-body">
    <div class="row">
        <!-- task, page, download counter  start -->
        <div class="col-sm-4">
            <div class="card update-card" style="background-image:linear-gradient(to right, #6a11cb 0%, #2575fc 100%)">
                <div class="card-block">
                    <div class="row align-items-end">
                        <div class="col-8">
                            @php $now = \Carbon\Carbon::parse(now())->format('h:i'); @endphp
                            <h4 class="text-white">10</h4>
                            <h6 class="text-white m-b-0">Sản phẩm</h6>
                        </div>
                        <div class="col-4 text-right">
                            <canvas id="update-chart-1" height="50"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card update-card" style="background-image:linear-gradient(to right, #b8cbb8 0%, #b8cbb8 0%, #b465da 0%, #cf6cc9 33%, #ee609c 66%, #ee609c 100%)">
                <div class="card-block">
                    <div class="row align-items-end">
                        <div class="col-8">
                            <h4 class="text-white">20</h4>
                            <h6 class="text-white m-b-0">Bài viết</h6>
                        </div>
                        <div class="col-4 text-right">
                            <canvas id="update-chart-2" height="50"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card bg-c-pink update-card">
                <div class="card-block">
                    <div class="row align-items-end">
                        <div class="col-8">
                            <h4 class="text-white">30</h4>
                            <h6 class="text-white m-b-0">Đơn hàng</h6>
                        </div>
                        <div class="col-4 text-right">
                            <canvas id="update-chart-3" height="50"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- task, page, download counter  end -->

    </div>
</div>
@endsection