$(function () {
    // MENU
    //Localstorage Menu State
    if(localStorage.getItem('menu_type') == 'mini'){
        $('.pcoded-wrapper').addClass('mini-menu');
        $('#mobile-collapse i').removeClass('icon-toggle-right');
        $('#mobile-collapse i').addClass('icon-toggle-left');
    }
    else{
        $('.pcoded-wrapper').removeClass('mini-menu');
        $('#mobile-collapse i').removeClass('icon-toggle-left');
        $('#mobile-collapse i').addClass('icon-toggle-right');
    }

    //Active Menu current (Menu Admin)
    $('ul.pcoded-submenu li').each(function(){
        if($(this).hasClass('active')){
            $(this).closest('.pcoded-hasmenu').addClass('pcoded-trigger');
        }
    });

    //END menu

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
                    alert('Gi?? tr??? nh???p v??o ph???i l?? s???');
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
    
    timeSince = function(date) {

        var seconds = Math.floor((new Date() - date) / 1000);
      
        var interval = seconds / 31536000;
      
        if (interval > 1) {
          return Math.floor(interval) + " n??m tr?????c";
        }
        interval = seconds / 2592000;
        if (interval > 1) {
          return Math.floor(interval) + " th??ng tr?????c";
        }
        interval = seconds / 86400;
        if (interval > 1) {
          return Math.floor(interval) + " ng??y tr?????c";
        }
        interval = seconds / 3600;
        if (interval > 1) {
          return Math.floor(interval) + " gi??? tr?????c";
        }
        interval = seconds / 60;
        if (interval > 1) {
          return Math.floor(interval) + " ph??t tr?????c";
        }
        return Math.floor(seconds) + " gi??y tr?????c";
    }

    $('.datatable-custom').DataTable({
        order: [[2, 'desc']],
        dom:
            '<"d-flex justify-content-between align-items-center header-actions mx-1 row mt-75"' +
            '<"col-lg-12 col-xl-6" l>' +
            '<"col-lg-12 col-xl-6 pl-xl-75 pl-0"<"dt-action-buttons text-xl-right text-lg-left text-md-right text-left d-flex align-items-center justify-content-lg-end align-items-center flex-sm-nowrap flex-wrap mr-1"<"mr-1"f>B>>' +
            '>t' +
            '<"d-flex justify-content-between mx-2 row mb-1"' +
            '<"col-sm-12 col-md-6"i>' +
            '<"col-sm-12 col-md-6"p>' +
            '>',
        language: {
            sLengthMenu: 'Hi???n th??? _MENU_',
            sInfo: "Hi???n th??? _START_ ?????n _END_ c???a _TOTAL_ d??ng",
            sInfoEmpty: "Hi???n th??? 0 ?????n 0 c???a 0 d??ng",
            search: 'T??m ki???m',
            searchPlaceholder: 'Nh???p t??n kh??a..',
            sEmptyTable: "Kh??ng c?? d??? li???u",
            sProcessing:     "??ang t???i...",
            oPaginate: {
                "sFirst":      "Trang ?????u",
                "sLast":       "Trang cu???i",
                "sNext":       "Trang k???",
                "sPrevious":   "Trang tr?????c"
            }
        },
        // Buttons with Dropdown
        buttons: [
            {
            text: 'Th??m m???i',
            className: 'add-new btn btn-primary mt-50',
            attr: {
                'data-toggle': 'modal',
                'data-target': '#modals-slide-in'
            },
            init: function (api, node, config) {
                $(node).removeClass('btn-secondary');
            }
            }
        ]
    });

    showDefaultDatatable = function(element) {
        element.DataTable({
            language: {
                sLengthMenu: 'Hi???n th??? _MENU_',
                sInfo: "Hi???n th??? _START_ ?????n _END_ c???a _TOTAL_ d??ng",
                sInfoEmpty: "Hi???n th??? 0 ?????n 0 c???a 0 d??ng",
                search: 'T??m ki???m',
                searchPlaceholder: 'Nh???p t??n kh??a..',
                sEmptyTable: "Kh??ng c?? d??? li???u",
                sProcessing:     "??ang t???i...",
                oPaginate: {
                    "sFirst":      "Trang ?????u",
                    "sLast":       "Trang cu???i",
                    "sNext":       "Trang k???",
                    "sPrevious":   "Trang tr?????c"
                }
            },
        });
    }

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
            language: {
                sLengthMenu: 'Hi???n th??? _MENU_',
                sInfo: "Hi???n th??? _START_ ?????n _END_ c???a _TOTAL_ d??ng",
                sInfoEmpty: "Hi???n th??? 0 ?????n 0 c???a 0 d??ng",
                search: 'T??m ki???m',
                searchPlaceholder: 'Nh???p t??n kh??a..',
                sEmptyTable: "Kh??ng c?? d??? li???u",
                sProcessing:     "??ang t???i...",
                oPaginate: {
                    "sFirst":      "Trang ?????u",
                    "sLast":       "Trang cu???i",
                    "sNext":       "Trang k???",
                    "sPrevious":   "Trang tr?????c"
                }
            },
        });
    }

    convert_slug = function(title){
        var slug;
        //?????i ch??? hoa th??nh ch??? th?????ng
        slug = title.toLowerCase();
    
        //?????i k?? t??? c?? d???u th??nh kh??ng d???u
        slug = slug.replace(/??|??|???|???|??|??|???|???|???|???|???|??|???|???|???|???|???/gi, 'a');
        slug = slug.replace(/??|??|???|???|???|??|???|???|???|???|???/gi, 'e');
        slug = slug.replace(/i|??|??|???|??|???/gi, 'i');
        slug = slug.replace(/??|??|???|??|???|??|???|???|???|???|???|??|???|???|???|???|???/gi, 'o');
        slug = slug.replace(/??|??|???|??|???|??|???|???|???|???|???/gi, 'u');
        slug = slug.replace(/??|???|???|???|???/gi, 'y');
        slug = slug.replace(/??/gi, 'd');
        //X??a c??c k?? t??? ?????t bi???t
        slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
        //?????i kho???ng tr???ng th??nh k?? t??? g???ch ngang
        slug = slug.replace(/ /gi, "-");
        //?????i nhi???u k?? t??? g???ch ngang li??n ti???p th??nh 1 k?? t??? g???ch ngang
        //Ph??ng tr?????ng h???p ng?????i nh???p v??o qu?? nhi???u k?? t??? tr???ng
        slug = slug.replace(/\-\-\-\-\-/gi, '-');
        slug = slug.replace(/\-\-\-\-/gi, '-');
        slug = slug.replace(/\-\-\-/gi, '-');
        slug = slug.replace(/\-\-/gi, '-');
        //X??a c??c k?? t??? g???ch ngang ??? ?????u v?? cu???i
        slug = '@' + slug + '@';
        slug = slug.replace(/\@\-|\-\@|\@/gi, '');
        //In slug ra textbox c?? id ???slug???

        $('input[name="slug"]').val(slug);
    }

});