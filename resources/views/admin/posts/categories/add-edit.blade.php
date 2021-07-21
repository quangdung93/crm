@extends('admin.body')
@php
    $pageName = 'Danh mục bài viết';
    $routeName = getCurrentSlug();
@endphp
@section('content')
    @include('admin.components.page-header')
    <!-- Page-body start -->
    <div class="page-body">
        <div class="panel-body">
            <form class="form-horizontal" action="{{url($routeName)}}" method="POST" role="form"
                enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="row">
                    <div class="col-sm-9">
                        <div class="card">
                            <div class="card-block">
                                <h4 class="sub-title">Thông tin {{ $pageName }}</h4>
                                <x-input type="text" title="Tên danh mục" name="name" value="{{ isset($postCategory) ? $postCategory->name : ''  }}"/>
                                @if(isset($postCategory))
                                    <x-input type="text" title="Đường dẫn" name="slug" value="{{ isset($postCategory) ? $postCategory->slug : ''  }}"/>
                                    <x-switch-box type="long" title="Trạng thái" name="status" checked="{{ isset($postCategory) && $postCategory->status ? 'true' : '' }}"/>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        {{-- <x-upload-file title="Ảnh đại diện" width="500" height="500" image="{{ isset($user) ? $user->avatar : '' }}"/> --}}
                    </div>
                </div>
                <x-submit-button :route="$routeName"/>
            </form>
        </div>
    </div>
<!-- Page-body end -->
@endsection