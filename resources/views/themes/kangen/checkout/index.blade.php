@extends('themes.kangen.body')
@section('title', 'Sản phẩm')
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('themes/kangen/css/checkout.css') }}">
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Giỏ hàng</li>
            </ol>
        </div>
    </nav>
    <div class="checkout-page">
        <div class="container">
            <div class="page-title">
                <h3 class="mb-0">Giỏ hàng</h3>
            </div>
            <div class="checkout-wrapper">
                <div class="row">
                    <div class="col-12 col-sm-7">
                        <div class="cart-info">
                            <div class="section-title">Thông tin đơn hàng</div>
                            <div class="checkout-cart-content">
                                <div class="title">
                                    <div class="item" style="width:40%">Sản phẩm</div>
                                    <div class="item text-left" style="width:100px">Đơn giá</div>
                                    <div class="item text-left">Số lượng</div>
                                    <div class="item">Thành tiền</div>
                                </div>
                                <div class="content"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-5">
                        <div class="order-info">
                            <div class="section-title">Thông tin khách hàng</div>
                            <div class="checkout-form">
                                <form id="frm-checkout">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <input type="text" id="name" name="customer_name" value="" class="form-control" placeholder="Họ và tên" />
                                                <div class="error text-danger mt-2"></div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <input type="text" id="phone" name="customer_phone" value="" class="form-control" placeholder="Số điện thoại" />
                                                <div class="error text-danger mt-2"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" id="email" name="customer_email" value="" class="form-control" placeholder="Email" />
                                        <div class="error text-danger mt-2"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <div class="checkout-select">
                                                    <select id="provinces" name="province_id" class="form-control">
                                                        <option value="" selected="selected">Chọn tỉnh/thành phố</option>
                                                        @foreach($provinces as $province)
                                                            <option value="{{$province->id}}">{{$province->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    <div class="error text-danger mt-2"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <div class="checkout-select">
                                                    <select id="districts" name="district_id" class="form-control">
                                                        <option value="">Chọn quận/huyện</option>
                                                    </select>
                                                    <div class="error text-danger mt-2"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <div class="checkout-select">
                                                    <select id="wards" name="ward_id" class="form-control">
                                                        <option value="">Chọn phường/xã</option>
                                                    </select>
                                                    <div class="error text-danger mt-2"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <input type="text" id="address" name="customer_address" value="" class="form-control" placeholder="Số nhà, tên đường" />
                                                <div class="error text-danger mt-2"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <textarea name="note" placeholder="Lời nhắn" class="form-control"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <button id="btn-checkout" class="btn read-more mt-4 {{ Cart::count() === 0 ? 'prevent-event' : '' }}">Gửi Đơn Hàng</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
<script>
    $(document).ready(function(){
        var mailPattern = /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i,
            name = $('#name'),
            phone = $('#phone'),
            email = $('#email'),
            address = $('#address'),
            province = $('#provinces'),
            district = $('#districts'),
            ward = $('#wards');

        loadCart();

        $(document).on('submit', '#frm-checkout', function(e){
            e.preventDefault();
            resetInput();
            let flagInfo = validateInfo();
            let flagAddress = validateAddress();
            let scollPositionEle = $('.order-info');
            if (flagInfo) {
                scrollToError(scollPositionEle);
                return;
            }
            else if(flagAddress) {
                scrollToError(scollPositionEle);
                return;
            }
            else{
                $('#btn-checkout > span').text('Đang xử lý');
                $('.main-content').addClass('prevent-events');
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: 'POST',
                    url: '{{ route('checkout.store') }}',
                    data: $(this).serialize(),
                    success: function (response) {
                        if (response.status) {
                            window.location = '/checkout/success/' + response.order_id;
                        }
                    }
                });
            }
        });

        $('#provinces').on('change', function () {
            let idProvince = this.value;
            if (!idProvince) {
                return false;
            }

            $.get('/province/' + idProvince, function (result) {
                if (result.status) {
                    $('#districts').empty();
                    $('#districts').append(result.html);
                    $("#districts").trigger("chosen:updated");
                } else {
                    alert(result.alert);
                }
            });
        });

        $('#districts').on('change', function () {
            let idDistrict = this.value;
            if (!idDistrict) {
                return false;
            }

            $.get('/district/' + idDistrict, function (result) {
                if (result.status) {
                    $('#wards').empty();
                    $('#wards').append(result.html);
                    $("#wards").trigger("chosen:updated");
                } else {
                    alert(result.alert);
                }
            });
        });

        $(document).on('click', '.remove-cart-item', function(){
            if(!confirm('Bạn muốn xóa sản phẩm này khỏi giỏ hàng?')){
                return;
            }

            var cart_id = $(this).closest('.line').data('id');

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ route('cart.remove') }}',
                data: {cart_id:cart_id},
                type: 'POST',
                success: function (response) {
                    if(response.status){
                        loadCart();
                    }
                }
            });
        });

        $(document).on('keydown', 'input[type="number"].checkout-qty-input', function (event) {
            keyDownValidate($(this), event);
        });

        $(document).on('keyup', 'input[type="number"].checkout-qty-input', function () {
            keyUpValidate($(this));
        });

        $(document).on('focusout', 'input[type="number"].checkout-qty-input', function () {
            keyUpValidate($(this));
            updateItem($(this));
        });

        $(document).on('click', '.checkout-btn-cart-plus', function (e) {
            e.preventDefault();
            plusButtonHandle($(this));
            updateItem($(this));
        });

        $(document).on('click', '.checkout-btn-cart-minus', function (e) {
            e.preventDefault();
            minusButtonHandle($(this));
            updateItem($(this));
        });

        function updateItem(element) {
            var cart_id = element.closest('.line').data('id'),
                qty = element.closest('.qty-box').find('.checkout-qty-input').val();

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ route('cart.update') }}',
                data: {cart_id:cart_id, qty: qty},
                type: 'POST',
                success: function (response) {
                    if(response.status){
                        loadCart();
                    }
                }
            });
        }

        function loadCart(){
            $.ajax({
                type: 'GET',
                url: '{{ route('checkout.load') }}',
                success: function (response) {
                    if(response.status){
                        $('.checkout-cart-content .content').html(response.data);
                        $('.header-btn-cart .cart-icon span').text(response.qty);
                    }
                }
            });
        }

        function keyDownValidate(element, event) {
            var ignoreKeyCodes = [16, 69, 107, 109, 188, 189, 190],
                currentValue = element.val();

            if ($.inArray(event.keyCode, ignoreKeyCodes) >= 0) {
                event.preventDefault();

                currentValue = currentValue.replace(String.fromCharCode(event.keyCode), '');
                element.val(currentValue);
            }
        }

        function keyUpValidate(element) {
            var newValue = element.val();   
            if (!newValue) {
                return false;
            }

            newValue = Number(newValue);
            if (newValue > 99) {
                newValue = 99;
            } else if (newValue < 1) {
                newValue = 1;
            }

            element.val(newValue);
        }

        function plusButtonHandle(element) {
            var elementInput = element.closest('.qty-box').find('.checkout-qty-input'),
                current_value = Number(elementInput.val()),
                new_value = 99;

            if (current_value < 99) {
                new_value = current_value + 1;
            }

            elementInput.val(new_value);
        }

        function minusButtonHandle(element) {
            var elementInput = element.closest('.qty-box').find('.checkout-qty-input'),
                current_value = Number(elementInput.val()),
                new_value = 1;

            if (current_value > 1) {
                new_value = current_value - 1;
            }

            elementInput.val(new_value);
        }

        function scrollToError(element) {
            $("html, body").delay(20).animate({
                scrollTop: element.offset().top
            }, 500);
        }

        function validateInfo() {
            let flagInfo = false;
            if ($.trim(name.val()) == '') {
                name.next('.error').text('Bạn chưa nhập họ tên');
                flagInfo = true;
            }

            if ($.trim(phone.val()) == '') {
                phone.next('.error').text('Bạn chưa nhập số điện thoại');
                flagInfo = true;
            } else if (!checkPhoneNumber(phone.val())) {
                phone.next('.error').text('Số điện thoại không hợp lệ');
                flagInfo = true;
            }

            if ($.trim(email.val()) !== '' && !mailPattern.test($.trim(email.val()))) {
                email.next('.error').text('Địa chỉ email không hợp lệ');
                flagInfo = true;
            }

            if ($.trim(email.val()) !== '' && !mailPattern.test(email.val())) {
                email.next('.error').text('Địa chỉ email không hợp lệ');
                flagInfo = true;
            }
            else{
                email.next('.error').text('');
            }

            return flagInfo;
        }

        function validateAddress(){
            let flagAddress = false;

            if (!province.val()) {
                province.closest('.checkout-select').find('.error').text('Bạn chưa chọn tỉnh/thành phố');
                flagAddress = true;
            }

            if (!district.val()) {
                district.closest('.checkout-select').find('.error').text('Bạn chưa chọn quận/huyện');
                flagAddress = true;
            }

            if (!ward.val()) {
                ward.closest('.checkout-select').find('.error').text('Bạn chưa chọn phường/xã');
                flagAddress = true;
            }

            if ($.trim(address.val()) == '') {
                address.next('.error').text('Bạn chưa nhập số nhà, tên đường');
                flagAddress = true;
            }

            return flagAddress;
        }

        function resetInput(){
            $('.error').text('');
        }

    });
</script>
@endsection