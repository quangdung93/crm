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
                                            name="home_banner[title]" 
                                            value="{{ theme('home_banner.title') }}" 
                                        />
                                        <x-textarea 
                                            type="" 
                                            title="Nội dung banner" 
                                            name="home_banner[content]" 
                                            value="{{ theme('home_banner.content') }}" 
                                        />
                                        <x-input 
                                            type="text" 
                                            title="Đường dẫn" 
                                            name="home_banner[link]" 
                                            value="{{ theme('home_banner.link') }}" 
                                        />
                                        <input type="hidden" name="home_banner[image]" value="{{ theme('home_banner.image') }}" />
                                        <x-upload-file
                                            type="long"
                                            title="Ảnh banner" 
                                            name="home_banner[image]"
                                            image="{{ theme('home_banner.image') }}"
                                            width="200px" 
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
                                            selected="{{ theme('home_section_2') }}"
                                        />
                                    </div>
                                </div>
                            </div>

                            {{-- Section 3 --}}
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-block">
                                        <h4 class="sub-title">Section 3 (Banner Ảnh)</h4>
                                        <input type="hidden" name="home_section_3[image]" value="{{ theme('home_section_3.image') }}" />
                                        <x-upload-file
                                            type="long"
                                            title="Ảnh banner" 
                                            name="home_section_3[image]"
                                            image="{{ theme('home_section_3.image') }}"
                                            width="500px" 
                                            note="(1000px x 185px)"
                                        />
                                        <x-input 
                                            type="text" 
                                            title="Đường dẫn" 
                                            name="home_section_3[link]" 
                                            value="{{ theme('home_section_3.link') }}" 
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
                                            title="Danh mục" 
                                            name="home_section_4" 
                                            :lists="$categories" 
                                            value="id" 
                                            display="name" 
                                            selected="{{ theme('home_section_4') }}"
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
                                            title="Danh mục" 
                                            name="home_section_5" 
                                            :lists="$categories" 
                                            value="id" 
                                            display="name" 
                                            selected="{{ theme('home_section_5') }}"
                                        />
                                    </div>
                                </div>
                            </div>

                            {{-- Section youtube --}}
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-block">
                                        <h4 class="sub-title">Section (Youtube)</h4>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label text-right">Youtube</label>
                                            <div class="col-sm-9">
                                                <div class="input-wrap">
                                                    <div class="input-block">
                                                        @php
                                                            $listYoutube = theme('home_section_youtube');
                                                        @endphp
                                                        @if($listYoutube)
                                                            @foreach($listYoutube as $youtube)
                                                                <div class="input-item mt-3 d-flex">
                                                                    <input type="text mr-2" 
                                                                    name="home_section_youtube[]"
                                                                    placeholder="Nhập link youtube" 
                                                                    data-toggle="tooltip" 
                                                                    data-placement="bottom"
                                                                    data-original-title="Nhập link youtube"
                                                                    value="{{ $youtube }}"
                                                                    class="form-control"/>
                                                                    <div class="btn btn-danger ml-2 remove"><i class="feather icon-trash-2"></i></div>
                                                                </div>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                    <div class="text-left mt-3">
                                                        <a href="#" class="btn btn-primary btn-add-input" data-name="home_section_youtube"><i class="feather icon-plus"></i> Thêm</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Section 6 --}}
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-block">
                                        <h4 class="sub-title">Section 6 (Giải pháp đầu nguồn)</h4>
                                        @for($i = 1; $i <= 3; $i++)
                                            <input type="hidden" name="home_section_6_{{ $i }}[image]" value="{{ theme('home_section_6_'.$i.'.image') }}" />
                                            <x-upload-file
                                                type="long"
                                                title="Hình ảnh" 
                                                name="home_section_6_{{ $i }}[image]"
                                                image="{{ theme('home_section_6_'.$i.'.image') }}"
                                                width="150px" 
                                                note="(500px x 500px)"
                                            />
                                            <x-input 
                                                type="text" 
                                                title="Đường dẫn" 
                                                name="home_section_6_{{ $i }}[link]" 
                                                value="{{ theme('home_section_6_'.$i.'.link') }}" 
                                            />
                                            <hr>
                                        @endfor
                                    </div>
                                </div>
                            </div>


                            {{-- Section 7 --}}
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-block">
                                        <h4 class="sub-title">Section 7 (Sản phẩm nổi bật)</h4>
                                        @for($i = 1; $i <= 2; $i++)
                                            <x-input 
                                                type="text" 
                                                title="Tiêu đề SP" 
                                                name="home_section_7_{{ $i }}[title]" 
                                                value="{{ theme('home_section_7_'.$i.'.title') }}" 
                                            />
                                            <input 
                                                type="hidden" 
                                                name="home_section_7_{{ $i }}[image]" 
                                                value="{{ theme('home_section_7_'.$i.'.image') }}" 
                                            />
                                            <x-upload-file
                                                type="long"
                                                title="Ảnh SP" 
                                                name="home_section_7_{{ $i }}[image]"
                                                image="{{ theme('home_section_7_'.$i.'.image') }}"
                                                width="150px" 
                                                note="(550px x 550px)"
                                            />
                                            <x-input 
                                                type="text" 
                                                title="Đường dẫn SP" 
                                                name="home_section_7_{{ $i }}[link]" 
                                                value="{{ theme('home_section_7_'.$i.'.link') }}"
                                            />
                                            <x-textarea 
                                                type="" 
                                                title="Nội dung SP" 
                                                name="home_section_7_{{ $i }}[content]" 
                                                value="{{ theme('home_section_7_'.$i.'.content') }}"
                                            />
                                            <input 
                                                type="hidden" 
                                                name="home_section_7_{{ $i }}[logo]" 
                                                value="{{ theme('home_section_7_'.$i.'.logo') ?: '' }}" 
                                            />
                                            <x-upload-file
                                                type="long"
                                                title="Logo SP" 
                                                name="home_section_7_{{ $i }}[logo]"
                                                image="{{ theme('home_section_7_'.$i.'.logo') ?: '' }}"
                                                width="200px" 
                                                note="(200px x 70px)"
                                            />
                                            <hr>
                                        @endfor
                                    </div>
                                </div>
                            </div>

                            {{-- Section 8 --}}
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-block">
                                        <h4 class="sub-title">Section 8 (Banner Ảnh)</h4>
                                        <x-upload-file
                                            type="long"
                                            title="Ảnh banner" 
                                            name="home_section_8[image]"
                                            image="{{ theme('home_section_8.image') }}"
                                            width="500px" 
                                            note="(1000px x 185px)"
                                        />
                                        <x-input 
                                            type="text" 
                                            title="Đường dẫn" 
                                            name="home_section_8[link]" 
                                            value="{{ theme('home_section_8.link') }}" 
                                        />
                                    </div>
                                </div>
                            </div>

                            {{-- Section 10 --}}
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-block">
                                        <h4 class="sub-title">Section 10 (Call to action)</h4>
                                        <x-input 
                                            type="text" 
                                            title="Tiêu đề" 
                                            name="home_section_10[title]" 
                                            value="{{ theme('home_section_10.title') }}" 
                                        />
                                        <x-input 
                                            type="text" 
                                            title="Tiêu đề phụ" 
                                            name="home_section_10[subtitle]" 
                                            value="{{ theme('home_section_10.subtitle') }}" 
                                        />
                                        <x-input 
                                            type="text" 
                                            title="Đường dẫn" 
                                            name="home_section_10[link]" 
                                            value="{{ theme('home_section_10.link') }}" 
                                        />
                                    </div>
                                </div>
                            </div>

                            {{-- Section 11 --}}
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-block">
                                        <h4 class="sub-title">Section 11 (Lợi ích)</h4>
                                        @for($i = 0; $i <= 4; $i++)
                                            <x-input 
                                                type="text" 
                                                title="Icon" 
                                                name="home_section_11[{{ $i }}][icon]" 
                                                value="" 
                                            />
                                            <x-textarea 
                                                type="" 
                                                title="Nội dung" 
                                                name="home_section_11[{{ $i }}][content]" 
                                                value="" 
                                            />
                                            <hr>
                                        @endfor
                                    </div>
                                </div>
                            </div>

                            {{-- Section 12 --}}
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-block">
                                        <h4 class="sub-title">Section 12 (Tại sao chọn chúng tôi?)</h4>
                                        @for($i = 0; $i <= 6; $i++)
                                            <x-upload-file
                                                type="long"
                                                title="Hình ảnh" 
                                                name="home_section_12[{{ $i }}][image]"
                                                image=""
                                                width="100px" 
                                                note="(64px x 64px)"
                                            />
                                            <x-input 
                                                type="text" 
                                                title="Tiêu đề" 
                                                name="home_section_12[{{ $i }}][title]" 
                                                value="" 
                                            />
                                            <x-textarea 
                                                type="" 
                                                title="Nội dung" 
                                                name="home_section_12[{{ $i }}][content]" 
                                                value="" 
                                            />
                                            <hr>
                                        @endfor
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
            return `<div class="input-item mt-3 d-flex">
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