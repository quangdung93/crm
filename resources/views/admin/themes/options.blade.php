@extends('admin.body')
@php
    $pageName = 'Giao diện';
    $routeName = getCurrentSlug();
@endphp
@section('title', $pageName)
@section('content')
    @include('admin.components.page-header')
    <!-- Page-body start -->
    <div class="page-body">
        <div class="panel-body">
            <form class="form-horizontal" action="{{url($routeName)}}" method="POST" role="form"
                enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <ul class="nav nav-tabs md-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#tab1" role="tab" aria-expanded="true">
                            <i class="feather icon-settings"></i> Cấu hình chung
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#tab2" role="tab">
                            <i class="feather icon-flag"></i> Trang chủ
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#tab3" role="tab">
                            <i class="feather icon-grid"></i> Chi tiết sản phẩm
                        </a>
                    </li>
                </ul>

                <div class="tab-content card-block p-0">
                    <div class="tab-pane active" id="tab1" role="tabpanel" aria-expanded="true">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-block">
                                        <h4 class="sub-title">Cấu hình chung</h4>
                                        <x-input 
                                        type="text" 
                                        title="Logo" 
                                        name="home_headline" 
                                        value="{{ $themeOptions['home_headline'] }}" />
                                        <x-input 
                                        type="text" 
                                        title="Mô tả trang chủ" 
                                        name="home_description" 
                                        value="{{ $themeOptions['home_description'] }}" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab2" role="tabpanel">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-block">
                                        <h4 class="sub-title">Trang chủ</h4>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab3" role="tabpanel">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-block">
                                        <h4 class="sub-title">Chi tiết sản phẩm</h4>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12 text-center">
                        <button type="submit" class="btn btn-primary btn-label-left">
                            <span><i class="feather icon-save"></i></span>
                            Lưu cài đặt
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<!-- Page-body end -->
@endsection

@section('javascript')
<script>
    $(document).ready(function(){
        
    });
</script>
@endsection