$(function () {
    // Evita reenviar la petición cuando el interruptor se revierte tras un error.
    let reverting = false;

    // Delegación sobre la tabla: funciona con la paginación de DataTables.
    $('#example1').on('change', '.toggle-class', function () {
        if (reverting) {
            return;
        }

        const $toggle = $(this);
        const elementType = $toggle.data('type');
        const elementId = $toggle.data('id');
        const estado = $toggle.prop('checked');
        let url;

        switch (elementType) {
            case 'clase':
                url = '/clases/' + elementId + '/estado';
                break;
            case 'user':
                url = '/users/' + elementId + '/estado';
                break;
            default:
                return;
        }

        $.ajax({
            type: 'PATCH',
            dataType: 'json',
            url: url,
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                estado: estado ? 1 : 0,
            },
            error: function () {
                // Deja el interruptor como estaba antes del intento fallido.
                reverting = true;
                $toggle.bootstrapToggle(estado ? 'off' : 'on');
                reverting = false;

                if (window.Swal) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Could not update the status',
                        text: 'Please try again.',
                    });
                }
            },
        });
    });
});
