@extends('admin.body')
@php
    $pageName = 'Danh mục';
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
                                <x-input type="text" :title="$pageName" name="name" value="{{ isset($category) ? $category->name : ''  }}"/>
                                <x-selectbox 
                                    title="Danh mục cha" 
                                    name="father_id" 
                                    :lists="$categories" 
                                    value="id" 
                                    display="name" 
                                    selected="{{ isset($category) ? $category->father_id : '' }}"
                                />
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-block">
                                <h4 class="sub-title">Thông tin SEO</h4>
                                <x-input type="text" title="Đường dẫn" name="slug" value="{{ isset($category) ? $category->slug : ''  }}"/>
                                <x-input type="text" title="Meta title" name="meta_title" value="{{ isset($category) ? $category->meta_title : ''  }}"/>
                                <x-input type="text" title="Meta description" name="meta_description" value="{{ isset($category) ? $category->meta_description : ''  }}"/>
                                <x-input type="text" title="Meta keyword" name="meta_keyword" value="{{ isset($category) ? $category->meta_keyword : ''  }}"/>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-block">
                                <h4 class="sub-title">Nội dung {{ $pageName }}</h4>
                                <x-textarea type="tinymce" title="" name="content" value="{!! isset($category) ? $category->content : '' !!}" />
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card">
                            <div class="card-block">
                                <h4 class="sub-title">Trạng thái</h4>
                                <x-switch-box 
                                type="short" 
                                title="Trạng thái" 
                                name="status" 
                                checked="{{ !isset($category) ? 'true' : ($category->status ? 'true' : '') }}"/>
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

        @if(!isset($category))
            $('input[name="name"]').on('keyup', function(){
                convert_slug($(this).val());
            });
        @endif
    });
</script>
@endsection