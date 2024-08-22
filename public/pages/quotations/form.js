$(function() {
    let quotationId = $('#quotation_id').val() ?? '';

    let productComputation = {
        qty: 0,
        price: 0,

        powerPrice: 0,
        mountPrice: 0,
        ledPrice: 0,

        itemDiv: null,

        initItem(el) {
            this.itemDiv = $(el).closest('.item-div');
            this.qty     = Number(this.itemDiv.find('.input-quantity').val()) || 0;
            this.price   = Number(this.itemDiv.find('.input-price').val()) || 0;

            this.powerPrice = Number(this.itemDiv.find('.power-price').val()) || 0;
            this.mountPrice = Number(this.itemDiv.find('.mount-price').val()) || 0;
            this.ledPrice   = Number(this.itemDiv.find('.led-price').val()) || 0;

            this.itemTotal();
        },

        itemSubTotal() {
            let result = this.qty * this.price;

            this.itemDiv.find('.input-subtotal').val(result);
            return result;
        },

        itemTotal() {
            let result = this.itemSubTotal() + this.powerPrice + this.mountPrice + this.ledPrice;
            this.itemDiv.find('.input-total-price').val(result);

            summary.itemGrandTotal();
        },
    };

    let items = {
        index: $('.item-div').length,

        initButtons() {
            $(document).on('click', '#btn-add-item', function(e) {
                e.preventDefault();

                items.add();
            });

            $(document).on('click', '.btn-remove-item', function(e) {
                e.preventDefault();

                items.remove(this);
            });
        },

        add() {
            this.index++;
            $('#product-items').append(this.template());
            productItem.init();
        },

        remove(el) {
            $(el).closest('.item-div').remove();
            this.index--;

            this.refreshNumbering();
            summary.itemGrandTotal();
        },

        refreshNumbering() {
            $('.item-number').each(function(i) {
                $(this).html(i + 1);
            });
        },

        template() {
            return `<div class="item-div mb-3">
                <div class="row mb-1">
                    <div class="col-6">Item #<span class="item-number">${this.index}</span></div>
                    <div class="col-6 text-right">
                        <button type="button" class="btn btn-danger btn-sm btn-remove-item" tabindex="-1">
                            <i class="fa fa-trash"></i> Remove Item
                        </button>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-sm">
                        <tr class="bg-info">
                            <td width="15%" class="align-middle text-center">Brand</td>
                            <td width="16%" class="align-middle text-center">Product</td>
                            <td width="16%" class="align-middle text-center">Type</td>
                            <td width="16%" class="align-middle text-center">Description</td>
                            <td width="20%" class="align-middle text-center">Color</td>
                            <td width="7%" class="align-middle text-center">Qty</td>
                            <td width="10%" class="align-middle text-center">Price (PHP)</td>
                        </tr>

                        <tr>
                            <td>
                                <select style="min-width: 100px" class="form-control form-control-sm mb-2 select-brand" required>
                                    <option value="" disabled selected>Select brand</option>
                                </select>
                            </td>

                            <td>
                                <select style="min-width: 100px" class="form-control form-control-sm select-product" required>
                                    <option value="" disabled selected>Select category</option>
                                </select>
                            </td>

                            <td>
                                <select style="min-width: 100px" class="form-control form-control-sm select-type" required>
                                    <option value="" disabled selected>Select type</option>
                                </select>
                            </td>

                            <td>
                                <select name="product_id[]" style="min-width: 100px" class="form-control form-control-sm select-description" required>
                                    <option value="" disabled selected>Select product</option>
                                </select>
                            </td>

                            <td><input name="color[]" style="min-width: 100px" type="text" class="form-control form-control-sm text-right input-color"></td>
                            <td><input name="quantity[]" style="min-width: 60px" type="number" step="1" min="0" class="form-control form-control-sm text-right input-quantity has-spin"></td>
                            <td>
                                <input style="min-width: 100px" type="number" class="form-control form-control-sm text-right input-subtotal" readonly>
                                <input type="hidden" class="input-price" readonly>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="7">
                                <table class="table table-bordered table-sm">
                                    <tr class="bg-info">
                                        <td class="align-middle text-center">Motor & Power</td>
                                        <td class="align-middle text-center">Mount</td>
                                        <td class="align-middle text-center">LED</td>
                                        <td class="align-middle text-center">Warranty</td>
                                        <td class="align-middle text-center">Total Product Price</td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <select name="voltage_id[]" class="form-control form-control-sm select-power">
                                                <option value="" selected>Select voltage</option>
                                            </select>

                                            <input type="hidden" class="power-price">
                                        </td>

                                        <td>
                                            <select name="extension_id[]" class="form-control form-control-sm select-mount">
                                                <option value="" selected>Select extension</option>
                                            </select>

                                            <input type="hidden" class="mount-price">
                                        </td>

                                        <td>
                                            <select name="led_light_id[]" class="form-control form-control-sm select-led">
                                                <option value="" selected>Select LED</option>
                                            </select>

                                            <input type="hidden" class="led-price">
                                        </td>

                                        <td><input name="warranty[]" type="text" class="form-control form-control-sm text-right" required></td>
                                        <td><input type="number" class="form-control form-control-sm text-right input-total-price" readonly></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>`;
        }
    };

    let productItem = {
        brands: null,

        init() {
            if (! this.brands) {
                $.get({
                    url: '/api/product-brands',
                    beforeSend: swalLoading(),
                    success: function(response) {
                        productItem.brands = response;

                        $.each(productItem.brands, function(i, e) {
                            $('.select-brand:last').append(`<option value="${e.id}">${e.brand}</option>`);
                        });

                        Swal.close();
                    }
                });

            } else {
                $.each(productItem.brands, function(i, e) {
                    $('.select-brand:last').append(`<option value="${e.id}">${e.brand}</option>`);
                });
            }
        },

        initDropdowns() {
            this.onChangeBrand();
            this.onChangeProductName();
            this.onChangeType();
            this.onChangeProduct();
            this.onChangeQuantity();
            this.onChangePower();
            this.onChangeMount();
            this.onChangeLed();
        },

        empty: {
            product(el) { productItem.target.product(el).empty().append('<option value="" disabled selected>Select category</option>') },
            type(el)    { productItem.target.type(el).empty().append('<option value="" disabled selected>Select type</option>') },
            descr(el)   { productItem.target.descr(el).empty().append('<option value="" disabled selected>Select product</option>') },

            power(el)   { productItem.target.power(el).empty().append('<option value="" selected>Select voltage</option>') },
            mount(el)   { productItem.target.mount(el).empty().append('<option value="" selected>Select extension</option>') },
            led(el)     { productItem.target.led(el).empty().append('<option value="" selected>Select LED</option>') },
        },

        target: {
            product(el) { return $(el).closest('.item-div').find('.select-product'); },
            type(el)    { return $(el).closest('.item-div').find('.select-type'); },
            descr(el)   { return $(el).closest('.item-div').find('.select-description'); },
            power(el)   { return $(el).closest('.item-div').find('.select-power'); },
            mount(el)   { return $(el).closest('.item-div').find('.select-mount'); },
            led(el)     { return $(el).closest('.item-div').find('.select-led'); }
        },

        onChangeBrand() {
            $(document).on('change', '.select-brand', function(e) {
                let id = $(this).val();
                let el = this;

                productItem.empty.product(this);
                productItem.target.product(this).val('').trigger('change');

                $.get({
                    url: `/api/product-names/${id}/brand`,
                    beforeSend: swalLoading(),
                    success: function(response) {
                        $.each(response, function(i, e) {
                            productItem.target.product(el).append(`<option value="${e.id}">${e.category_name}</option>`);
                        });

                        Swal.close();
                    }
                });
            });
        },

        onChangeProductName() {
            $(document).on('change', '.select-product', function(e) {
                let id = $(this).val();
                let el = this;

                productItem.empty.type(this);
                productItem.target.type(this).val('').trigger('change');

                if (id) {
                    $.get({
                        url: `/api/product-types/${id}/name`,
                        beforeSend: swalLoading(),
                        success: function(response) {
                            $.each(response, function(i, e) {
                                productItem.target.type(el).append(`<option value="${e.id}">${e.type}</option>`);
                            });
    
                            Swal.close();
                        }
                    });
                }
            });
        },

        onChangeType() {
            $(document).on('change', '.select-type', function() {
                let id = $(this).val();
                let el = this;

                productItem.empty.descr(this);
                productItem.empty.power(this);
                productItem.empty.mount(this);
                productItem.empty.led(this);

                $(this).closest('.item-div').find('.input-price, .power-price, .mount-price, .led-price').val(0);
                productComputation.initItem(this);

                if (id) {
                    $.get({
                        url: `/api/product-types/${id}`,
                        beforeSend: swalLoading(),
                        success: function(response) {
                            $.each(response.products, function(i, e) {
                                productItem.target.descr(el).append(`<option value="${e.id}">${e.diameter}</option>`);
                            });

                            $.each(response.product_voltages, function(i, e) {
                                productItem.target.power(el).append(`<option value="${e.id}">${e.voltage}</option>`);
                            });

                            $.each(response.product_extensions, function(i, e) {
                                productItem.target.mount(el).append(`<option value="${e.id}">${e.extension}</option>`);
                            });

                            $.each(response.product_led_lights, function(i, e) {
                                productItem.target.led(el).append(`<option value="${e.id}">${e.led}</option>`);
                            });

                            Swal.close();
                        }
                    });
                }
            });
        },

        onChangeProduct() {
            $(document).on('change', '.select-description', function() {
                let id = $(this).val();
                let el = this;

                if (id) {
                    $.get({
                        url: `/api/products/${id}`,
                        beforeSend: swalLoading(),
                        success: function(response) {
                            $(el).closest('.item-div').find('.input-price').val(response.price);
                            Swal.close();

                            productComputation.initItem(el);
                        },
                        error: function(error) {
                            swalErrorAjax(error);
                        }
                    });
                }
            });
        },

        onChangeQuantity() {
            $(document).on('change', '.input-quantity', function() {
                productComputation.initItem(this);
            });
        },

        onChangePower() {
            $(document).on('change', '.select-power', function() {
                let id = $(this).val();
                let el = this;

                $.get({
                    url: `/api/product-voltages/${id}`,
                    success: function(response) {
                        $(el).closest('.item-div').find('.power-price').val(response.price);
                        productComputation.initItem(el);
                    }
                });
            });
        },

        onChangeMount() {
            $(document).on('change', '.select-mount', function() {
                let id = $(this).val();
                let el = this;

                $.get({
                    url: `/api/product-extensions/${id}`,
                    success: function(response) {
                        $(el).closest('.item-div').find('.mount-price').val(response.price);
                        productComputation.initItem(el);
                    }
                });
            });
        },

        onChangeLed() {
            $(document).on('change', '.select-led', function() {
                let id = $(this).val();
                let el = this;

                $.get({
                    url: `/api/product-leds/${id}`,
                    success: function(response) {
                        $(el).closest('.item-div').find('.led-price').val(response.price);
                        productComputation.initItem(el);
                    }
                });
            });
        },
    };

    let paymentDetails = {
        initOnChange() {
            $('.payment-input-group').on('change', function() {
                paymentDetails.init();
            });
        },
    
        init() {
            let discount   = Number($('#discount').val()) || 0;
            let subtotal   = Number($('#subtotal').val()) || 0;
            let isVat      = Number($('#is_vat:checked').val()) || 0;
    
            let vat = 0;
            let total = 0;
            let grandTotal = 0;
    
            if (isVat) {
                vat = (subtotal - discount) * 0.12;
            }
    
            total = subtotal + vat - discount;
            grandTotal = total;
    
            if ($('#payment_method').val() == 'Credit Card Online Payment') {
                grandTotal = total + (total * 0.04); 
            }
    
            $('#input_vat').val(vat);
            $('#total').val(total);
            $('#grand_total').val(grandTotal.toFixed(2));
        }
    };

    let summary = {
        init() {
            $(document).on('click', '#btn-add-other', function(e) {
                e.preventDefault();

                summary.addRow();
            });

            $(document).on('click', '.btn-remove-other', function(e) {
                e.preventDefault();

                summary.removeRow(this);
            });

            $(document).on('change', '.summary-input-group', function(e) {
                e.preventDefault();

                summary.compute();
            });
        },

        compute() {
            let laborCost    = Number($('#labor_cost').val()) || 0;
            let materialCost = Number($('#material_cost').val()) || 0;
            let mobilization = Number($('#mobilization').val()) || 0;
            let otherInstall = Number($('#other_install').val()) || 0;
            let deliveryFee  = Number($('#delivery_fee').val()) || 0;

            let totalProductCost = Number($('#total_product_cost').val()) || 0;

            let sum = laborCost + materialCost + mobilization + otherInstall + deliveryFee;

            $('.input-other').each(function(i, e) {
                sum += Number($(e).val());
            });

            $('#total_other_charges').val(sum);
            $('#subtotal').val(sum + totalProductCost).trigger('change');
        },

        itemGrandTotal() {
            let sum = 0;
            let totalOtherCharges = Number($('#total_other_charges').val());
            
            $('.input-total-price').each(function(i, e) {
                sum += Number($(e).val());
            });

            $('#total_product_cost').val(sum).trigger('change');
            $('#subtotal').val(sum + totalOtherCharges);
        },

        addRow() {
            $('#other-div').append(`<div class="row align-items-center mb-2">
                <div class="col-1"><button type="button" class="btn btn-danger btn-sm btn-remove-other" tabindex="-1"><i class="fa fa-trash"></i></button></div>
                <div class="col-7"><input name="misc_description[]" type="text" class="form-control" placeholder="Description" required></div>
                <div class="col-4"><input name="misc_price[]" type="number" class="form-control text-right input-other summary-input-group" placeholder="0" required></div>
            </div>`);
        },

        removeRow(el) {
            $(el).closest('.row').remove();
            this.compute();
        }
    };

    summary.init();
    items.initButtons();
    productItem.initDropdowns();
    paymentDetails.initOnChange();

    $('#summernote').summernote({
        height: 350,
        callbacks: {
            onImageUpload: function(files) {
                uploadImage(files[0]);
            },
        },
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['fullscreen', 'help']]
          ]
    });

    let uploadImage = (file) => {
        let data = new FormData();
        data.append("file", file);
        data.append("image_prefix", $('#image_prefix').val());

        $.ajax({
            url: "/quotations/upload-image?quotation_id=" + quotationId,
            method: "POST",
            data: data,
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: swalLoading(),
            success: function(response) {
                $('#summernote').summernote('insertImage', response.url);
                $('#image_prefix').val(response.prefix);
                Swal.close();
            },
            error: function(error) {
                swalErrorAjax(error);
            }
        });
    };
});