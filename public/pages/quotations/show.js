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
                    url: location.href,
                    type: 'PATCH',
                    data: $('#quotation_form').serializeArray(),
                    beforeSend: swalLoading(),
                    success: function(response) {
                        console.log('response', response);
                        swalSuccess(response.message).then((result) => {
                            if (result.isConfirmed) {
                                location.replace('/quotations');
                            }
                        });
                    },
                    error: function(error) {
                        console.log('error', error);
                        swalErrorAjax(error);
                    }
                });
            }
        });
    });

    $('#btn-approve').on('click', function(e) {
        e.preventDefault();

        let id = $(this).data('id');

        Swal.fire({
            title: 'Approve quotation?',
            icon: 'warning',
            showCancelButton: true
        }).then((result) => {
            if (result.isConfirmed) {
                $.post({
                    url: `/quotations/${id}/approve`,
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
    })
});