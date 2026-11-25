@extends('layouts.app')

@section('title', 'Appointment Details')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Appointment #{{ $appointment->id }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('appointments.index') }}">Appointments</a></li>
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
                    <!-- Info Card -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <h3 class="profile-username text-center">{{ $appointment->pet->name }}</h3>

                            <p class="text-muted text-center">{{ $appointment->pet->species }} - {{ $appointment->pet->owner->name }}</p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Date & Time</b> <a class="float-right">{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('M j, Y g:i A') }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Veterinarian</b> <a class="float-right">{{ $appointment->veterinarian->name }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Status</b> <a class="float-right">
                                        <span class="badge badge-{{ $appointment->status === 'Pending' ? 'warning' : ($appointment->status === 'In Consultation' ? 'info' : 'success') }} badge-pill">
                                            {{ $appointment->status }}
                                        </span>
                                    </a>
                                </li>
                            </ul>

                            <a href="{{ route('appointments.edit', $appointment) }}" class="btn btn-primary btn-block"><i class="fas fa-edit mr-2"></i> Edit</a>
                            <a href="{{ route('appointments.index') }}" class="btn btn-danger btn-block"><i class="fas fa-arrow-left mr-2"></i> Back</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header bg-secondary">
                            <h3 class="card-title text-white">
                                <i class="fas fa-sticky-note mr-2"></i>Reason for Visit
                            </h3>
                        </div>
                        <div class="card-body">
                            <p>{{ $appointment->reason }}</p>
                        </div>
                    </div>

                    @if ($appointment->notes)
                        <div class="card">
                            <div class="card-header bg-secondary">
                                <h3 class="card-title text-white">
                                    <i class="fas fa-notes-medical mr-2"></i>Clinical Notes
                                </h3>
                            </div>
                            <div class="card-body">
                                <p>{{ $appointment->notes }}</p>
                            </div>
                        </div>
                    @endif

                    <div class="card">
                        <div class="card-header bg-secondary">
                            <h3 class="card-title text-white">
                                <i class="fas fa-paw mr-2"></i>Pet Information
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <strong>Name:</strong> {{ $appointment->pet->name }}<br>
                                    <strong>Species:</strong> {{ $appointment->pet->species }}<br>
                                    <strong>Breed:</strong> {{ $appointment->pet->breed ?? '—' }}<br>
                                    <strong>Gender:</strong> {{ $appointment->pet->gender ?? '—' }}
                                </div>
                                <div class="col-md-6">
                                    <strong>Owner:</strong> {{ $appointment->pet->owner->name }}<br>
                                    <strong>Phone:</strong> {{ $appointment->pet->owner->phone }}<br>
                                    <strong>Email:</strong> {{ $appointment->pet->owner->email }}<br>
                                    <strong>Age:</strong>
                                    @if ($appointment->pet->birth_date)
                                        {{ $appointment->pet->birth_date->diffInYears(now()) }} years
                                    @else
                                        —
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header bg-secondary">
                            <h3 class="card-title text-white">
                                <i class="fas fa-user-md mr-2"></i>Veterinarian Information
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <strong>Name:</strong> {{ $appointment->veterinarian->name }}<br>
                                    <strong>Specialty:</strong> {{ $appointment->veterinarian->specialty ?? 'General Practice' }}
                                </div>
                                <div class="col-md-6">
                                    <strong>Phone:</strong> {{ $appointment->veterinarian->phone }}<br>
                                    <strong>Email:</strong> {{ $appointment->veterinarian->email }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection