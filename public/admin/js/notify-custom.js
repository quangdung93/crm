hideSuccessMessage = function(time = 3000) {
    setTimeout(() => {
        $('.alert.alert-success').fadeOut();
    }, time);
}

hideErrorMessage = function(time = 3000) {
    setTimeout(() => {
        $('.alert.alert-danger').fadeOut();
    }, time);
}

pushNotify = function(title, text = '', type = 'success'){ //success , danger , warning, info
    let icon = type == 'success' ? 'feather icon-check-circle' : 'feather icon-info';
    new PNotify({
        title: title,
        text: text && `<p>${text}</p>`,
        icon: icon,
        type: type
    });
}

//Notify Confirm
$(document).on('click', '.notify-confirm', function(e){
    e.preventDefault();
    var url_target = $(this).attr("href");
    var notify_text = $(this).data("text");
    var notice = new PNotify({
        title: $(this).data("title") || 'Xác nhận',
        text: notify_text ? `<p>${notify_text}</p>` : '<p>Bạn có muốn xóa dòng này?</p>',
        hide: false,
        type: 'warning',
        confirm: {
            confirm: true,
            buttons: [
                {
                    text: 'Xác nhận',
                    addClass: 'btn btn-sm btn-primary'
                },
                {
                    text:'Hủy bỏ',
                    addClass: 'btn btn-sm btn-link'
                }
            ]
        },
        buttons: {closer: false,sticker: false},
        history: {history: false}
    })

    // On confirm
    notice.get().on('pnotify.confirm', function() {
        window.location.href = url_target;
    })

    // On cancel
    notice.get().on('pnotify.cancel', function() {
        // do nothing
    });
});

//Notify Prompt
$('.pnotify-prompt').on('click', function (e) {
    e.preventDefault();
    var notify_text = $(this).data("text");
    // Setup
    var notice = new PNotify({
        title: $(this).data("title") || 'Nhập vào',
        text: notify_text ? `<p>${notify_text}</p>` : '<p>Nhập giá trị vào bên dưới?</p>',
        hide: false,
        confirm: {
            prompt: true,
            buttons: [
                {
                    text: 'Xác nhận',
                    addClass: 'btn btn-sm btn-primary'
                },
                {
                    text: 'Hủy bỏ',
                    addClass: 'btn btn-sm btn-link'
                }
            ]
        },
        buttons: {closer: false,sticker: false},
        history: {history: false}
    });

    // On confirm
    notice.get().on('pnotify.confirm', function(e, notice, val) {
        notice.cancelRemove().update({
            title: 'You\'ve chosen a side',
            text: 'You want ' + $('<div/>').text(val).html() + '.',
            icon: 'icon-checkmark3',
            type: 'success',
            delay: 2000,
            hide: true,
            confirm: {
                prompt: false
            },
            buttons: {
                closer: true,
                sticker: true
            }
        });
    })

    // On cancel
    notice.get().on('pnotify.cancel', function(e, notice) {
        notice.cancelRemove().update({
            title: 'You don\'t want a side',
            text: 'No soup for you!',
            icon: 'icon-blocked',
            type: 'error',
            delay: 2000,
            hide: true,
            confirm: {
                prompt: false
            },
            buttons: {
                closer: true,
                sticker: true
            }
        });
    });
});