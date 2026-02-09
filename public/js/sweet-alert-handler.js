// // SweetAlert Session Handler

document.addEventListener('DOMContentLoaded', function() {
    // Success messages
    if (window.successMessage) {
    Swal.fire({
        title: `<bold><span>${window.successMessage}</bold></span>`,
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 1800,
        background: '#ffffff',
        width: '380px',
        padding: '1rem',
        customClass: {
            popup: 'shadow-xl rounded-xl border-sm'
        }
    });
}


    // Error messages
    if (window.errorMessage) {
        Swal.fire({
        title: `<bold><span>${window.successMessage}</bold></span>`,
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 1800,
        background: '#ffffff',
        width: '380px',
        padding: '1rem',
        customClass: {
            popup: 'shadow-xl rounded-xl border-sm'
        }
    });
    }

    // Info messages
    if (window.infoMessage) {
        Swal.fire({
        title: `<bold><span>${window.successMessage}</bold></span>`,
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 1800,
        background: '#ffffff',
        width: '380px',
        padding: '1rem',
        customClass: {
            popup: 'shadow-xl rounded-xl border-sm'
        }
    });
    }

    // Warning messages
    if (window.warningMessage) {
        Swal.fire({
        title: `<bold><span>${window.successMessage}</bold></span>`,
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 1800,
        background: '#ffffff',
        width: '380px',
        padding: '1rem',
        customClass: {
            popup: 'shadow-xl rounded-xl border-sm'
        }
    });
    }
});