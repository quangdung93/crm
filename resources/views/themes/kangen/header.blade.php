<header id="header">
    <div class="container d-flex justify-content-between">
        <div class="logo">
            <a href="/">
                <img src="{{ asset(theme('logo.image')) }}" alt="Logo"/>
            </a>
        </div>
        <div class="header-content d-flex align-items-center">
            <div class="search hidden-mb">
                <input id="search-input" type="text" value="{{ request()->get('key') }}" placeholder="Tìm kiếm..."/>
                <span class="icon"><i class="feather icon-search"></i></span>
            </div>
            <div class="cart-header ml-5">
                <a href="#" class="header-btn-cart">
                    <span class="hidden-mb">Giỏ hàng</span>
                    <span class="cart-icon">
                        <i class="feather icon-shopping-cart"></i>
                        @php
                            $countCart = Cart::count();
                        @endphp
                        @if($countCart > 0)
                            <span>{{ $countCart }}</span>
                        @endif
                    </span>
                    <div class="alert-cart">
                        <div class="close"><i class="feather icon-x"></i></div>
                        <div><i class="feather icon-check"></i> <span>Thêm giỏ hàng thành công!</span></div>
                        <div id="view-popup-cart-header" class="btn bg-kangen mt-2">Xem giỏ hàng</div>
                    </div>
                </a>
            </div>
            <div class="btn btn-kangen hidden-mb ml-5"><a class="text-white" href="tel:{{ str_replace('.','', setting('site_phone')) }}">Hotline: {{ setting('site_phone') }}</a></div>
            <div class="btn btn-kangen hidden-mb ml-4"><a class="text-white" href="{{ setting('site_installment_link') }}">Trả góp 0%</a></div>
            <div class="icon-menu-mobile"><i class="feather icon-menu"></i></div>
        </div>
    </div>
</header>
<div class="nav-menu">
    <div class="container">
        <div class="main-menu">
            <div class="logo-menu d-sm-none">
                <img class="img-fluid lazy" data-src="{{ asset(theme('logo.image')) }}" alt="Logo menu"/>
            </div>
            <div class="search d-sm-none">
                <input type="text" placeholder="Tìm kiếm..."/>
            </div>
            {!! menu('main-menu') !!}
        </div>
    </div>
</div>