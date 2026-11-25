@extends('layouts.app')

@section('title', 'Edit Appointment')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Appointment</h1>
                </div>
            </div>
        </div>
    </section>

    @include('layouts.partials.msg')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-secondary" style="font-size: 1.75rem;font-weight: 500; line-height: 1.2; margin-bottom: 0.5rem;">
                            @yield('title')
                        </div>
                        <form method="POST" action="{{ route('appointments.update', $appointment) }}">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                @include('appointments._form')
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-lg-2 col-6">
                                        <button type="submit" class="btn btn-primary btn-flat btn-block">Update</button>
                                    </div>
                                    <div class="col-lg-2 col-6">
                                        <a href="{{ route('appointments.index') }}" class="btn btn-danger btn-flat btn-block">Back</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('css')
<link rel="stylesheet" href="{{ asset('backend/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
@endpush

@push('scripts')
<script src="{{ asset('backend/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.js') }}"></script>
<script>
    $(function () {
        $('#appointment_date').datetimepicker({
            format: 'YYYY-MM-DDTHH:mm',
            icons: {
                time: 'fas fa-clock',
                date: 'fas fa-calendar',
                up: 'fas fa-arrow-up',
                down: 'fas fa-arrow-down',
                previous: 'fas fa-chevron-left',
                next: 'fas fa-chevron-right',
                today: 'fas fa-calendar-check',
                clear: 'fas fa-trash',
                close: 'fas fa-times'
            }
        });
    });
</script>
@endpush