@extends('themes.kangen.body')
@section('title', $category->name)
@section('content')
    <nav aria-label="breadcrumb">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $category->name }}</li>
            </ol>
        </div>
    </nav>
    <div class="product-page">
        <div class="container">
            <div class="page-title">
                <h3>{{ $category->name }}</h3>
                <p class="text-center">Các dòng sản phẩm của tập đoàn ENAGIC được nhập khẩu bởi công ty Kangen Việt Nam</p>
            </div>
            <div class="products-wrapper">
                {!! product_template($category->products) !!}

                {{-- {!! $products->render('themes.kangen.components.pagination') !!} --}}
            </div>
        </div>
    </div>

    @include('themes.kangen.components.call-to-action')
@endsection

@section('javascript')
<script>
    $(document).ready(function(){
        
    });
</script>
@endsection