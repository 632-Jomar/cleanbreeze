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
});