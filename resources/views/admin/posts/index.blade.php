@extends('admin.body')
@php
    $pageName = 'bài viết';
    $routeName = 'posts';
@endphp
@section('content')
<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <!-- Main-body start -->
        <div class="main-body">
            <div class="page-wrapper">
                <!-- Page-header start -->
                <div class="page-header">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="page-header-breadcrumb">
                                <ul class="breadcrumb-title">
                                    <li class="breadcrumb-item">
                                        <a href="{{url('/admin')}}"> <i class="feather icon-home"></i> </a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{url('admin/'.$routeName)}}">Danh sách {{ $pageName }}</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Page-header end -->

                <!-- Page-body start -->
                <div class="page-body">
                    <div class="row ">
                        <div class="col-sm-12">
                            <div class="text-right mb-20">
                                <a href="{{url('hita_enterprise/'.$routeName.'/create')}}" class="btn btn-primary"><i
                                        class="feather icon-plus"></i> Thêm mới</a>
                            </div>
                        </div>
                        <div class="col-sm-12 mt-2">
                            <div class="panel panel-primary">
                                <div class="panel-heading bg-primary">Danh sách {{ $pageName }}</div>
                                <div class="panel-body p-2">
                                    <div class="dt-responsive table-responsive">
                                        <table id="datatable" class="table table-striped table-bordered w100">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>{{ $pageName }}</th>
                                                    <th>Danh mục</th>
                                                    <th>Hình ảnh</th>
                                                    <th>Ngày tạo</th>
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
            </div>
        </div>
        <!-- Main-body end -->
    </div>
</div>

@endsection

@section('javascript')
<script type="text/javascript">
    $(document).ready(function(){
        const ajax_url = "{!! route('posts.view') !!}";
        var columns = [
            { data: 'id',name: 'id',width: '5%'},
            { data: 'title',name: 'title',width: '25%'},
            { data: 'category_id',name: 'category_id'},
            { data: 'image',name: 'image',orderable: false, searchable: false},
            { data: 'created_at',name: 'created_at', searchable: false},
            { data: 'status',name: 'status', searchable: false},
            { data: 'action',orderable: false, searchable: false, className: 'nowrap'}
        ];

        showDataTableServerSide($('#datatable'), ajax_url, columns);

        $(document).on('change', '#view-type', function(){
            var value = $(this).is(':checked');
            if(value){
                showTable(url_news_in_trash);
            }
            else{
                showTable(all_url);
            }
        })
    });
</script>
@endsection