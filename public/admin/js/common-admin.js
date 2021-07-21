$(function () {
    //Init select input
    $('.select2').select2();

    // Multiple swithces
    var elem = Array.prototype.slice.call(document.querySelectorAll('.js-single'));
    elem.forEach(function(html) {
        var switchery = new Switchery(html, { color: '#4680ff', jackColor: '#fff' });
    });

    $(document).ready(function(){
        //Auto hide success & error alert after 3s
        hideSuccessMessage();
        hideErrorMessage();

        //Format Money
        window.formatMoney = function(str) {
            var strTemp = getNumber(str);
            if (strTemp.length <= 3)
                return strTemp;
            strResult = "";
            for (var i = 0; i < strTemp.length; i++)
                strTemp = strTemp.replace(",", "");
            var m = strTemp.lastIndexOf(".");
            if (m == -1) {
                for (var i = strTemp.length; i >= 0; i--) {
                    if (strResult.length > 0 && (strTemp.length - i - 1) % 3 == 0)
                        strResult = "," + strResult;
                    strResult = strTemp.substring(i, i + 1) + strResult;
                }
            } else {
                var strphannguyen = strTemp.substring(0, strTemp.lastIndexOf("."));
                var strphanthapphan = strTemp.substring(strTemp.lastIndexOf("."),
                        strTemp.length);
                var tam = 0;
                for (var i = strphannguyen.length; i >= 0; i--) {

                    if (strResult.length > 0 && tam == 4) {
                        strResult = "," + strResult;
                        tam = 1;
                    }

                    strResult = strphannguyen.substring(i, i + 1) + strResult;
                    tam = tam + 1;
                }
                strResult = strResult + strphanthapphan;
            }
            return strResult;
        }

        function getNumber(str) {
            var count = 0;
            for (var i = 0; i < str.length; i++) {
                var temp = str.substring(i, i + 1);
                if (!(temp == "," || temp == "." || (temp >= 0 && temp <= 9))) {
                    alert('Giá trị nhập vào phải là số');
                    return str.substring(0, i);
                }
                if (temp == " ")
                    return str.substring(0, i);
                if (temp == ".") {
                    if (count > 0)
                        return str.substring(0, ipubl_date);
                    count++;
                }
            }
            return str;
        }

        window.showErrorMessage = function(message) {
            $('.alert.alert-danger .error-message').empty().html(message);
            $('.alert.alert-danger').fadeIn();
            scrollToTop();
        }
        window.clearMessage = function() {
            hideSuccessMessage();
            hideErrorMessage();
        }

        window.scrollToElement = function(element, delay = 20, time = 500, margin = 10) {
            $("html, body").delay(delay).animate({
                scrollTop: element.offset().top - margin
            }, time);
        }
    
    });
    
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
            text: text,
            icon: icon,
            type: type
        });
    }

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

    readURL = function(input, element) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                element.attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    timeSince = function(date) {

        var seconds = Math.floor((new Date() - date) / 1000);
      
        var interval = seconds / 31536000;
      
        if (interval > 1) {
          return Math.floor(interval) + " năm trước";
        }
        interval = seconds / 2592000;
        if (interval > 1) {
          return Math.floor(interval) + " tháng trước";
        }
        interval = seconds / 86400;
        if (interval > 1) {
          return Math.floor(interval) + " ngày trước";
        }
        interval = seconds / 3600;
        if (interval > 1) {
          return Math.floor(interval) + " giờ trước";
        }
        interval = seconds / 60;
        if (interval > 1) {
          return Math.floor(interval) + " phút trước";
        }
        return Math.floor(seconds) + " giây trước";
    }

    $('#datatable').DataTable({
        filter:true,
        fixedHeader: {
            headerOffset: 50,
        },
        bStateSave: true,
        "oLanguage": {
            "sInfo":         "Hiển thị _START_ đến _END_ của _TOTAL_ dòng",
            "sInfoEmpty":      "Hiển thị 0 đến 0 của 0 dòng",
            "sLengthMenu":     "Hiển thị _MENU_ dòng",
            "sEmptyTable":     "Không có dữ liệu",
            "sSearch":         "Tìm kiếm:",
            "sProcessing":     "Đang tải...",
            "oPaginate": {
                "sFirst":      "Trang đầu",
                "sLast":       "Trang cuối",
                "sNext":       "Trang kế",
                "sPrevious":   "Trang trước"
            }
        }
    });

    //Datatable server side
    showDataTableServerSide = function(element, ajax_url, columns){
        element.DataTable({
            fixedHeader: {
                headerOffset: 50,
            },
            destroy: true,
            processing: true,
            serverSide: true,
            filter: true,
            // sort:true,
            // aaSorting: [[0, 'desc']],
            bStateSave: true,
            ajax: {
                "url": ajax_url,
                "type" : "GET",
            },
            columns: columns,
            "oLanguage": {
                "sInfo":         "Hiển thị _START_ đến _END_ của _TOTAL_ dòng",
                "sInfoEmpty":      "Hiển thị 0 đến 0 của 0 dòng",
                "sLengthMenu":     "Hiển thị _MENU_ dòng",
                "sEmptyTable":     "Không có dữ liệu",
                "sSearch":         "Tìm kiếm:",
                "sProcessing":     "Đang tải...",
                "oPaginate": {
                    "sFirst":      "Trang đầu",
                    "sLast":       "Trang cuối",
                    "sNext":       "Trang kế",
                    "sPrevious":   "Trang trước"
                }
            }
        });
    }

    convert_slug = function(title){
        var slug;

        //Đổi chữ hoa thành chữ thường
        slug = title.toLowerCase();
    
        //Đổi ký tự có dấu thành không dấu
        slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
        slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
        slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
        slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
        slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
        slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
        slug = slug.replace(/đ/gi, 'd');
        //Xóa các ký tự đặt biệt
        slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
        //Đổi khoảng trắng thành ký tự gạch ngang
        slug = slug.replace(/ /gi, "-");
        //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
        //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
        slug = slug.replace(/\-\-\-\-\-/gi, '-');
        slug = slug.replace(/\-\-\-\-/gi, '-');
        slug = slug.replace(/\-\-\-/gi, '-');
        slug = slug.replace(/\-\-/gi, '-');
        //Xóa các ký tự gạch ngang ở đầu và cuối
        slug = '@' + slug + '@';
        slug = slug.replace(/\@\-|\-\@|\@/gi, '');
        //In slug ra textbox có id “slug”

        $('input[name="slug"]').val(slug);
    }

});