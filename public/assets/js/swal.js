function swalLoading(text, title) {
    Swal.fire({
        title: title || 'Loading',
        html: text || '',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });
}

function swalSuccess(text, title) {
    return Swal.fire({
        title: title || 'Success',
        html: text || '',
        icon: 'success'
    });
}

function swalError(text, title) {
    return Swal.fire({
        title: title || 'Error',
        html: text || `There's something error, please try again later.`,
        icon: 'error'
    });
}

function swalQuestion(text, title) {
    return Swal.fire({
        title: title || 'Confirmation',
        html: text || `Do you want to continue?`,
        showCancelButton: true
    });
}

function swalErrorAjax(response, title) {
    let responseJSON = response.responseJSON;
    let message      = '';

    if (response.status == 419) {
        return Swal.fire({
            title: 'Session Expired!',
            html: 'Page will reload...',
            timer: 2500,
            timerProgressBar: true,
            willClose: () => {
                location.reload();
            }
        });
    }

    if (responseJSON?.errors) {
        Object.values(responseJSON.errors).forEach(value => {
            message += `- ${value} <br>`;
        });

    } else {
        message = responseJSON.message;
    }

    return Swal.fire({
        title: title || response.statusText,
        html: message || `There's something error, please try again later.`,
        icon: 'error',
        allowOutsideClick: false
    });
}