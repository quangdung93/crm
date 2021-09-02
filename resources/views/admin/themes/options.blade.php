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
                        <div class="row mt-3">
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-block">
                                        <h4 class="sub-title">Cấu hình chung</h4>
                                        <x-input 
                                            type="text" 
                                            title="Logo" 
                                            name="home_headline" 
                                            value="{{ $themeOptions['home_headline'] }}" 
                                        />
                                        <x-textarea 
                                            type="" 
                                            title="Mô tả trang chủ" 
                                            name="home_description" 
                                            value="{{ $themeOptions['home_description'] }}" 
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab2" role="tabpanel">
                        <div class="row mt-3">
                            {{-- Section 1 --}}
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-block">
                                        <h4 class="sub-title">Section 1 (Banner)</h4>
                                        <x-input 
                                            type="text" 
                                            title="Tiêu đề banner" 
                                            name="home_banner_title" 
                                            value="" 
                                        />
                                        <x-textarea 
                                            type="" 
                                            title="Nội dung banner" 
                                            name="home_banner_content" 
                                            value="" 
                                        />
                                        <x-input 
                                            type="text" 
                                            title="Đường dẫn" 
                                            name="home_banner_link" 
                                            value="" 
                                        />
                                        <x-upload-file
                                            type="long"
                                            title="Ảnh banner" 
                                            name="home_banner_image"
                                            image=""
                                            width="100px" 
                                            note="(600px x 600px)"
                                        />
                                    </div>
                                </div>
                            </div>

                            {{-- Section 2 --}}
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-block">
                                        <h4 class="sub-title">Section 2 (Slider sản phẩm)</h4>
                                        <x-selectbox 
                                            title="Chọn danh mục" 
                                            name="home_section_2" 
                                            :lists="$categories" 
                                            value="id" 
                                            display="name" 
                                            selected="{{ isset($category) ? $category->father_id : '' }}"
                                        />
                                    </div>
                                </div>
                            </div>

                            {{-- Section 3 --}}
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-block">
                                        <h4 class="sub-title">Section 3 (Banner Ảnh)</h4>
                                        <x-upload-file
                                            type="long"
                                            title="Ảnh banner" 
                                            name="home_section_3_image"
                                            image=""
                                            width="100px" 
                                            note="(1000px x 185px)"
                                        />
                                        <x-input 
                                            type="text" 
                                            title="Đường dẫn" 
                                            name="home_section_3_link" 
                                            value="" 
                                        />
                                    </div>
                                </div>
                            </div>

                            {{-- Section 4 --}}
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-block">
                                        <h4 class="sub-title">Section 4 (Slider sản phẩm)</h4>
                                        <x-selectbox 
                                            title="Chọn danh mục" 
                                            name="home_section_4" 
                                            :lists="$categories" 
                                            value="id" 
                                            display="name" 
                                            selected="{{ isset($category) ? $category->father_id : '' }}"
                                        />
                                    </div>
                                </div>
                            </div>

                            {{-- Section 5 --}}
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-block">
                                        <h4 class="sub-title">Section 5 (Slider sản phẩm)</h4>
                                        <x-selectbox 
                                            title="Chọn danh mục" 
                                            name="home_section_5" 
                                            :lists="$categories" 
                                            value="id" 
                                            display="name" 
                                            selected="{{ isset($category) ? $category->father_id : '' }}"
                                        />
                                    </div>
                                </div>
                            </div>

                            {{-- Section 5 --}}
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-block">
                                        <h4 class="sub-title">Section 6 (Youtube)</h4>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label text-right">Youtube</label>
                                            <div class="col-sm-9">
                                                <div class="input-wrap">
                                                    <div class="input-block">
                                                        <div class="input-item">
                                                            <input type="text" 
                                                            name="home_section_6[]"
                                                            placeholder="Nhập link youtube" 
                                                            data-toggle="tooltip" 
                                                            data-placement="bottom"
                                                            data-original-title="Nhập link youtube"
                                                            class="form-control"/>
                                                        </div>
                                                    </div>
                                                    <div class="text-left mt-3">
                                                        <a href="#" class="btn btn-primary btn-add-input" data-name="home_section_6"><i class="feather icon-plus"></i> Thêm</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                    <div class="tab-pane" id="tab3" role="tabpanel">
                        <div class="row mt-3">
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
        $(document).on('click', '.btn-add-input', function(e){
            e.preventDefault();
            let name = $(this).data('name');
            let html = renderInput(name);
            $(this).closest('.input-wrap').find('.input-block').append(html);
        });

        $(document).on('click', '.input-item .remove', function(){
            $(this).closest('.input-item').remove();
        });

        function renderInput(name){
            return `<div class="input-item mt-2 d-flex">
                <input type="text" 
                name="${name}[]"
                value=""
                placeholder="Nhập link youtube" 
                data-toggle="tooltip" 
                data-placement="bottom"
                data-original-title="Nhập link youtube"
                class="form-control"/>
                <div class="btn btn-danger ml-2 remove"><i class="feather icon-trash-2"></i></div>
            </div>`;
        }
    });
</script>
@endsection