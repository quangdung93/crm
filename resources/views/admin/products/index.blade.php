@extends('admin.body')
@php
    $pageName = 'Sản phẩm';
    $routeName = getCurrentSlug();
@endphp
@section('title', $pageName)
@section('content')
    @include('admin.components.page-header')
    <!-- Page-body start -->
    <div class="page-body">
        <div class="row ">
            <div class="col-sm-12">
                @can('add_products')
                    <div class="text-left mb-3">
                        <a href="{{url($routeName.'/create')}}" class="btn btn-primary"><i
                                class="feather icon-plus"></i> Thêm mới</a>
                    </div>
                @endcan
            </div>
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-block">
                        <h4 class="sub-title">{{ $pageName }}</h4>
                        <div class="dt-responsive table-responsive">
                            <table id="datatable" class="table stableweb-table center w100">
                                <thead>
                                    <tr>
                                        <th>Hình ảnh</th>
                                        <th>{{ $pageName }}</th>
                                        <th>Danh mục</th>
                                        <th>Thương hiệu</th>
                                        <th>Giá bán</th>
                                        <th>Giảm giá</th>
                                        <th>Trạng thái</th>
                                        <th>Thao tác</th>
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
        const ajax_url = "{!! route('products.view') !!}";
        var columns = [
            { data: 'image',name: 'image',orderable: false, searchable: false},
            { data: 'name',name: 'name',width: '25%'},
            { data: 'categories',name: 'categories'},
            { data: 'brand_id',name: 'brand_id'},
            { data: 'price',name: 'price', className: 'nowrap'},
            { data: 'discount',name: 'discount'},
            { data: 'status',name: 'status', searchable: false, className: 'nowrap'},
            { data: 'action',orderable: false, searchable: false, className: 'nowrap'}
        ];

        showDataTableServerSide($('#datatable'), ajax_url, columns);
    });
</script>
@endsection