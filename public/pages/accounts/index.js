$(function() {
    let form = $('#form-add-account');
    let  url = form.data('url');

    form.on('submit', function(e) {
        e.preventDefault();

        $.post({
            url: url,
            beforeSend: swalLoading(),
            data: $(this).serializeArray(),
            success: function(response, a, b) {
                swalSuccess(response.message).then(() => {
                    $('#add_account').modal('hide');
                    form.trigger('reset');
                    $('#table-accounts tbody').html(response.view);
                });
            },
            error: function(error) {
                swalErrorAjax(error);
            }
        });
    });

    $(document).on('click', '.btn-resend', function(e) {
        e.preventDefault();

        let userId = $(this).data('id');

        swalQuestion('Send a new verification link to this user?', 'Resend Link?').then((result) => {
            if (result.isConfirmed) {
                $.post({
                    url: '/accounts/' + userId + '/resend',
                    beforeSend: swalLoading(),
                    success: function(response) {
                        swalSuccess(response.message).then(() => {
                            $('#table-accounts tbody').html(response.view);
                        });
                    },
                    error: function(error) {
                        swalErrorAjax(error);
                    }
                });
            }
        });
    });

    $(document).on('click', '.btn-delete', function(e) {
        e.preventDefault();

        let userId = $(this).data('id');

        swalQuestion('Once deleted, this user will no longer be able to access this system. Continue?', 'Delete User?').then((result) => {
            if (result.isConfirmed) {
                $.post({
                    type: "DELETE",
                    url: '/accounts/' + userId,
                    beforeSend: swalLoading(),
                    success: function(response) {
                        swalSuccess(response.message).then(() => {
                            $('#table-accounts tbody').html(response.view);
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