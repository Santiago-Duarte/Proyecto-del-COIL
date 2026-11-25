@extends('layouts.app')

@section('title', 'Pet Details')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ $pet->name }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('pets.index') }}">Pets</a></li>
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
                            <h3 class="profile-username text-center">{{ $pet->name }}</h3>

                            <p class="text-muted text-center">{{ $pet->species }} {{ $pet->breed ? '- ' . $pet->breed : '' }}</p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Owner</b> <a class="float-right"><a href="{{ route('owners.show', $pet->owner) }}">{{ $pet->owner->name }}</a></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Phone</b> <a class="float-right">{{ $pet->owner->phone }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Gender</b> <a class="float-right">{{ $pet->gender ?? '—' }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Color</b> <a class="float-right">{{ $pet->color ?? '—' }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Age</b> <a class="float-right">
                                        @if ($pet->birth_date)
                                            {{ $pet->birth_date->diffInYears(now()) }} years
                                        @else
                                            —
                                        @endif
                                    </a>
                                </li>
                            </ul>

                            <a href="{{ route('pets.edit', $pet) }}" class="btn btn-primary btn-block"><i class="fas fa-edit mr-2"></i> Edit</a>
                            <a href="{{ route('appointments.create', ['pet' => $pet->id]) }}" class="btn btn-success btn-block"><i class="fas fa-calendar-plus mr-2"></i> Schedule Appointment</a>
                            <a href="{{ route('pets.index') }}" class="btn btn-danger btn-block"><i class="fas fa-arrow-left mr-2"></i> Back</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header bg-secondary">
                            <h3 class="card-title text-white">
                                <i class="fas fa-info-circle mr-2"></i>Pet Information
                            </h3>
                        </div>
                        <div class="card-body">
                            @if ($pet->notes)
                                <p>{{ $pet->notes }}</p>
                            @else
                                <p class="text-muted">No additional notes.</p>
                            @endif
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header bg-secondary">
                            <h3 class="card-title text-white">
                                <i class="fas fa-calendar-check mr-2"></i>Appointment History
                            </h3>
                        </div>
                        <div class="card-body p-0">
                            @if ($pet->appointments->isEmpty())
                                <div class="text-center py-4 text-muted">
                                    <i class="fas fa-calendar-times fa-2x mb-2"></i>
                                    <p>No appointments for this pet.</p>
                                </div>
                            @else
                                <table class="table table-hover m-0">
                                    <thead class="text-primary">
                                        <tr>
                                            <th>Date & Time</th>
                                            <th>Veterinarian</th>
                                            <th>Reason</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pet->appointments->sortByDesc('appointment_date') as $appointment)
                                            <tr>
                                                <td>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('M j, Y g:i A') }}</td>
                                                <td>{{ $appointment->veterinarian->name }}</td>
                                                <td>{{ Str::limit($appointment->reason, 60) }}</td>
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