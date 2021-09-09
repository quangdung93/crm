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
                
                self._updateItem(buttonParentBlock.find('.qty-input'));
            });

            $(document).on('click', '.btn-cart-minus', function (e) {
                e.preventDefault();
                self._minusButtonHandle();

                self._updateItem(buttonParentBlock.find('.qty-input'));
            });

            $(document).on('click', '.btn-payment-guide', function (event) {
                event.preventDefault();
                if ($(this).hasClass('disable')) {
                    return false;
                }

                if ('mobile' === self.elements.device && !$(this).hasClass('btn-payment-mobile')) {
                    self._openMobileQtyPopup();
                    return false;
                }

                self._handleAddToCart($(this));
            });

            $(document).on('click','.btn-cart-product-temp', function(e){
                e.preventDefault();
                let product_id = $(this).data('id'),
                url_api = $('#footer').data('api'),
                url = url_api + '/cart/add_product_id';
                self._ajaxRequest(url, {product_id:product_id}, 'POST', self._addToCartSuccess);
            });

            $(document).on('click','.btn-total-suggest', function(e){
                e.preventDefault();
                let product_id = $(this).data('id');
                let suggest_id = $(this).data('suggest');
                let url = 'api/cart/add_suggest_product';
                self._ajaxRequest(url, {product_id:product_id,suggest_id:suggest_id}, 'POST', self._addToCartSuccess);
            });

            $(document).on('click', '.btn-buy-now', function (event) {
                event.preventDefault();
                if ($(this).hasClass('disable')) {
                    return false;
                }

                var form = $(this).closest('form.purchase-box__form'),
                    url = form.data('action'),
                    checkout = form.data('checkout');
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: url,
                    data: form.serializeArray(),
                    type: 'POST',
                    success: function (response) {
                        if (response.success) {
                            window.location.href = checkout;
                        }
                    }
                });
            });

            $(document).on('click', 'a.cart-button', function (e) {
                e.preventDefault();

                let path_name = window.location.pathname;
                if(path_name === '/checkout'){
                    window.location.href = path_name;
                    return;
                }

                if ($(this).hasClass('cart-alert-button')) {
                    self._hideAddedToCartPopup(e);
                }

                self._openMiniCart();
            });

            $(document).on('click', '.modal-cart-close', function () {
                self._hideMiniCart();
            });

            $(document).on('click', '.cart-alert-box .close', function (e) {
                self._hideAddedToCartPopup(e);
            });

            $(document).on('click', '.modal-item-info--remove', function () {
                self._removeItem($(this));
            });

            $(document).on('click', '.product-qty-popup .product-qty .close', self._hideMobileQtyPopup);
        },

        /**
         * Handle event add to cart
         *
         * @param buttonElement
         * @returns {boolean}
         * @private
         */
        _handleAddToCart: function (buttonElement) {
            if (buttonElement.hasClass('disable')) {
                return false;
            }

            var self = this,
                form = 'mobile' !== self.elements.device
                    ? buttonElement.closest('form.purchase-box__form')
                    : buttonElement.closest('.product-qty-popup').find('form.purchase-box__form'),
                input = form.find('.qty-input'),
                url = form.data('action');

            // Call request update cart
            self._ajaxRequest(url, form.serializeArray(), 'POST', self._addToCartSuccess);
            input.val(1);
        },

        /**
         * Handle after add item to cart successful
         *
         * @param self
         * @param response
         * @private
         */
        _addToCartSuccess: function (self, response) {
            var $cartQty = $(self.elements.cartQty);

            if ('mobile' !== self.elements.device) {
                self._scrollToTop();
            } else {
                self._hideMobileQtyPopup();
            }
            self._showAddedToCartPopup();

            if ($cartQty.hasClass('hidden')) {
                $cartQty.removeClass('hidden')
            }

            $cartQty.text(response.cartQty);
            $(self.elements.cartModal).html(response.html);
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

        /**
         * Handle after remove item successful
         *
         * @param self
         * @param response
         * @private
         */
        _removeItemSuccess: function (self, response) {
            var $cartQty = $(self.elements.cartQty);

            if (!response.cartQty) {
                $cartQty.addClass('hidden');
            }

            $cartQty.text(response.cartQty);
            $(self.elements.cartModal).html(response.html);
        },

        /**
         * Handle event update item
         *
         * @param inputElement
         * @private
         */
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

        /**
         * Call ajax request and handle success action
         *
         * @param url
         * @param data
         * @param type
         * @param successCallback
         * @private
         */
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

        /**
         * Show loading icon
         *
         * @private
         */
        _showModalLoader: function () {
            $('.modal-loader').removeClass('hidden');
        },

        /**
         * Hide loading icon
         *
         * @private
         */
        _hideModalLoader: function () {
            $('.modal-loader').addClass('hidden');
        },

        _openMobileQtyPopup: function () {
            $('.product-qty-popup').removeClass('hidden').fadeIn();
        },

        _hideMobileQtyPopup: function () {
            $('.product-qty-popup').addClass('hidden').fadeOut();
        },

        _openMiniCart: function () {
            $(this.elements.cartModal).show().removeClass('hidden').addClass('show').addClass('in');
            $('body').addClass('modal-open');
            $('body').append('<div class="modal-backdrop in"></div>');
        },

        _hideMiniCart: function () {
            $(this.elements.cartModal).hide().removeClass('in').removeClass('show');
            $('body').removeClass('modal-open');
            $('body .modal-backdrop').remove();
        },

        _showAddedToCartPopup: function () {
            $(this.elements.successPopup).removeClass('hidden');
        },

        _hideAddedToCartPopup: function (event) {
            event.preventDefault();
            $(this.elements.successPopup).addClass('hidden');
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
