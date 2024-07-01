$(function() {
    let productId   = null;
    let selectedRow = null;

    $('.btn-edit').on('click', function(e) {
        e.preventDefault();

        productId   = $(this).data('id');
        selectedRow = $(this).closest('tr');

        $.get({
            url: '/products/' + productId,
            beforeSend: swalLoading(),
            success: function(product) {
                $('#product_name').val(product?.product_diameter?.product_type?.product_name?.product_brand?.brand);
                $('#product_type').val(product?.product_diameter?.product_type?.type);
                $('#product_type_id').val(product?.product_diameter?.product_type_id);
                $('#diameter').val(product?.product_diameter?.diameter);
                $('#price').val(product.price);

                Swal.close();
                $('#edit_product_modal').modal('show');
            },
            error: function(error) {
                swalErrorAjax(error);
            }
        });
    });

    $('#edit_product_form').on('submit', function(e) {
        e.preventDefault();

        $.post({
            type: 'PATCH',
            url: '/products/' + productId,
            data: $(this).serializeArray(),
            beforeSend: swalLoading(),
            success: function(response) {
                $('#edit_product_modal').modal('hide');
                swalSuccess(response.message);

                selectedRow.find('.product_diameter').html(response.data.product_diameter.diameter);
                selectedRow.find('.product_price').html(Number(response.data.price).toFixed(2));
            },
            error: function(error) {
                swalErrorAjax(error);
            }
        })
    });

    $('.btn-delete').on('click', function(e) {
        e.preventDefault();

        productId   = $(this).data('id');
        selectedRow = $(this).closest('tr');

        Swal.fire({
            title: 'Remove Product?',
            icon: 'error',
            showCancelButton: true
        }).then((result) => {
            if (result.isConfirmed) {
                $.post({
                    type: 'DELETE',
                    url: '/products/' + productId,
                    beforeSend: swalLoading(),
                    success: function(response) {
                        swalSuccess(response.message);
        
                        selectedRow.remove();
                        $('.product_number').each(function(i, e) {
                            $(e).html((i+1) + '.');
                        });
                    },
                    error: function(error) {
                        swalErrorAjax(error);
                    }
                });
            }
        });
    });
});