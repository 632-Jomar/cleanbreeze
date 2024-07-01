$(function() {
    $('.btn-delete').on('click', function() {
        let quotationId = $(this).data('id');

        Swal.fire({
            title: 'Remove Quotation?',
            icon: 'error',
            showCancelButton: true
        }).then((result) => {
            if (result.isConfirmed) {
                $.post({
                    type: 'DELETE',
                    url: '/quotations/' + quotationId,
                    beforeSend: swalLoading(),
                    success: function(response) {
                        swalSuccess(response.message).then((result) => {
                            location.reload();
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