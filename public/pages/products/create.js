$(function() {
    let productBrand = null;

    $('#product_brand_id').on('change', function() {
        let id = $(this).val();

        $.get({
            url: '/api/product-brands/' + id,
            beforeSend: swalLoading(),
            success: function(response) {
                productBrand = response;

                $('#product_name_datalist').empty();
                $('#product_type_datalist').empty();

                $.each(response.product_names, function(i, e) {
                    $('#product_name_datalist').append(`<option>${e.category_name}</option>`);
                });

                Swal.close();
            },
            error: function(error) {
                swalErrorAjax(error);

                $('#product_name_datalist').empty().val('');
                $('#product_type_datalist').empty().val('');
            }
        });
    });

    $('#product_name_list').on('change', function() {
        let selected = $(this).val();

        let productName = $.grep(productBrand.product_names, function(name) {
            return name.category_name == selected;
        })[0];

        $('#product_type_datalist').empty();

        $.each(productName.product_types, function(i, e) {
            $('#product_type_datalist').append(`<option>${e.type}</option>`);
        });
    });

    // Category
    $('#product_name_id').on('change', function() {
        $.get({
            url: '/api/product-names/' + $(this).val(),
            beforeSend: swalLoading(),
            success: function(response) {
                $('#product_type_id').empty().append('<option value="" disabled selected>Select type</option>');

                $.each(response.product_types, function(i, e) {
                    $('#product_type_id').append(`<option value="${e.id}">${e.type}</option>`);
                });

                Swal.close();
            },
            error: function(error) {
                swalErrorAjax(error);

                $('#product_type_id').empty().append('<option value="" disabled selected>Select type</option>');
            }
        });
    });

    $('.category-checkbox').on('change', function() {
        $(this).closest('.group-checkbox').find('.category-input').prop('disabled', !$(this).is(':checked')).val('');
    });

    $('#add_product_form').on('submit', function(e) {
        e.preventDefault();

        $.post({
            url: '/products',
            data: $(this).serializeArray(),
            beforeSend: swalLoading(),
            success: function(response) {
                swalSuccess(response.message);

                $('#add_product_form').trigger('reset');
                $('#product_name_datalist, #product_type_datalist').empty();

                $('#product_name_id').empty().append('<option value="" disabled selected>Select name</option>');
                $('#product_type_id').empty().append('<option value="" disabled selected>Select type</option>');

                $.each(response.product_names, function(i, e) {
                    $('#product_name_id').append(`<option value="${e.id}">${e.category_name}</option>`);
                });
            },
            error: function(error) {
                swalErrorAjax(error);
            }
        });
    });

    $('#add_category_form').on('submit', function(e) {
        e.preventDefault();

        $.post({
            url: '/products/category',
            data: $(this).serializeArray(),
            beforeSend: swalLoading(),
            success: function(response) {
                swalSuccess(response.message);

                $('#add_category_form').trigger('reset');
                $('#product_type_id').empty().append('<option value="" disabled selected>Select type</option>');

                $('.category-input').prop('disabled', true);
            },
            error: function(error) {
                swalErrorAjax(error);
            }
        });
    });
});