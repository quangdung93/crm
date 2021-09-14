//Lazyload
$('.lazy').lazyload({effect: "fadeIn"});               

//Slick slider
if($('.sliders').length > 0){
    $('.sliders').slick();
}

$('.top-news').slick({
    dots: true,
    pauseOnHover: true,
    infinite: true,
    slidesToShow: 1,
    speed: 600,
    arrows: false,
    autoplaySpeed: 3000,
    swipe: true,
    draggable: true,
    rtl: false,
});

$('.cusomter-slider').slick({
    dots: true,
    pauseOnHover: true,
    infinite: true,
    slidesToShow: 2,
    speed: 600,
    arrows: false,
    autoplaySpeed: 3000,
    swipe: true,
    draggable: true,
    rtl: false,
});


if($(window).width() > 1024){
    var headerHeight = $('#header').outerHeight() - 10;

    $(document).scroll(function(){
        var scroll = $(window).scrollTop();
        if(scroll >= headerHeight){
            $('#header').addClass('fixed-header', 300 , "easeIn");
        }
        else{
            $('#header').removeClass('fixed-header', 300 , "easeIn");
        }
    });
}


//Icon Menu Mobile Click
$(document).on('click', '.icon-menu-mobile', function(){
    $('.main-menu').toggleClass('menu-mobile');

    if($('.main-menu').hasClass('menu-mobile')){
        $(this).find('i').removeClass('icon-menu');
        $(this).find('i').addClass('icon-x');
    }
    else{
        $(this).find('i').addClass('icon-menu');
        $(this).find('i').removeClass('icon-x');
    }
}); 

$(document).on('click', '.menu-mobile li.has-submenu .icon-show', function(e){
    e.preventDefault();
    e.stopPropagation();
    $(this).closest('.has-submenu').find('.sub-menu').toggleClass('show-menu');
});

$(document).on('click', '#btn-toggle-content', function(e){
    e.preventDefault();

    if($('.height-fixed').hasClass('show-all')){
        $('.height-fixed').removeClass('show-all').addClass('blur-content');
        $(this).find('span').text('Xem thêm');
        $(this).find('i').removeClass('icon-chevrons-up').addClass('icon-chevrons-down');
        scrollToElement($('.height-fixed'));
    }
    else{
        $('.height-fixed').addClass('show-all').removeClass('blur-content');
        $(this).find('span').text('Thu gọn');
        $(this).find('i').removeClass('icon-chevrons-down').addClass('icon-chevrons-up');
    }

});

function scrollToElement(element, time = 500, margin = 10) {
    $("html, body").animate({
        scrollTop: element.offset().top - margin
    }, time);
}

function checkPhoneNumber(phoneNumber) {
    var flag = false;
    var phone = phoneNumber;
    phone = phone.replace('(+84)', '0');
    phone = phone.replace('+84', '0');
    phone = phone.replace('0084', '0');
    phone = phone.replace(/ /g, '');
    if (phone != '') {
        var firstNumber = phone.substring(0, 2);
        if ((firstNumber == '09' || firstNumber == '08' || firstNumber == '07' || firstNumber == '05' || firstNumber == '03') && phone.length == 10) {
            if (phone.match(/^\d{10}/)) {
                flag = true;
            }
        } else if (firstNumber == '01' && phone.length == 11) {
            if (phone.match(/^\d{11}/)) {
                flag = true;
            }
        }
    }
    return flag;
}

//Register Form
$(document).on('submit', '.frm-register', function(e){
    e.preventDefault();
    let self = $(this);
    let url = $(this).data('action');
    console.log(url);
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        method: 'POST',
        url: url,
        data: $(this).serialize(),
        success: function (response) {
            if (response.status) {
                alert('Đăng ký thành công!');
                self[0].reset();
            }
        }
    });
});

$(document).on('click','.search .icon', function(){
    let value = $(this).closest('.search').find('#search-input').val();
    window.location.href = '/tim-kiem?key=' + value;
});

// Handle press "Enter" button on search box
$('#search-input').keypress(function (event) {
    var keycode = (event.keyCode ? event.keyCode : event.which);
    var value = $(this).val();
    if (keycode == '13') {
        window.location.href = '/tim-kiem?key=' + value;
    }
});