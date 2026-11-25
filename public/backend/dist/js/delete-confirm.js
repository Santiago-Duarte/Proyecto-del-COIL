$(function () {
    $(document).on('submit', '.delete-form', function (event) {
        event.preventDefault();

        const form = this;
        const message = form.dataset.confirm || 'This record will be permanently deleted.';

        Swal.fire({
            title: 'Are you sure?',
            text: message,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete',
            cancelButtonText: 'Cancel',
        }).then(function (result) {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
});
