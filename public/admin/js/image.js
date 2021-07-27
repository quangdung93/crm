//Handle upload avatar
$(document).on('click', '.btn-upload-file', function(e){
    e.preventDefault();
    let file_upload = $(this).closest('.box-image').find('.input-file');
    file_upload[0].click();
});

$(document).on('change','.input-file',function () {
    let image = $(this).closest('.box-image').find('.input-img');
    image.show();
    readURL(this, image);
});

$(document).on('click', '#upload-multiple-images', function(e){
    e.preventDefault();
    $('#input-multiple-images')[0].click();
});

$(document).on('change', '#input-multiple-images', function(e){
    var files = $(this)[0].files,
        imageable_type = $(this).data('type'),
        imageable_id = $(this).data('id'),
        
        listFiles = [];

    for(let i = 0; i < files.length; i++){
        if(files[i].size > 3364320){ 
            pushNotify('Cảnh báo', `Dung lượng ảnh (${files[i].name}) không được vượt quá 3Mb`, 'warning');
            return;
        }else{
            listFiles.push(files[i]);
        }
    }
    
    if(listFiles.length > 0) handleImageUpload(listFiles, imageable_id, imageable_type);
});

function handleImageUpload(files, imageable_id, imageable_type){
    var form_data = new FormData();

    for(let i = 0; i < files.length; i++){
        form_data.append('files[]', files[i]);
    }

    form_data.append('imageable_id', imageable_id);
    form_data.append('imageable_type', imageable_type);

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url: '/admin/images/upload',
        data: form_data,
        async: true,
        cache: false,
        contentType: false,
        processData: false,
        success: function (data) {
            if(data.status){
                let html = '';
                if(data.listFileName.length > 0){
                    $.each(data.listFileName, function(index, image) {
                        html += `<li data-id="${image.id}" data-path="${image.path}">
                            <img src="/${image.path}" alt=""><span class="remove-img">
                            <i class="feather icon-trash-2"></i></span>
                        </li>`;
                    });
                }
                $('.preview-images').append(html);
                pushNotify('Tải ảnh thành công!', text = '', type = 'success');
            }
            else{
                console.log('Error');
            }
        },
        error: function (n) {
            console.log('Error');
        }
    });
}

readURL = function(input, element) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            element.attr('src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
    }
}

$(document).on('click','.remove-img', function(){
    var self = $(this);
    var notice = new PNotify({
        title: 'Xác nhận',
        text: '<p>Bạn có muốn xóa ảnh này?</p>',
        hide: false,
        type: 'warning',
        confirm: {confirm: true,buttons: [{text: 'Xác nhận',addClass: 'btn btn-sm btn-primary'},{text:'Hủy bỏ',addClass: 'btn btn-sm btn-link'}]},
        buttons: {closer: false,sticker: false},
        history: {history: false}
    })

    // On confirm
    notice.get().on('pnotify.confirm', function() {
        let parent = self.parents(),
            id = parent.data('id'),
            path = parent.data('path');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: '/admin/images/delete',
            data: {id:id, path:path},
            context: this,
            success: function (data) {
                if(data.status){
                    self.closest('li').remove();
                    pushNotify('Xóa thành công!', text = '', type = 'success');
                }
            }
        });
    })

    // On cancel
    notice.get().on('pnotify.cancel', function() {
        // do nothing
    });
});