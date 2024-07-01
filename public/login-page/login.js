$(function() {
    $('#btn-login').on('click', function(e) {
        if ($('#form-login')[0].checkValidity()) {
            $(this).prop('disabled' ,true);
            $(this).html('<span class="spinner-border spinner-border-sm"></span> Logging in...');
            $('#form-login').trigger('submit');
        }
    });
});