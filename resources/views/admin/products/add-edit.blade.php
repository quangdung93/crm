@extends('admin.body')
@php
    $pageName = 'Sản phẩm';
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
                                <x-input type="text" title="Tên sản phẩm" name="name" value="{{ $product->name ?? ''  }}"/>
                                <x-input type="text" title="Mã sản phẩm" name="sku" value="{{ $product->sku ?? ''  }}"/>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label text-right">Danh mục</label>
                                    <div class="col-sm-9">
                                        <select class="form-control populate select2" name="categories[]" multiple>
                                            @if($categories)
                                                @foreach($categories as $item)
                                                    <option value="{{$item->id}}" {{ isset($product->categories) && in_array($item->id, $product->categories->pluck('id')->toArray()) ? 'selected' : '' }}>{{$item->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @if ($errors->has('categories'))
                                            <div class="text-danger mt-2">{{ $errors->first('categories') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <x-selectbox 
                                    title="Thương hiệu" 
                                    name="brand_id" 
                                    :lists="$brands" 
                                    value="id" 
                                    display="name" 
                                    selected="{{ $product->brand_id ?? '' }}"
                                />
                                <x-input type="text" title="Xuất xứ" name="origin" value="{{ $product->origin ?? ''  }}"/>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-block">
                                <h4 class="sub-title">Giá sản phẩm</h4>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label text-right">Giá gốc (đ)</label>
                                    <div class="col-sm-9">
                                        <input type="text" 
                                        value="{{ old('price_old', isset($product) ? format_price($product->price_old) : '0') }}" 
                                        name="price_old" 
                                        id="price_old" class="form-control input-price" 
                                        onkeyup="this.value=formatMoney(this.value)" 
                                        onclick="this.select()"
                                        autocomplete="off" 
                                        required/>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label text-right">Giá bán (đ)</label>
                                    <div class="col-sm-9">
                                        <input type="text" 
                                        value="{{ old('price', isset($product) ? format_price($product->price) : '0') }}" 
                                        name="price" id="price" class="form-control input-price" 
                                        onkeyup="this.value=formatMoney(this.value)" 
                                        onclick="this.select()"
                                        autocomplete="off" 
                                        required/>
                                        @if ($errors->has('price'))
                                            <div class="text-danger mt-2">{{ $errors->first('price') }}</div>
                                        @endif
                                    </div>
                                </div>
                                @isset($product)
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label text-right">Giảm giá (%)</label>
                                        <div class="col-sm-9">
                                            <input type="text" value="{{ old('discount', $product->discount ?? '0') }}" name="discount" id="discount" class="form-control prevent-event"/>
                                        </div>
                                    </div>
                                @endisset
                            </div>
                        </div>
                        @isset($product)
                        <div class="card hidden">
                            <div class="card-block">
                                <h4 class="sub-title">Hình ảnh</h4>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="wrap-upload">
                                            <div class="upload-zone-icon"><i class="feather icon-upload-cloud"></i></div>
                                            <div class="upload-zone-button">
                                                <a href="#" id="upload-multiple-images" class="btn btn-primary">Upload ảnh</a>
                                                <input 
                                                    type="file" 
                                                    data-id="{{ $product->id }}" 
                                                    data-type="product"
                                                    multiple="" 
                                                    accept="image/x-png, image/jpg, image/jpeg"
                                                    id="input-multiple-images" class="hidden" />
                                            </div>
                                            <ul id="sortable" class="preview-images">
                                                @foreach($product->images as $image)
                                                    <li data-id="{{ $image->id }}" data-path={{ $image->path }}>
                                                        <img src="{{ asset($image->path) }}" alt=""><span class="remove-img">
                                                        <i class="feather icon-trash-2"></i></span>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                </div>
                            </div>
                        </div>
                        @endisset
                        <div class="card">
                            <div class="card-block">
                                <h4 class="sub-title">Thông tin SEO</h4>
                                <x-input type="text" title="Đường dẫn" name="slug" value="{{ $product->slug ?? ''  }}"/>
                                <x-input type="text" title="Meta title" name="meta_title" value="{{ $product->meta_title ?? ''  }}"/>
                                <x-textarea type="" title="Meta description" name="meta_description" value="{{ $product->meta_description ?? ''  }}" />
                                <x-input type="text" title="Meta keyword" name="meta_keyword" value="{{ $product->meta_keyword ?? ''  }}"/>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-block">
                                <h4 class="sub-title">Nội dung {{ $pageName }}</h4>
                                <x-textarea type="tinymce" title="" name="content" value="{!! isset($product) ? $product->content : '' !!}" />
                            </div>
                        </div>
                        @if(config('stableweb.google_review'))
                            <x-google-review :model="$product ?? ''"/>
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
                                checked="{{ !isset($product) ? 'true' : ($product->status ? 'true' : '') }}"/>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-block">
                                <h4 class="sub-title">Ảnh đại diện</h4>
                                <x-upload-file 
                                type="short"
                                title="Ảnh đại diện" 
                                name="input_file"
                                image="{{ $product->image ?? '' }}"
                                width="100%"
                                note="(600px x 600px)"
                                />
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

        @if(!isset($product))
            $('input[name="name"]').on('keyup', function(){
                convert_slug($(this).val());
            });
        @endif

        $(document).on('focusout', '.input-price', function(){
            $(this).val() == '' && $(this).val(0);
        });

        if($('#sortable').length > 0){
            Sortable.create($('#sortable')[0], {
                animation: 0,
                onEnd: function (evt) {
                    var data_sort = evt.from;
                    let order = [];
        
                    $(data_sort).find('li').each(function(){
                        order.push({id: $(this).data('id'), order: $(this).index() + 1});
                    });
        
                    $.post('{{ route('images.order') }}', {
                        order: order,
                        _token: '{{ csrf_token() }}'
                    }, function (data) {
                        data.status && pushNotify('Cập nhật thành công!', text = '', type = 'success');
                    });
                }
            })
        }
    });
</script>
@endsection