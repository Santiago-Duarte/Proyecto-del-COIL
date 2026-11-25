@extends('layouts.app')

@section('title', 'Owner Details')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ $owner->name }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('owners.index') }}">Owners</a></li>
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
                            <h3 class="profile-username text-center">{{ $owner->name }}</h3>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Phone</b> <a class="float-right">{{ $owner->phone }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Email</b> <a class="float-right">{{ $owner->email }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Pets</b> <a class="float-right">{{ $owner->pets_count }}</a>
                                </li>
                            </ul>

                            <a href="{{ route('owners.edit', $owner) }}" class="btn btn-primary btn-block"><i class="fas fa-edit mr-2"></i> Edit</a>
                            <a href="{{ route('owners.index') }}" class="btn btn-danger btn-block"><i class="fas fa-arrow-left mr-2"></i> Back</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header bg-secondary">
                            <h3 class="card-title text-white">
                                <i class="fas fa-address-card mr-2"></i>Address
                            </h3>
                        </div>
                        <div class="card-body">
                            @if ($owner->address)
                                <p>{{ $owner->address }}</p>
                            @else
                                <p class="text-muted">No address provided.</p>
                            @endif
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header bg-secondary">
                            <h3 class="card-title text-white">
                                <i class="fas fa-paw mr-2"></i>Pets ({{ $owner->pets_count }})
                            </h3>
                        </div>
                        <div class="card-body p-0">
                            @if ($owner->pets->isEmpty())
                                <div class="text-center py-4 text-muted">
                                    <i class="fas fa-paw fa-2x mb-2"></i>
                                    <p>No pets registered for this owner.</p>
                                </div>
                            @else
                                <table class="table table-hover m-0">
                                    <thead class="text-primary">
                                        <tr>
                                            <th>Name</th>
                                            <th>Species</th>
                                            <th>Breed</th>
                                            <th>Gender</th>
                                            <th>Age</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($owner->pets as $pet)
                                            <tr>
                                                <td>
                                                    <a href="{{ route('pets.show', $pet) }}" class="font-weight-bold text-decoration-none">
                                                        {{ $pet->name }}
                                                    </a>
                                                </td>
                                                <td>{{ $pet->species }}</td>
                                                <td>{{ $pet->breed ?? '—' }}</td>
                                                <td>{{ $pet->gender ?? '—' }}</td>
                                                <td>
                                                    @if ($pet->birth_date)
                                                        {{ $pet->birth_date->diffInYears(now()) }} years
                                                    @else
                                                        —
                                                    @endif
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