@extends('admin.body')
@php
    $pageName = 'Phân quyền';
    $routeName = getCurrentSlug();
@endphp
@section('title', $pageName)
@section('content')
    @include('admin.components.page-header')
    <!-- Page-body start -->
    <div class="page-body panels-wells">
        <div class="panel panel-primary">
            <div class="panel-heading bg-primary">Thêm {{ $pageName }}</div>
            <div class="panel-body">
                <form class="form-horizontal" method="post"
                    action="{{url($routeName)}}" role="form">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label text-right">Tên quyền</label>
                        <div class="col-sm-6">
                            <input type="text" name="name" class="form-control" placeholder="Nhập tên quyền" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label text-right">Tên hiển thị</label>
                        <div class="col-sm-6">
                            <input type="text" name="display_name" class="form-control" placeholder="Nhập tên hiển thị" autocomplete="off" required>
                        </div>
                    </div>
                    <x-submit-button :route="$routeName"/>
                </form>
            </div>
        </div>
    </div>
    <!-- Page-body end -->
@endsection