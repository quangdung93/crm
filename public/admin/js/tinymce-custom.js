//Custome TinyMCE add Youtube Popup
var dialogYoutubeLink =  {
    title: 'Chèn link Youtube',
    body: {
        type: 'panel',
        items: [
            {
                type: 'input',
                name: 'youtubedata',
                label: 'Nhập link youtube'
            }
        ]
    },
    buttons: [
        {
            type: 'cancel',
            name: 'closeButton',
            text: 'Cancel'
        },
        {
            type: 'submit',
            name: 'submitButton',
            text: 'Save',
            primary: true
        }
    ],
    onSubmit: function (api) {
        var data = api.getData();
        tinymce.activeEditor.execCommand('mceInsertContent', false, '<p>@' + data.youtubedata + '</p>');
        api.close();
    }
};

//Custome TinyMCE add Popup IMG
var dialogPopupImg =  {
    title: 'Thêm Cửa sổ hình ảnh',
    body: {
        type: 'panel',
        items: [
            {
                type: 'urlinput', 
                name: 'dialogPopupImg',
                filetype: 'file',
                label: 'Url',
              }
        ]
    },
    buttons: [
        {
            type: 'cancel',
            name: 'closeButton',
            text: 'Cancel'
        },
        {
            type: 'submit',
            name: 'submitButton',
            text: 'Save',
            primary: true
        }
    ],
    onSubmit: function (api) {
        var data = api.getData();
        tinymce.activeEditor.execCommand('mceInsertContent', false, '<a href="javascript:void(0)" class="dialog-popup-img" data-img="' + data.dialogPopupImg.value + '"> Xem ngay</a>');
        api.close();
        console.log(data.dialogPopupImg.value);
    }
};


function tinyMceProductSlider(listSliderName){
    return productSlider = {
        title: 'Thêm slide sản phẩm',
        body: {
            type: 'panel',
            items: [
                {
                    type: 'selectbox',
                    name: 'productslider',
                    label: 'Chọn slider sản phẩm',
                    items: listSliderName
                }
            ]
        },
        buttons: [
            {
                type: 'submit',
                name: 'submitButton',
                text: 'Chọn',
                primary: true
            }
        ],
        onSubmit: function (dialogApi) {
            var data = dialogApi.getData();
            tinymce.activeEditor.execCommand('mceInsertContent', false, '<p>' + data.productslider + '</p>');
            dialogApi.close();
        }
    };
}


//Init TinyMCE editor
tinymce.init({
    selector: "textarea.tinymce",
    min_height: 500,
    plugins: [
        "advlist autolink link image lists charmap print preview hr pagebreak",
        "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
        "table directionality emoticons paste fullscreen code autosave"
    ], //autosave => Confirm save when reload page
    
    //Custom link dofollow/nofollow
    rel_list: [
        {title: 'Dofollow', value: 'dofollow'},
        {title: 'Nofollow', value: 'nofollow'}
    ],
    paste_preprocess: function(plugin, args) { // Handle when paste
        args.content = args.content.replaceAll('dir="ltr"',''); //remove dir="ltr" when paste 
    },
    // paste_postprocess: function(plugin, args) { // Handle when paste (after DOM)
    //     console.log(args.node); // Print DOM
    //     args.node.setAttribute('id', '42');
    // },
    toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
    toolbar2:  "insertfile | link unlink | image table | forecolor backcolor | preview fullscreen code | insertyoutube tableofcontent productslider",
    image_advtab: true ,  // Show image advanced tab
    relative_urls: false, // Show full url image
    remove_script_host : false, // Show full url image
    image_caption: true, //Enable Caption Image
    file_picker_callback : function(callback, value, meta) {
        var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
        var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

        var cmsURL = URL_MAIN + 'laravel-filemanager?editor=' + meta.fieldname;
        if (meta.filetype == 'image') {
            cmsURL = cmsURL + "&type=Images";
        } else {
            cmsURL = cmsURL + "&type=Files";
        }

        tinyMCE.activeEditor.windowManager.openUrl({
            url : cmsURL,
            title : 'Filemanager',
            width : x * 0.9,
            height : y * 0.9,
            resizable : "yes",
            close_previous : "no",
            onMessage: (api, message) => {
                callback(message.content);
            }
        });
    },
    
    setup: function(editor) {
        //Add Youtube Button
        editor.ui.registry.addButton('insertyoutube', {
            icon: 'embed',
            tooltip: 'Youtube',
            onAction: function () {
                editor.windowManager.open(dialogYoutubeLink);
            }
        });
        //Add Table of content Button
        // editor.ui.registry.addButton('tableofcontent', {
        //     icon: 'toc',
        //     tooltip: 'Thêm mục lục',
        //     onAction: function () {
        //         if(confirm('Bạn muốn thêm phụ lục vào vị trí hiện tại?')){
        //             editor.insertContent('@mucluc');   
        //         }
        //     }
        // });

        //Add Product slider Button
        // editor.ui.registry.addButton('productslider', {
        //     icon: 'color-levels',
        //     tooltip: 'Thêm slider sản phẩm',
        //     onAction: function () {
        //         //Custome TinyMCE add Product Slider Into Post Popup
        //         var listSliderName = [];

        //         if($('.news_slide_product_id').length > 0){
        //             listSliderName = $('.news_slide_product_id').map(function(){
        //                 return {'text' : $(this).val(), 'value': $(this).val()};
        //             }).get();
        //         }

        //         if($('#tag-filter').length > 0){
        //             let text = $('#tag-filter').text();
        //             listSliderName.push({'text' : text, 'value' : text});
        //         }

        //         if(listSliderName.length > 0){
        //             editor.windowManager.open(tinyMceProductSlider(listSliderName));
        //         }
        //         else{
        //             alert('Không có slider sản phẩm');
        //         }
        //     }
        // });
    }
});