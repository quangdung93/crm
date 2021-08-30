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

//Youtube
if($('.youtube').length > 0){
    generateYoutube();
}

if($('.youtube-list').length > 0){
    generateYoutubeItem();
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

$(document).on('click', '.menu-mobile li.has-submenu .icon-show', function(){
    $(this).closest('.has-submenu').find('.sub-menu').toggleClass('show-menu');
});

function generateYoutube() {
    var youtube = document.querySelectorAll(".youtube");
    for (var i = 0; i < youtube.length; i++) {
        // thumbnail image source.
        var source = "https://img.youtube.com/vi/" + youtube[i].dataset.embed + "/hqdefault.jpg"; //sddefault.jpg
        // Load t image asynchronously    
        var image = new Image();
        image.src = source;
        image.addEventListener("load", function () {
            youtube[i].appendChild(image);
        }(i));
        youtube[i].addEventListener("click", function () {
            var iframe = document.createElement("iframe");
            iframe.setAttribute("frameborder", "0");
            iframe.setAttribute("class", "youtube-video");
            iframe.setAttribute("allowfullscreen", "");
            iframe.setAttribute("src", "https://www.youtube.com/embed/" + this.dataset.embed + "?rel=0&showinfo=0&autoplay=1");
            this.innerHTML = "";
            this.appendChild(iframe);
        });
    }
}

function generateYoutubeItem() {
    var youtube = document.querySelectorAll('.youtube-list');
    for (var i = 0; i < youtube.length; i++) {
        // thumbnail image source.
        var source = "https://img.youtube.com/vi/" + youtube[i].dataset.embed + "/hqdefault.jpg"; //sddefault.jpg
        // Load t image asynchronously    
        var image = new Image();
        image.setAttribute("src", source);
        image.setAttribute("class", "lazy");
        image.addEventListener("load", function () {
            youtube[i].appendChild(image);
            // youtubeLazyLoad(youtube[i].querySelectorAll('.lazy'));
        }(i));
    }
}

function youtubeLazyLoad(element, timeout = 0) {
    setTimeout(function () {
        $(element).lazyload({
            effect: "fadeIn"
        }).addClass('youtube-loaded');
    }, timeout);
}

function renderIframeYoutube(embed){
    let iframe = document.createElement("iframe");
        iframe.setAttribute("frameborder", "0");
        iframe.setAttribute("class", "youtube-video");
        iframe.setAttribute("width", "100%");
        iframe.setAttribute("height", "100%");
        iframe.setAttribute("allowfullscreen", "");
        iframe.setAttribute("src", "https://www.youtube.com/embed/" + embed + "?rel=0&showinfo=0&autoplay=1");
        return iframe;
}
