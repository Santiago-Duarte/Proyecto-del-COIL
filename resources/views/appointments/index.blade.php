@extends('layouts.app')

@section('title', 'Appointments List')

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
                                <a href="{{ route('appointments.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> New Appointment</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="appointments-table" class="table table-bordered table-hover" style="width:100%">
                                <thead class="text-primary">
                                    <tr>
                                        <th width="10px">ID</th>
                                        <th>Date & Time</th>
                                        <th>Pet</th>
                                        <th>Owner</th>
                                        <th>Veterinarian</th>
                                        <th>Reason</th>
                                        <th>Status</th>
                                        <th width="200px">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($appointments as $appointment)
                                        <tr>
                                            <td>{{ $appointment->id }}</td>
                                            <td>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('M j, Y g:i A') }}</td>
                                            <td>
                                                <a href="{{ route('pets.show', $appointment->pet) }}" class="font-weight-bold text-decoration-none">
                                                    {{ $appointment->pet->name }}
                                                </a>
                                                <br>
                                                <small class="text-muted">{{ $appointment->pet->species }}</small>
                                            </td>
                                            <td>{{ $appointment->pet->owner->name }}</td>
                                            <td>{{ $appointment->veterinarian->name }}</td>
                                            <td>{{ Str::limit($appointment->reason, 60) }}</td>
                                            <td>
                                                <select class="form-control form-control-sm status-select"
                                                        data-id="{{ $appointment->id }}"
                                                        style="width: auto; display: inline-block;">
                                                    <option value="Pending" {{ $appointment->status === 'Pending' ? 'selected' : '' }}>Pending</option>
                                                    <option value="In Consultation" {{ $appointment->status === 'In Consultation' ? 'selected' : '' }}>In Consultation</option>
                                                    <option value="Attended" {{ $appointment->status === 'Attended' ? 'selected' : '' }}>Attended</option>
                                                </select>
                                            </td>
                                            <td>
                                                <a href="{{ route('appointments.show', $appointment) }}" class="btn btn-secondary btn-sm" title="View" aria-label="View appointment">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('appointments.edit', $appointment) }}" class="btn btn-info btn-sm" title="Edit">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                                <form action="{{ route('appointments.destroy', $appointment) }}" method="POST" class="d-inline delete-form"
                                                      data-confirm="Delete this appointment?">
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
                            {{ $appointments->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
    <script>
        $(function () {
            $('#appointments-table').DataTable({
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
                order: [[1, 'desc']],
                columnDefs: [
                    { targets: 7, orderable: false, searchable: false }
                ],
                responsive: true,
                autoWidth: false,
            });

            $('.status-select').change(function () {
                const $select = $(this);
                const id = $select.data('id');
                const status = $select.val();
                const originalStatus = $select.data('original') || $select.find('option:selected').val();

                $.ajax({
                    url: '/appointments/' + id + '/status',
                    method: 'PATCH',
                    data: {
                        status: status,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        if (!response.success) {
                            $select.val(originalStatus);
                        }
                        $select.data('original', status);
                    },
                    error: function () {
                        $select.val(originalStatus);
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