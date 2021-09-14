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
                            <i class="feather icon-settings"></i> Trang chủ
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#tab2" role="tab">
                            <i class="feather icon-flag"></i> Chi tiết sản phẩm
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#tab3" role="tab">
                            <i class="feather icon-grid"></i> Cấu hình chung
                        </a>
                    </li>
                </ul>

                <div class="tab-content card-block p-0">
                    <div class="tab-pane active" id="tab1" role="tabpanel" aria-expanded="true">
                        <div class="row mt-3">
                            {{-- Section 1 --}}
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-block">
                                        <h4 class="sub-title">Section 1 (Banner)</h4>
                                        <x-input 
                                            type="text" 
                                            title="Tiêu đề banner" 
                                            name="home_banner[0][title]" 
                                            value="{{ theme('home_banner.title') }}" 
                                        />
                                        <x-textarea 
                                            type="" 
                                            title="Nội dung banner" 
                                            name="home_banner[0][content]" 
                                            value="{{ theme('home_banner.content') }}" 
                                        />
                                        <x-input 
                                            type="text" 
                                            title="Đường dẫn" 
                                            name="home_banner[0][link]" 
                                            value="{{ theme('home_banner.link') }}" 
                                        />
                                        <input type="hidden" 
                                            name="home_banner[0][image]" 
                                            value="{{ theme('home_banner.image') }}" 
                                        />
                                        <x-upload-file
                                            type="long"
                                            title="Ảnh banner" 
                                            name="home_banner[0][image]"
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
                                            name="home_section_2[0][category_id]" 
                                            :lists="$categories" 
                                            value="id" 
                                            display="name" 
                                            selected="{{ theme('home_section_2.category_id') }}"
                                        />
                                    </div>
                                </div>
                            </div>

                            {{-- Section 3 --}}
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-block">
                                        <h4 class="sub-title">Section 3 (Banner Ảnh)</h4>
                                        <input 
                                            type="hidden" 
                                            name="home_section_3[0][image]" 
                                            value="{{ theme('home_section_3.image') ?: '' }}" 
                                        />
                                        <x-upload-file
                                            type="long"
                                            title="Desktop" 
                                            name="home_section_3[0][image]"
                                            image="{{ theme('home_section_3.image') }}"
                                            width="500px" 
                                            note="(1000px x 185px)"
                                        />
                                        <input 
                                            type="hidden" 
                                            name="home_section_3[0][mobile]" 
                                            value="{{ theme('home_section_3.mobile') ?: '' }}" 
                                        />
                                        <x-upload-file
                                            type="long"
                                            title="Mobile" 
                                            name="home_section_3[0][mobile]"
                                            image="{{ theme('home_section_3.mobile') }}"
                                            width="250px" 
                                            note="(400px x 340px)"
                                        />
                                        <x-input 
                                            type="text" 
                                            title="Đường dẫn" 
                                            name="home_section_3[0][link]" 
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
                                            name="home_section_4[0][category_id]" 
                                            :lists="$categories" 
                                            value="id" 
                                            display="name" 
                                            selected="{{ theme('home_section_4.category_id') }}"
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
                                            name="home_section_5[0][category_id]" 
                                            :lists="$categories" 
                                            value="id" 
                                            display="name" 
                                            selected="{{ theme('home_section_5.category_id') }}"
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
                                                    <div class="input-block home_section_youtube">
                                                        @php
                                                            $listYoutube = theme('home_section_youtube');
                                                        @endphp
                                                        @if($listYoutube)
                                                            @foreach($listYoutube as $youtube)
                                                                <div class="input-item mt-3 d-flex">
                                                                    <input type="text" 
                                                                    name="home_section_youtube[{{ $loop->index }}][link]"
                                                                    value="{{ $youtube['link'] }}"
                                                                    placeholder="Nhập đường dẫn youtube"
                                                                    class="form-control"/>
                                                                    <input type="text" 
                                                                    name="home_section_youtube[{{ $loop->index }}][title]"
                                                                    value="{{ $youtube['title'] }}"
                                                                    placeholder="Nhập tiêu đề youtube"
                                                                    class="form-control ml-2"/>
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
                                        @php
                                            $section_6 = theme('home_section_6');
                                        @endphp
                                        @for($i = 0; $i < 3; $i++)
                                            <input type="hidden" 
                                                name="home_section_6[{{ $i }}][image]" 
                                                value="{{ $section_6[$i]['image'] ?? '' }}" 
                                            />
                                            <x-upload-file
                                                type="long"
                                                title="Hình ảnh" 
                                                name="home_section_6[{{ $i }}][image]"
                                                image="{{ $section_6[$i]['image'] ?? '' }}"
                                                width="150px" 
                                                note="(500px x 500px)"
                                            />
                                            <x-input 
                                                type="text" 
                                                title="Đường dẫn" 
                                                name="home_section_6[{{ $i }}][link]" 
                                                value="{{ $section_6[$i]['link'] ?? '' }}" 
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
                                        @php
                                            $section_7 = theme('home_section_7');
                                        @endphp
                                        @for($i = 0; $i < 2; $i++)
                                            <x-input 
                                                type="text" 
                                                title="Tiêu đề SP" 
                                                name="home_section_7[{{ $i }}][title]" 
                                                value="{{ $section_7[$i]['title'] ?? '' }}" 
                                            />
                                            <input 
                                                type="hidden" 
                                                name="home_section_7[{{ $i }}][image]" 
                                                value="{{ $section_7[$i]['image'] ?? '' }}" 
                                            />
                                            <x-upload-file
                                                type="long"
                                                title="Ảnh SP" 
                                                name="home_section_7[{{ $i }}][image]"
                                                image="{{ $section_7[$i]['image'] ?? '' }}"
                                                width="150px" 
                                                note="(550px x 550px)"
                                            />
                                            <x-input 
                                                type="text" 
                                                title="Đường dẫn SP" 
                                                name="home_section_7[{{ $i }}][link]" 
                                                value="{{ $section_7[$i]['link'] ?? '' }}"
                                            />
                                            <x-textarea 
                                                type="" 
                                                title="Nội dung SP" 
                                                name="home_section_7[{{ $i }}][content]" 
                                                value="{{ $section_7[$i]['content'] ?? '' }}"
                                            />
                                            <input 
                                                type="hidden" 
                                                name="home_section_7[{{ $i }}][logo]" 
                                                value="{{ $section_7[$i]['logo'] ?? '' }}" 
                                            />
                                            <x-upload-file
                                                type="long"
                                                title="Logo SP" 
                                                name="home_section_7[{{ $i }}][logo]"
                                                image="{{ $section_7[$i]['logo'] ?? '' }}"
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
                                        <input 
                                            type="hidden" 
                                            name="home_section_8[0][image]" 
                                            value="{{ theme('home_section_8.image') ?: '' }}" 
                                        />
                                        <x-upload-file
                                            type="long"
                                            title="Desktop" 
                                            name="home_section_8[0][image]"
                                            image="{{ theme('home_section_8.image') }}"
                                            width="500px" 
                                            note="(1000px x 185px)"
                                        />
                                        <input 
                                            type="hidden" 
                                            name="home_section_8[0][mobile]" 
                                            value="{{ theme('home_section_8.mobile') ?: '' }}" 
                                        />
                                        <x-upload-file
                                            type="long"
                                            title="Mobile" 
                                            name="home_section_8[0][mobile]"
                                            image="{{ theme('home_section_8.mobile') }}"
                                            width="250px" 
                                            note="(400px x 340px)"
                                        />
                                        <x-input 
                                            type="text" 
                                            title="Đường dẫn" 
                                            name="home_section_8[0][link]" 
                                            value="{{ theme('home_section_8.link') }}" 
                                        />
                                    </div>
                                </div>
                            </div>

                            {{-- Section 9 --}}
                            <div class="col-sm-12">
                                <div class="card">
                                    @php
                                        $home_section_news = theme('home_section_news');
                                    @endphp
                                    <div class="card-block">
                                        <h4 class="sub-title">Section 9 (Tin tức)</h4>
                                        @for($i = 0; $i < 3; $i++)
                                        <x-selectbox 
                                            title="Danh mục tin tức trái" 
                                            name="home_section_news[{{ $i }}][category_id]" 
                                            :lists="$postCategories" 
                                            value="id" 
                                            display="name" 
                                            selected="{{ $home_section_news[$i]['category_id'] }}"
                                        />
                                        @endfor
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
                                            name="home_section_10[0][title]" 
                                            value="{{ theme('home_section_10.title') }}" 
                                        />
                                        <x-input 
                                            type="text" 
                                            title="Tiêu đề phụ" 
                                            name="home_section_10[0][subtitle]" 
                                            value="{{ theme('home_section_10.subtitle') }}" 
                                        />
                                        <x-input 
                                            type="text" 
                                            title="Đường dẫn" 
                                            name="home_section_10[0][link]" 
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
                                        @php
                                            $section_11 = theme('home_section_11');
                                        @endphp
                                        @for($i = 0; $i < 4; $i++)
                                            <x-input 
                                                type="text" 
                                                title="Icon" 
                                                name="home_section_11[{{ $i }}][icon]" 
                                                value="{{ $section_11[$i]['icon'] ?? '' }}" 
                                            />
                                            <x-textarea 
                                                type="" 
                                                title="Nội dung" 
                                                name="home_section_11[{{ $i }}][content]" 
                                                value="{{ $section_11[$i]['content'] ?? '' }}" 
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
                                        @php
                                            $section12 = theme('home_section_12');
                                        @endphp
                                        @for($i = 0; $i < 6; $i++)
                                            <input 
                                                type="hidden" 
                                                name="home_section_12[{{ $i }}][image]" 
                                                value="{{ $section12[$i]['image'] ?: '' }}" 
                                            />
                                            <x-upload-file
                                                type="long"
                                                title="Hình ảnh" 
                                                name="home_section_12[{{ $i }}][image]"
                                                image="{{ $section12[$i]['image'] ?: '' }}"
                                                width="100px" 
                                                note="(64px x 64px)"
                                            />
                                            <x-input 
                                                type="text" 
                                                title="Tiêu đề" 
                                                name="home_section_12[{{ $i }}][title]" 
                                                value="{{ $section12[$i]['title'] ?? '' }}" 
                                            />
                                            <x-textarea 
                                                type="" 
                                                title="Nội dung" 
                                                name="home_section_12[{{ $i }}][content]" 
                                                value="{{ $section12[$i]['content'] ?? '' }}" 
                                            />
                                            <hr>
                                        @endfor
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="tab-pane" id="tab2" role="tabpanel">
                        <div class="row mt-3">
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-block">
                                        <h4 class="sub-title">Call to action</h4>
                                        <x-input 
                                            type="text" 
                                            title="Tiêu đề" 
                                            name="product_question[0][title]" 
                                            value="{{ theme('product_question.title') }}" 
                                        />
                                        <x-input 
                                            type="text" 
                                            title="Đường dẫn" 
                                            name="product_question[0][link]" 
                                            value="{{ theme('product_question.link') }}" 
                                        />
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-block">
                                        <h4 class="sub-title">Trích dẫn</h4>
                                        <x-textarea 
                                            type="" 
                                            title="Nội dung" 
                                            name="product_quote[0][content]" 
                                            value="{{ theme('product_quote.content') }}" 
                                        />
                                        <x-input 
                                            type="text" 
                                            title="Tác giả" 
                                            name="product_quote[0][author]" 
                                            value="{{ theme('product_quote.author') }}" 
                                        />
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-block">
                                        <h4 class="sub-title">Banner ảnh</h4>
                                        <x-input 
                                            type="text" 
                                            title="Tiêu đề" 
                                            name="product_banner_1[0][title]" 
                                            value="{{ theme('product_banner_1.title') }}" 
                                        />
                                        <input type="hidden" 
                                            name="product_banner_1[0][image]" 
                                            value="{{ theme('product_banner_1.image') ?: '' }}" 
                                        />
                                        <x-upload-file
                                            type="long"
                                            title="Ảnh banner" 
                                            name="product_banner_1[0][image]"
                                            image="{{ theme('product_banner_1.image') }}"
                                            width="400px" 
                                            note="(450px x 280px)"
                                        />
                                        <x-input 
                                            type="text" 
                                            title="Đường dẫn" 
                                            name="product_banner_1[0][link]" 
                                            value="{{ theme('product_banner_1.link') }}" 
                                        />
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-block">
                                        <h4 class="sub-title">Dịch vụ</h4>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label text-right">Tiêu đề</label>
                                            <div class="col-sm-9">
                                                <div class="input-wrap">
                                                    <div class="input-block product_services">
                                                        @php
                                                            $productServices = theme('product_services');
                                                        @endphp
                                                        @if($productServices)
                                                            @foreach($productServices as $youtube)
                                                                <div class="input-item mt-3 d-flex">
                                                                    <input type="text" 
                                                                    name="product_services[{{ $loop->index }}][link]"
                                                                    value="{{ $youtube['link'] }}"
                                                                    placeholder="Đường dẫn"
                                                                    class="form-control"/>
                                                                    <input type="text" 
                                                                    name="product_services[{{ $loop->index }}][title]"
                                                                    value="{{ $youtube['title'] }}"
                                                                    placeholder="Tiêu đề"
                                                                    class="form-control ml-2"/>
                                                                    <div class="btn btn-danger ml-2 remove"><i class="feather icon-trash-2"></i></div>
                                                                </div>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                    <div class="text-left mt-3">
                                                        <a href="#" class="btn btn-primary btn-add-input" data-name="product_services"><i class="feather icon-plus"></i> Thêm</a>
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
                            {{-- Logo --}}
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-block">
                                        <h4 class="sub-title">Logo</h4>
                                        <input 
                                            type="hidden" 
                                            name="logo[0][image]" 
                                            value="{{ theme('logo.image') ?: '' }}" 
                                        />
                                        <x-upload-file
                                            type="long"
                                            title="Logo" 
                                            name="logo[0][image]"
                                            image="{{ theme('logo.image') }}"
                                            width="300px" 
                                            note="(300px x 90px)"
                                        />
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
            let index = 1;
            let count = $(`.input-block.${name} .input-item`).length;

            if(count > 0){
                index = count + 1;
            }

            let html = renderInput(name, parseInt(index));

            $(this).closest('.input-wrap').find('.input-block').append(html);
        });

        $(document).on('click', '.input-item .remove', function(){
            $(this).closest('.input-item').remove();
        });

        function renderInput(name, index){
            return `<div class="input-item mt-3 d-flex">
                <input type="text" 
                name="${name}[${index}][link]"
                value=""
                placeholder="Nhập đường dẫn"
                class="form-control mr-2"/>
                <input type="text" 
                name="${name}[${index}][title]"
                value=""
                placeholder="Nhập tiêu đề"
                class="form-control"/>
                <div class="btn btn-danger ml-2 remove"><i class="feather icon-trash-2"></i></div>
            </div>`;
        }
    });
</script>
@endsection