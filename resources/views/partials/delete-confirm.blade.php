<form id="form-delete-record" action="" method="POST" class="d-none">
    @csrf
    @method('DELETE')
</form>

@push('scripts')
    <script>
        $(function () {
            $('.btn-delete').on('click', function () {
                const url = $(this).data('url');
                const name = $(this).data('name') || 'this record';

                Swal.fire({
                    icon: 'warning',
                    title: 'Are you sure?',
                    text: `You are about to delete "${name}". This action cannot be undone.`,
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it',
                    cancelButtonText: 'Cancel',
                    confirmButtonColor: '#007bff',
                    cancelButtonColor: '#dc3545'
                }).then(function (result) {
                    if (result.isConfirmed) {
                        $('#form-delete-record').attr('action', url).trigger('submit');
                    }
                });
            });
        });
    </script>
@endpush