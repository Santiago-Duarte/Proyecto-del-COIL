@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    @include('layouts.partials.msg')

    <section class="content">
        <div class="container-fluid">
            <!-- Main metrics (clickable → list) -->
            <div class="row">
                <div class="col-12 col-sm-6 col-md-3">
                    <a href="{{ route('owners.index') }}" class="text-decoration-none">
                        <div class="info-box mb-3 animate-fade-in-up stagger-1">
                            <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-users"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Owners</span>
                                <span class="info-box-number">{{ number_format($totalOwners) }}</span>
                            </div>
                            <i class="fas fa-arrow-right text-gray-400 ml-2"></i>
                        </div>
                    </a>
                </div>

                <div class="col-12 col-sm-6 col-md-3">
                    <a href="{{ route('pets.index') }}" class="text-decoration-none">
                        <div class="info-box mb-3 animate-fade-in-up stagger-2">
                            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-paw"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Pets</span>
                                <span class="info-box-number">{{ number_format($totalPets) }}</span>
                            </div>
                            <i class="fas fa-arrow-right text-gray-400 ml-2"></i>
                        </div>
                    </a>
                </div>

                <div class="col-12 col-sm-6 col-md-3">
                    <a href="{{ route('veterinarians.index') }}" class="text-decoration-none">
                        <div class="info-box mb-3 animate-fade-in-up stagger-3">
                            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-user-md"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Veterinarians</span>
                                <span class="info-box-number">{{ number_format($totalVeterinarians) }}</span>
                            </div>
                            <i class="fas fa-arrow-right text-gray-400 ml-2"></i>
                        </div>
                    </a>
                </div>

                <div class="col-12 col-sm-6 col-md-3">
                    <a href="{{ route('appointments.index') }}" class="text-decoration-none">
                        <div class="info-box mb-3 animate-fade-in-up stagger-4">
                            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-calendar-check"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Appointments</span>
                                <span class="info-box-number">{{ number_format($totalAppointments) }}</span>
                            </div>
                            <i class="fas fa-arrow-right text-gray-400 ml-2"></i>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Today's appointments -->
            <div class="row">
                <div class="col-12">
                    <div class="card animate-fade-in-up stagger-1">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="card-title">
                                <i class="fas fa-calendar-day mr-2"></i>Today's Appointments
                                <small class="text-muted ml-2 font-weight-normal">{{ \Carbon\Carbon::today()->format('l, F j, Y') }}</small>
                            </h3>
                            <a href="{{ route('appointments.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
                        </div>
                        <div class="card-body p-0">
                            @if ($todaysAppointments->isEmpty())
                                <div class="text-center py-5">
                                    <div class="mb-3">
                                        <i class="fas fa-calendar-times fa-3x text-gray-300"></i>
                                    </div>
                                    <h5 class="text-gray-500 mb-1">No appointments today</h5>
                                    <p class="text-gray-400 mb-0">Enjoy your free day!</p>
                                </div>
                            @else
                                <div class="table-responsive">
                                    <table class="table table-hover m-0">
                                        <thead class="text-primary">
                                            <tr>
                                                <th style="width: 90px;">Time</th>
                                                <th>Pet / Owner</th>
                                                <th>Veterinarian</th>
                                                <th>Reason</th>
                                                <th style="width: 130px;">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($todaysAppointments as $appointment)
                                                <tr>
                                                    <td>
                                                        <span class="font-weight-bold text-gray-800">
                                                            {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('g:i A') }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar-circle bg-primary-light text-primary mr-3 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px; font-size: 0.85rem;">
                                                                {{ Str::upper($appointment->pet->name[0]) }}
                                                            </div>
                                                            <div>
                                                                <div class="font-weight-medium text-gray-800">{{ $appointment->pet->name }}</div>
                                                                <div class="text-sm text-gray-500">
                                                                    {{ $appointment->pet->species }}
                                                                    <span class="mx-1">·</span>
                                                                    {{ $appointment->pet->owner->name }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="font-weight-medium text-gray-800">{{ $appointment->veterinarian->name }}</div>
                                                    </td>
                                                    <td class="text-gray-600">{{ Str::limit($appointment->reason, 60) }}</td>
                                                    <td>
                                                        <span class="badge badge-{{ $appointment->status === 'Pending' ? 'warning' : ($appointment->status === 'In Consultation' ? 'info' : 'success') }} badge-pill px-3 py-2">
                                                            {{ $appointment->status }}
                                                        </span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection