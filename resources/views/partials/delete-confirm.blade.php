<form id="form-eliminar-registro" action="" method="POST" class="d-none">
    @csrf
    @method('DELETE')
</form>

@push('js')
    <script>
        $(function () {
            $('.btn-eliminar').on('click', function () {
                const url = $(this).data('url');

                Swal.fire({
                    icon: 'warning',
                    title: '¿Estás seguro?',
                    text: 'Este registro se eliminará definitivamente',
                    showCancelButton: true,
                    confirmButtonText: 'Aceptar',
                    cancelButtonText: 'Cancelar',
                    confirmButtonColor: '#007bff',
                    cancelButtonColor: '#dc3545'
                }).then(function (result) {
                    if (result.isConfirmed) {
                        $('#form-eliminar-registro').attr('action', url).trigger('submit');
                    }
                });
            });
        });
    </script>
@endpush
