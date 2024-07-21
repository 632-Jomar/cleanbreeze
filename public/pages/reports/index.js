$(function() {
    $(document).on('change', '#year', function() {
        let year = $(this).val();

        $.get({
            url: `/api/reports/${year}/sales-reps`,
            beforeSend: swalLoading('Loading sales executive'),
            success: function(response) {
                $('#created_by').empty().append('<option value="">Select sales executive</option>');

                $.each(response, function(i, e) {
                    $('#created_by').append(`<option>${e.name}</option>`);
                });

                Swal.close();
            },
            error: function(error) {
                swalErrorAjax(error);
            }
        });
    });
});