@extends('themes.kangen.body')
@section('content')
    <nav aria-label="breadcrumb">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Kết quả tìm kiếm</li>
            </ol>
        </div>
    </nav>
    <div class="product-page">
        <div class="container">
            <div class="page-title">
                <h3>Kết quả tìm kiếm "{{ request()->get('key') }}"</h3>
                <p class="text-center">Các dòng sản phẩm của tập đoàn ENAGIC được nhập khẩu bởi công ty Kangen Việt Nam</p>
            </div>
            <div class="products-wrapper">
                {!! product_template($products) !!}
            </div>
            {!! $products->render('themes.kangen.components.pagination') !!}
        </div>
    </div>
@endsection

@section('javascript')
<script>
    $(document).ready(function(){
        
    });
</script>
@endsection