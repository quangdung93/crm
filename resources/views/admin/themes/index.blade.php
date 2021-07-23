@extends('admin.body')
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{asset('admin/css/menu.css')}}">
@endsection
@php
    $pageName = 'Giao diện';
    $routeName = getCurrentSlug();
@endphp
@section('title', $pageName)
@section('content')
    @include('admin.components.page-header')
    <!-- Page-body start -->
    <div class="page-body" id="themes">
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-12">
                    <h1 class="page-title">
                        <i class="feather icon-image"></i> Giao diện
                        <small>Tùy chỉnh giao diện bên dưới</small>
                    </h1>
                    <div class="card">
                        <div class="card-block">
                            <div class="row">
                                @foreach($themes as $item)
                                    <div class="col-sm-6">
                                        <div class="theme">
                                            <img class="theme-thumb img-responsive" src="{{ asset('themes/'.$item->folder.'/'.$item->image) }}">
                                            <div class="theme-details">
                                                <div class="item">
                                                    <h5>{{ $item->name }}</h5>
                                                    <span>v{{ $item->version }}</span>
                                                </div>
                                                <div class="item text-right">
                                                    <div class="btn btn-danger" data-id="{{ $item->id }}">
                                                        <i class="feather icon-trash-2"></i>
                                                    </div>
                                                    <a href="{{ url('admin/themes/edit/'. $item->id) }}" class="btn btn-info" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Sửa giao diện">
                                                        <i class="feather icon-sliders"></i>
                                                    </a>
                                                    <span class="btn btn-success"><i class="feather icon-check"></i> {{ $item->active ? 'Active' : 'Inactive' }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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