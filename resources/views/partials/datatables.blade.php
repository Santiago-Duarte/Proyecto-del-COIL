@push('js')
    <script>
        $(function () {
            $('#{{ $tableId }}').DataTable({
                language: {
                    processing: 'Procesando...',
                    lengthMenu: 'Mostrar _MENU_ entradas',
                    zeroRecords: 'No se encontraron resultados',
                    emptyTable: 'Ningún dato disponible en esta tabla',
                    info: 'Mostrando _START_ a _END_ de _TOTAL_ entradas',
                    infoEmpty: 'Mostrando 0 a 0 de 0 entradas',
                    infoFiltered: '(filtrado de _MAX_ entradas totales)',
                    search: 'Buscar:',
                    loadingRecords: 'Cargando...',
                    paginate: {
                        first: 'Primero',
                        last: 'Último',
                        next: 'Siguiente',
                        previous: 'Anterior'
                    },
                    aria: {
                        sortAscending: ': Activar para ordenar la columna de manera ascendente',
                        sortDescending: ': Activar para ordenar la columna de manera descendente'
                    }
                },
                order: [[0, 'asc']],
                columnDefs: [
                    { targets: {{ $actionsColumn }}, orderable: false, searchable: false }
                ]
            });
        });
    </script>
@endpush
