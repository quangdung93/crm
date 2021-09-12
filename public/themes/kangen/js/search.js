$(function () {
    var search = {

        _init: function () {
            var self = this;

            // $.widget( "custom.catcomplete", $.ui.autocomplete, {
            //     _create: function() {
            //         this._super();
            //         this.widget().menu( "option", "items", "> :not(.ui-autocomplete-category)" );
            //     },
            //     _renderMenu: function(ul, items){
            //         var parent = this;

            //         self._renderSearch(parent, ul, items);
                
            //     }
            // }); 


            // $("#search-input").catcomplete({
            //     minLength: 0,
            //     delay: 500,
            //     selectFirst: true,
            //     source: function (request, response) {
            //         self.keyword = $("#search-input").val();
                    
            //         if(self.keyword.length >= 3){
            //             $.getJSON("/product/searchProduct?key=" + self.keyword, function (data) {
            //                 if (!data.status) {
            //                     $('.ui-autocomplete').hide();
            //                     self._handleIconLoading(false);
            //                     return false;
            //                 }
            
            //                 let result = [];
            //                 for(let k in data){
            //                     if(k !== 'status'){
            //                         result.push({'category': k, 'data': data[k]});
            //                     }
            //                 }
            
            //                 //Save keyword search in Localstorage
            //                 if(self.historyObj.keyword[0] !== self.keyword){
            //                     self._addHistorySearch(self.keyword);
            //                 }
            //                 response(result);
            //             });
            //         }
            //     },
            //     focus: function (event, ui) {
            //         event.preventDefault();
            //     },
            //     // select: function (event, ui) {
            //     //     return false;
            //     // },
            //     open: function () {

            //     },
            //     close: function () {

            //     }
            // });

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
        },
        

        _renderSearch: function(parent, ul, items){
            var self = this;
            $.each(items, function(index, item){
                var li = parent._renderItemData(ul, item.data);
                let count = Object.keys(item.data).length;
                if(count == 0){
                    return;
                }
                li.addClass('product-item-search');
                li.html(self._renderProductSearch(item.data));
            });
        },
        
        _renderProductSearch: function(products){
            let html = '',
                count = 0,
                limit = 3;
            $.each(products, function(index, product){
                var product_price_aggregate = product.product_price;
                count++;
                if(count > limit){
                    return;
                }
        
                if(product.product_status == 0){
                    var price_zone = product.stock_available == 1 ? '<div class="contact-price">Ngừng kinh doanh</div>' : ( product.stock_available === 0 ? '<div class="contact-price">Tạm hết hàng</div>' : '' ) ;
                }
                else if(product.product_quantity == 0 || product.product_price_new == 0){
                    var price_zone = `<div class="lbl-price"> <div class="pbi-price-new">${product_price_aggregate.lblPriceOld}</div> </div>`;
                }
                else{
                    var lbl_discount = product_price_aggregate.discount > 0 ? `<span class="lbl-promotion-percent">${product_price_aggregate.lblDiscount}</span>` : ``,
                    lbl_price_old = product_price_aggregate.discount > 0 ? `<span class="pbi-price-old">${product_price_aggregate.lblPriceOld}</span>` : ``,
                    price_zone = `<div class="lbl-price">
                        <div class="pbi-price-new">
                            ${product_price_aggregate.lblPriceNew}
                            ${lbl_discount}
                        </div> 
                        <div> ${lbl_price_old}</div>
                    </div>`;
                }
                html += `<a href="${URL_MAIN}${product.product_url}">
                    <img src='https://hita.com.vn/${product.product_image_thumb}'>
                    <div class="item">
                        <div class='product-info'>
                            <div class='product-name'>${product.highlightResult.product_name.value}</div>
                            <div class='product-code'>${product.highlightResult.product_code.value}</div>
                        </div> 
                        ${price_zone}
                    </div>
                </a>`;
            });
        
            if(products.length > limit){
                html += `<a class="view-all-search" href="/ket-qua-tim-kiem.html?key=${this.keyword}"><span>Xem thêm >></span></a>`;
            }
        
            return html;
        },
    };

    return search._init();

});