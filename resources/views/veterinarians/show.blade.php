@extends('layouts.app')

@section('title', 'Veterinarian Details')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ $veterinarian->name }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('veterinarians.index') }}">Veterinarians</a></li>
                        <li class="breadcrumb-item active">Details</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    @include('layouts.partials.msg')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <!-- Profile Card -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <h3 class="profile-username text-center">{{ $veterinarian->name }}</h3>

                            <p class="text-muted text-center">{{ $veterinarian->specialty ?? 'General Practice' }}</p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Phone</b> <a class="float-right">{{ $veterinarian->phone }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Email</b> <a class="float-right">{{ $veterinarian->email }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Status</b> <a class="float-right">
                                        <span class="badge badge-{{ $veterinarian->is_active ? 'success' : 'danger' }} badge-pill">
                                            {{ $veterinarian->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </a>
                                </li>
                                <li class="list-group-item">
                                    <b>Total Appointments</b> <a class="float-right">{{ $veterinarian->appointments_count }}</a>
                                </li>
                            </ul>

                            <a href="{{ route('veterinarians.edit', $veterinarian) }}" class="btn btn-primary btn-block"><i class="fas fa-edit mr-2"></i> Edit</a>
                            <a href="{{ route('veterinarians.index') }}" class="btn btn-danger btn-block"><i class="fas fa-arrow-left mr-2"></i> Back</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header bg-secondary">
                            <h3 class="card-title text-white">
                                <i class="fas fa-calendar-check mr-2"></i>Recent Appointments
                            </h3>
                        </div>
                        <div class="card-body p-0">
                            @if ($veterinarian->appointments->isEmpty())
                                <div class="text-center py-4 text-muted">
                                    <i class="fas fa-calendar-times fa-2x mb-2"></i>
                                    <p>No appointments for this veterinarian.</p>
                                </div>
                            @else
                                <table class="table table-hover m-0">
                                    <thead class="text-primary">
                                        <tr>
                                            <th>Date & Time</th>
                                            <th>Pet</th>
                                            <th>Owner</th>
                                            <th>Reason</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($veterinarian->appointments->sortByDesc('appointment_date')->take(10) as $appointment)
                                            <tr>
                                                <td>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('M j, Y g:i A') }}</td>
                                                <td>{{ $appointment->pet->name }}</td>
                                                <td>{{ $appointment->pet->owner->name }}</td>
                                                <td>{{ Str::limit($appointment->reason, 50) }}</td>
                                                <td>
                                                    <span class="badge badge-{{ $appointment->status === 'Pending' ? 'warning' : ($appointment->status === 'In Consultation' ? 'info' : 'success') }} badge-pill">
                                                        {{ $appointment->status }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection