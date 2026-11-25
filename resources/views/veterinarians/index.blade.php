@extends('layouts.app')

@section('title', 'Veterinarians List')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
        </div>
    </section>

    @include('layouts.partials.msg')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-secondary" style="font-size: 1.75rem;font-weight: 500; line-height: 1.2; margin-bottom: 0.5rem;">
                            @yield('title')
                            <div class="float-right">
                                <a href="{{ route('veterinarians.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> New Veterinarian</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="veterinarians-table" class="table table-bordered table-hover" style="width:100%">
                                <thead class="text-primary">
                                    <tr>
                                        <th width="10px">ID</th>
                                        <th>Name</th>
                                        <th>Specialty</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Appointments</th>
                                        <th width="200px">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($veterinarians as $veterinarian)
                                        <tr>
                                            <td>{{ $veterinarian->id }}</td>
                                            <td>
                                                <strong>{{ $veterinarian->name }}</strong>
                                            </td>
                                            <td>{{ $veterinarian->specialty ?? '—' }}</td>
                                            <td>{{ $veterinarian->phone }}</td>
                                            <td>{{ $veterinarian->email }}</td>
                                            <td>
                                                <input type="checkbox" class="toggle-vet"
                                                       data-id="{{ $veterinarian->id }}"
                                                       data-toggle="toggle"
                                                       data-onstyle="success"
                                                       data-offstyle="danger"
                                                       data-on="Active"
                                                       data-off="Inactive"
                                                       data-size="small"
                                                       {{ $veterinarian->is_active ? 'checked' : '' }}>
                                            </td>
                                            <td>
                                                <span class="badge badge-info badge-pill">{{ $veterinarian->appointments_count }}</span>
                                            </td>
                                            <td>
                                                <a href="{{ route('veterinarians.show', $veterinarian) }}" class="btn btn-secondary btn-sm" title="View" aria-label="View veterinarian">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('veterinarians.edit', $veterinarian) }}" class="btn btn-info btn-sm" title="Edit">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                                <form action="{{ route('veterinarians.destroy', $veterinarian) }}" method="POST" class="d-inline delete-form"
                                                      data-confirm="Delete the veterinarian {{ $veterinarian->name }}?">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" title="Delete">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            {{ $veterinarians->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('css')
<link rel="stylesheet" href="{{ asset('backend/plugins/bootstrap4-toggle/css/bootstrap4-toggle.min.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('backend/plugins/bootstrap4-toggle/js/bootstrap4-toggle.min.js') }}"></script>
    <script>
        $(function () {
            $('#veterinarians-table').DataTable({
                language: {
                    processing: 'Processing...',
                    lengthMenu: 'Show _MENU_ entries',
                    zeroRecords: 'No matching records found',
                    emptyTable: 'No data available in table',
                    info: 'Showing _START_ to _END_ of _TOTAL_ entries',
                    infoEmpty: 'Showing 0 to 0 of 0 entries',
                    infoFiltered: '(filtered from _MAX_ total entries)',
                    search: 'Search:',
                    loadingRecords: 'Loading...',
                    paginate: {
                        first: 'First',
                        last: 'Last',
                        next: 'Next',
                        previous: 'Previous'
                    },
                    aria: {
                        sortAscending: ': activate to sort column ascending',
                        sortDescending: ': activate to sort column descending'
                    }
                },
                order: [[0, 'asc']],
                columnDefs: [
                    { targets: 7, orderable: false, searchable: false }
                ],
                responsive: true,
                autoWidth: false,
            });

            $('.toggle-vet').bootstrapToggle();

            $('.toggle-vet').change(function () {
                const $toggle = $(this);
                const id = $toggle.data('id');
                const isActive = $toggle.prop('checked');

                $.ajax({
                    url: '/veterinarians/' + id + '/estado',
                    method: 'PATCH',
                    data: {
                        is_active: isActive,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        if (!response.success) {
                            $toggle.bootstrapToggle('toggle');
                        }
                    },
                    error: function () {
                        $toggle.bootstrapToggle('toggle');
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Failed to update status. Please try again.',
                        });
                    }
                });
            });
        });
    </script>
@endpush

@include('partials.delete-confirm')