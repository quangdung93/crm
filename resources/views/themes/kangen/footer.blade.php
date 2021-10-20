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
                        @if(setting('site_facebook_thumbnail'))
                            <a href="{{ setting('site_facebook_link') }}" target="_blank">
                                <div class="image"><img class="img-fluid lazy" data-src="{{ asset(setting('site_facebook_thumbnail')) }}" alt="Fanpage" /></div>
                            </a>
                        @endif
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
    @include('themes.kangen.components.phone',['phone' => setting('site_phone')])
@endif

@if(setting('site_hotline'))
    @include('themes.kangen.components.phone',['phone' => setting('site_hotline'), 'class' => 'hotline'])
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

{{-- Social --}}
@include('themes.kangen.components.social')

{{--  Popup Cart --}}
@include('themes.kangen.cart.popup')