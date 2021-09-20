<footer>
    <div class="container">
        <div class="footer-top">
            <div class="row">
                <div class="col-sm-4">
                    {!! shortcode('footer_1') !!}
                </div>
                <div class="col-sm-4">
                    {!! shortcode('footer_2') !!}
                </div>
                <div class="col-sm-4">
                    {!! shortcode('footer_3') !!}
                </div>
            </div>
        </div>

        <div class="footer-middle">
            <div class="row">
                <div class="col-sm-4">
                    <div class="title">FANPAGE ĐẠI LÂM THỊNH</div>
                    <div class="content">
                        <a href="https://www.facebook.com/kangenvietnam.vn/" target="_blank">
                            <div class="image"><img class="img-fluid lazy" data-src="{{ asset('themes/kangen/images/facebook.png') }}" alt="Fanpage" /></div>
                        </a>
                    </div>
                </div>
                <div class="col-sm-4">
                    {!! shortcode('footer_4') !!}
                </div>
                <div class="col-sm-4">
                    <div class="title">ĐĂNG KÝ NHẬN MÃ ƯU ĐÃI</div>
                    <div class="content"> 
                        <div class="frm-footer-contact">
                            <form class="frm-register" data-action="{{ route('register.form') }}" method="POST">
                                <div class="form-group">
                                    <input type="text" name="phone" value="" class="form-control" placeholder="Số điện thoại" required/>
                                    <input type="hidden" name="type" value="footer"/>
                                </div>
                                <div class="form-group">
                                    <textarea name="note" placeholder="Lời nhắn" class="form-control"></textarea>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn read-more mt-4">Gửi Yêu Cầu</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

@if(setting('site_phone'))
<div class="hotline-phone-ring-wrap">
    <div class="hotline-phone-ring">
        <div class="hotline-phone-ring-circle"></div>
        <div class="hotline-phone-ring-circle-fill"></div>
        <div class="hotline-phone-ring-img-circle">
            <a href="tel:{{ str_replace('.','', setting('site_phone')) }}" class="pps-btn-img">
                <img class="lazy" data-src="{{ asset('themes/kangen/images/icon-call.png') }}" alt="Gọi điện thoại" width="50">
            </a>
        </div>
    </div>
    <div class="hotline-bar">
        <a href="tel:{{ str_replace('.','', setting('site_phone')) }}">
            <span class="text-hotline">{{ setting('site_phone') }}</span>
        </a>
    </div>
</div>
@endif

<section class="footer-bottom">
    <div class="container">
        <div class="payment-icon text-center">
            <img class="img-fluid lazy" data-src="{{ asset('uploads/2020/11/incon-thanh-toan.png') }}" alt="payment icons" />
        </div>
        <div class="payment-text text-center">
            <p>Chấp nhận thanh toán các loại thẻ ATM</p>
            <p>Kangenvietnam.vn</p>
        </div>
    </div>
</section>

{{--  Popup Cart --}}
@include('themes.kangen.cart.popup')