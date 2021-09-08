@extends('admin.body')
@php
    $pageName = 'Thương hiệu';
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
                                <x-input type="text" :title="$pageName" name="name" value="{{ $brand->name ?? '' }}"/>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-block">
                                <h4 class="sub-title">Thông tin SEO</h4>
                                <x-input type="text" title="Đường dẫn" name="slug" value="{{ $brand->slug ?? '' }}"/>
                                <x-input type="text" title="Meta title" name="meta_title" value="{{ $brand->meta_title ?? '' }}"/>
                                <x-textarea type="" title="Meta description" name="meta_description" value="{{ $brand->meta_description ?? ''  }}" />
                                <x-input type="text" title="Meta keyword" name="meta_keyword" value="{{ $brand->meta_keyword ?? '' }}"/>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-block">
                                <h4 class="sub-title">Nội dung {{ $pageName }}</h4>
                                <x-textarea type="tinymce" title="" name="content" value="{!! isset($brand) ? $brand->content : '' !!}" />
                            </div>
                        </div>
                        @if(config('stableweb.google_review'))
                            <x-google-review :model="$brand ?? ''"/>
                        @endif
                    </div>
                    <div class="col-sm-3">
                        <div class="card">
                            <div class="card-block">
                                <h4 class="sub-title">Trạng thái</h4>
                                <x-switch-box 
                                type="short" 
                                title="Trạng thái" 
                                name="status" 
                                checked="{{ !isset($brand) ? 'true' : ($brand->status ? 'true' : '') }}"/>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-block">
                                <h4 class="sub-title">Hình ảnh</h4>
                                <x-upload-file 
                                type="short"
                                title="Hình ảnh" 
                                name="image"
                                image="{{ $brand->image ?? '' }}"
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

@section('javascript')
<script type="text/javascript">
    $(document).ready(function(){
        @if(!isset($brand))
            $('input[name="name"]').on('keyup', function(){
                convert_slug($(this).val());
            });
        @endif
    });
</script>
@endsection