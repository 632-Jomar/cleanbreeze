$(function() {
    $('#quotation_form').on('submit', function(e) {
        e.preventDefault();

        Swal.fire({
            title: 'Confirmation',
            text: 'Please ensure all information is correct before submitting. Are you sure you want to submit?',
            icon: 'warning',
            showCancelButton: true,
            focusCancel: true
        }).then((result) => {
            if (result.isConfirmed) {
                $.post({
                    url: '/quotations',
                    data: $('#quotation_form').serializeArray(),
                    beforeSend: swalLoading(),
                    success: function(response) {
                        swalSuccess(response.message).then((result) => {
                            if (result.isConfirmed) {
                                location.replace('/quotations');
                            }
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