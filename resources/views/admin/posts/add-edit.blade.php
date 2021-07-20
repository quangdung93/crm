@extends('admin.body')
@php
    $pageName = 'Bài viết';
    $routeName = getCurrentSlug();
@endphp
@section('content')
    <!-- Page-header start -->
    @include('admin.components.page-header')
    <!-- Page-header end -->

    <!-- Page-body start -->
    <div class="page-body">
        <div class="panel-body">
            @include('admin.components.alert')
            <form class="form-horizontal" action="{{url($routeName)}}" method="POST" role="form"
                enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="row">
                    <div class="col-sm-9">
                        <div class="card">
                            <div class="card-block">
                                <h4 class="sub-title">Thông tin {{ $pageName }}</h4>
                                <x-input type="text" :title="$pageName" name="title" value="{{ isset($post) ? $post->title : ''  }}"/>
                                <x-selectbox 
                                    title="Danh mục" 
                                    name="category_id" 
                                    :lists="$categories" 
                                    value="id" 
                                    display="name" 
                                    selected=""
                                />
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-block">
                                <h4 class="sub-title">Thông tin SEO</h4>
                                <x-input type="text" title="Đường dẫn" name="slug" value="{{ isset($post) ? $post->slug : ''  }}"/>
                                <x-input type="text" title="Meta title" name="seo_title" value="{{ isset($post) ? $post->seo_title : ''  }}"/>
                                <x-input type="text" title="Meta description" name="meta_description" value="{{ isset($post) ? $post->meta_description : ''  }}"/>
                                <x-input type="text" title="Meta weyword" name="meta_keywords" value="{{ isset($post) ? $post->meta_keywords : ''  }}"/>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-block">
                                <h4 class="sub-title">Nội dung {{ $pageName }}</h4>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <textarea class="tinymce" name="body">{{ isset($post) ? $post->body : '' }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card">
                            <div class="card-block">
                                <h4 class="sub-title">Trạng thái</h4>
                                <x-switch-box type="short" title="Trạng thái" name="status" checked="{{ isset($post) && $post->status ? 'true' : '' }}"/>
                            </div>
                        </div>
                        <x-upload-file title="Ảnh đại diện" width="500" height="500" image="{{ isset($post) ? $post->image : '' }}"/>
                    </div>
                </div>
                <x-submit-button :route="$routeName"/>
            </form>
        </div>
    </div>
<!-- Page-body end -->
@endsection