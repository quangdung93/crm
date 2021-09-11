$(function() {
    var cart = {
        /**
         * List elements
         */
        elements: {
            cartModal: '#cart-modal',
            successPopup: '.cart-alert-box',
            mobileQtyPopup: '.product-qty-popup',
            cartQty: '.cart-button-qty',
            cartTotal: '.modal-total-price',
            device: document.body.dataset.device,
        },

        /**
         * @private
         */
        _init: function () {
            var self = this;

            $(document).on('click', '.header-btn-cart', function (e) {
                e.preventDefault();
                $('#popup-cart').modal('show');
            });

            $(document).on('click', '.alert-cart', function(e){
                e.preventDefault();
                e.stopPropagation();
            });

            $(document).on('click', '#view-popup-cart-header', function(e){
                $(this).closest('.alert-cart').hide();
                $('#popup-cart').modal('show');
            });

            $(document).on('click', '.alert-cart .close', function(){
                $(this).closest('.alert-cart').hide();
            });

            $(document).on('keydown', 'input[type="number"].qty-input', function (event) {
                self._keyDownValidate($(this), event);
            });

            $(document).on('keyup', 'input[type="number"].qty-input', function () {
                self._keyUpValidate($(this));
            });

            $(document).on('focusout', 'input[type="number"].qty-input', function () {
                self._keyUpValidate($(this));

                self._updateItem($(this));
            });

            $(document).on('click', '.btn-cart-plus', function (e) {
                e.preventDefault();
                self._plusButtonHandle();
            });

            $(document).on('click', '.btn-cart-minus', function (e) {
                e.preventDefault();
                self._minusButtonHandle();
            });

            $(document).on('click', 'a.btn-addtocart', function (event) {
                event.preventDefault();
                self._handleAddToCart($(this));
            });

            $(document).on('click', '.add-cart-product-temp', function (event) {
                event.preventDefault();
                let product_id = $(this).data('id');

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: BASE_URL + 'cart/add_item',
                    data: {product_id:product_id, qty: 1},
                    type: 'POST',
                    success: function (response) {
                        self._addToCartSuccess(self, response);
                    }
                });
            });

        },

        _handleAddToCart: function (element) {
            var self = this,
                form = element.closest('form'),
                input = form.find('.qty-input'),
                url = form.data('action');
            // Call request add cart
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                data: form.serializeArray(),
                type: 'POST',
                success: function (response) {
                    self._addToCartSuccess(self, response);
                }
            });
            input.val(1);
        },

        _addToCartSuccess: function (self, response) {
            if(response.status){
                $('.popup-cart-content').html(response.html);
                $('.header-btn-cart .cart-icon span').text(response.qty);
                if($(window).width() > 768){
                    self._scrollToTop($('#header'));
                }
                $('.header-btn-cart .alert-cart').show();
            }
        },

        /**
         * Handle event remove item from cart
         *
         * @param element
         * @private
         */
        _removeItem: function (element) {
            var self = this,
                itemRow = element.closest('.modal-item'),
                url = element.data('action'),
                token = $('input[name="_token"]').val(),
                data = {_token: token, row_id: itemRow.data('row')},
                type = 'POST';

            self._showModalLoader();

            self._ajaxRequest(url, data, type, self._removeItemSuccess);

            self._hideModalLoader();
        },

        _removeItemSuccess: function (self, response) {
            var $cartQty = $(self.elements.cartQty);

            if (!response.cartQty) {
                $cartQty.addClass('hidden');
            }

            $cartQty.text(response.cartQty);
            $(self.elements.cartModal).html(response.html);
        },


        _updateItem: function (inputElement) {
            var self = this,
                itemsBlock = inputElement.closest('.modal-items'),
                itemRow = inputElement.closest('.modal-item'),
                url = itemsBlock.data('update-action'),
                token = $('input[name="_token"]').val(),
                data = {
                    _token: token,
                    row_id: itemRow.data('row'),
                    qty: inputElement.val()
                },
                type = 'POST';

            self._showModalLoader();

            self._ajaxRequest(url, data, type, self._updateItemSuccess);

            self._hideModalLoader();
        },

        /**
         * Handle after update item successful
         *
         * @param self
         * @param response
         * @private
         */
        _updateItemSuccess: function (self, response) {
            var newTotalPrice = $(response.html).find('.modal-total-price:first').text();
            $(self.elements.cartQty).text(response.cartQty);
            $(self.elements.cartTotal).text(newTotalPrice);
        },


        _ajaxRequest: function (url, data, type, successCallback) {
            var self = this;

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                data: data,
                type: type,
                success: function (response) {
                    if (response.success) {
                        successCallback(self, response);
                    }
                }
            });
        },

        _keyDownValidate: function (element, event) {
            var ignoreKeyCodes = [16, 69, 107, 109, 188, 189, 190],
                currentValue = element.val();

            if ($.inArray(event.keyCode, ignoreKeyCodes) >= 0) {
                event.preventDefault();

                currentValue = currentValue.replace(String.fromCharCode(event.keyCode), '');
                element.val(currentValue);
            }
        },

        _keyUpValidate: function (element) {
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
        },

        _plusButtonHandle: function() {
            var elementInput = $('.qty-input'),
                current_value = Number(elementInput.val()),
                new_value = 99;

            if (current_value < 99) {
                new_value = current_value + 1;
            }

            elementInput.val(new_value);
        },

        _minusButtonHandle: function (buttonElement) {
            var elementInput = $('.qty-input'),
                current_value = Number(elementInput.val()),
                new_value = 1;

            if (current_value > 1) {
                new_value = current_value - 1;
            }

            elementInput.val(new_value);
        },

        _scrollToTop: function () {
            $("html, body").animate({ scrollTop: 0 }, "slow");
        },
    };

    return cart._init();
});
