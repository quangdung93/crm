@extends('admin.body')
@php
    $pageName = 'Menu';
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
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-block">
                                <h4 class="sub-title">Thông tin {{ $pageName }}</h4>
                                <x-input type="text" title="Tên menu" name="name" value="{{ isset($menu) ? $menu->name : ''  }}"/>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-sm-3"></div> --}}
                </div>
                <x-submit-button :route="$routeName"/>
            </form>
        </div>
    </div>
<!-- Page-body end -->
@endsection