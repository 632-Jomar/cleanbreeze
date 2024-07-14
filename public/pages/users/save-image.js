$(function() {
    var $croppieContainer = $('#croppie-container');
    var $uploadInput      = $('#upload');
    var $saveImageButton  = $('#btn-save-img-profile');

    var croppieInstance = null;

    $uploadInput.on('change', function (event) {
        if (this.files && this.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $croppieContainer.show();
                $saveImageButton.show();

                croppieInstance = $croppieContainer.croppie({
                    viewport: { width: 200, height: 200, type: 'circle' },
                    boundary: { width: 300, height: 300 },
                    showZoomer: false
                })

                croppieInstance.croppie('bind', {
                    url: e.target.result
                });
            };

            reader.readAsDataURL(event.target.files[0]);

        } else {
            $croppieContainer.hide();
            $saveImageButton.hide();

            if (croppieInstance) {
                croppieInstance.croppie('destroy');
            }
        }
    });

    $('#upload_modal').on('hidden.bs.modal', function() {
        $uploadInput.val('');
        croppieInstance.croppie('destroy');
        $saveImageButton.hide();
    });

    $saveImageButton.on('click', function () {
        try {
            croppieInstance.croppie('result', {
                type: 'canvas',
                size: 'viewport',
                format: 'png',
                quality: 1
            }).then(function (resp) {
                $.ajax({
                    url: '/profile/upload-image',
                    type: 'POST',
                    data: { image_profile: resp },
                    beforeSend: swalLoading(),
                    success: function (response) {
                        $('#img-profile-preview').attr('src', response.src);
                        $('#upload_modal').modal('hide');
                        swalSuccess(response.message);
                    },
                    error: function (error) {
                        swalErrorAjax(error);
                    }
                });
            });
        } catch (error) {
            swalError("There's something error while uploading image.");
        }
    });
})