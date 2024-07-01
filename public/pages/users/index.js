$(function() {
    $('#update_profile_form').on('submit', function(e) {
        e.preventDefault();

        $.post({
            url: '/profile/update-info',
            data: $(this).serializeArray(),
            beforeSend: swalLoading(),
            success: function(response, b, c) {
                swalSuccess(response.message);
            },
            error: function(error) {
                console.log(error);
                swalErrorAjax(error);
            }
        });
    });

    $('#update_password_form').on('submit', function(e) {
        e.preventDefault();

        $.post({
            url: '/profile/update-password',
            data: $(this).serializeArray(),
            beforeSend: swalLoading(),
            success: function(response) {
                swalSuccess(response.message);
                $('#update_password_form').trigger('reset');
            },
            error: function(error) {
                swalErrorAjax(error);
            }
        });
    });

    $('#upload_modal').on('hide.bs.modal', function() {
        $('#image_profile').val('');
    });

    $('#upload_form').on('submit', function(e) {
        e.preventDefault();

        let formData = new FormData(this);

        $.post({
            url: '/profile/upload-image',
            enctype: 'multipart/form-data',
            processData: false,
            contentType: false,
            data: formData,
            beforeSend: swalLoading(),
            success: function(response) {
                $('#img-profile-preview').attr('src', response.src);
                $('#upload_modal').modal('hide');
                swalSuccess(response.message);
            },
            error: function(error) {
                swalErrorAjax(error);
            }
        });
    });
});