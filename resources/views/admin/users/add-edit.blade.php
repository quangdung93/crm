@extends('admin.body')
@php
    $pageName = 'Người dùng';
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
                <div class="row">
                    <div class="col-sm-9">
                        <div class="card">
                            <div class="card-block">
                                <h4 class="sub-title">Thông tin {{ $pageName }}</h4>
                                <x-input type="text" :title="$pageName" name="name" value="{{ isset($user) ? $user->name : ''  }}"/>
                                <x-input type="text" title="Username" name="username" value="{{ isset($user) ? $user->username : ''  }}"/>
                                <x-input type="text" title="Email" name="email" value="{{ isset($user) ? $user->email : ''  }}"/>
                                <x-input type="password" title="Mật khẩu" name="password" value=""/>
                                <x-selectbox 
                                    title="Quyền" 
                                    name="role" 
                                    :lists="$roles" 
                                    value="name" 
                                    display="display_name" 
                                    selected="{{ isset($user) ? optional($user->roles->first())->name : ''}}"
                                />
                                <x-switch-box 
                                type="long" 
                                title="Kích hoạt" 
                                name="status" 
                                checked="{{ !isset($user) ? 'true' : ($user->status ? 'true' : '') }}"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card">
                            <div class="card-block">
                                <h4 class="sub-title">Ảnh đại diện</h4>
                                <x-upload-file 
                                type="short"
                                title="Ảnh đại diện" 
                                name="input_file"
                                image="{{ isset($user) ? $user->avatar : '' }}"
                                width="100%"/>
                            </div>
                        </div>
                    </div>
                </div>
                <x-submit-button :route="$routeName"/>
            </form>
        </div>
    </div>
<!-- Page-body end -->
@endsection