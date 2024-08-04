$(function() {
    let formSummary = $('#form_summary');
    let tblSummary = $('#table_summary');

    $('.summary_input').on('change', function() {
        formSummary.trigger('submit');
    });

    formSummary.on('submit', function(e) {
        e.preventDefault();

        $.post({
            url: '/dashboard/summary-users',
            beforeSend: swalLoading(),
            data: formSummary.serializeArray(),
            success: function(response) {
                tblSummary.empty();
                tblSummary.html(response.view);
                Swal.close();
            },
            error: function(error) {
                swalErrorAjax(error);
            }
        });
    });
});