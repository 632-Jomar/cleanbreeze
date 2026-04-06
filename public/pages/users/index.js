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

    $('#btn-delete-img-profile').on('click', function() {
        swalQuestion(null, 'Delete image profile?').then((result) => {
            if (result.isConfirmed) {
                $.post({
                    type: 'DELETE',
                    url: '/profile/delete-image',
                    beforeSend: swalLoading(),
                    success: function(response) {
                        $('#img-profile-preview').attr('src', response.src);
                        swalSuccess(response.message);
                    },
                    error: function(error) {
                        swalErrorAjax(error);
                    }
                });
            }
        })
    })
});