// SweetAlert2 Helper Functions

/**
 * Confirm delete action
 * @param {HTMLFormElement} form - The form element to submit
 * @param {string} message - Custom message (optional)
 */
window.confirmDelete = function (
    form,
    message = "Data yang dihapus tidak dapat dikembalikan!"
) {
    event.preventDefault();

    Swal.fire({
        title: "Apakah Anda yakin?",
        text: message,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#ef4444",
        cancelButtonColor: "#6b7280",
        confirmButtonText: "Ya, Hapus!",
        cancelButtonText: "Batal",
        reverseButtons: true,
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    });

    return false;
};

/**
 * Show success message
 * @param {string} title - Title of the message
 * @param {string} text - Message text (optional)
 */
window.showSuccess = function (title, text = "") {
    Swal.fire({
        icon: "success",
        title: title,
        text: text,
        confirmButtonColor: "#0d9488",
        timer: 3000,
        timerProgressBar: true,
    });
};

/**
 * Show error message
 * @param {string} title - Title of the message
 * @param {string} text - Message text (optional)
 */
window.showError = function (title, text = "") {
    Swal.fire({
        icon: "error",
        title: title,
        text: text,
        confirmButtonColor: "#ef4444",
    });
};
