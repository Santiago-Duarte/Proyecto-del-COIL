@extends('layouts.app')

@section('title', 'Pets List')

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
                                <a href="{{ route('pets.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> New Pet</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="pets-table" class="table table-bordered table-hover" style="width:100%">
                                <thead class="text-primary">
                                    <tr>
                                        <th width="10px">ID</th>
                                        <th>Name</th>
                                        <th>Species</th>
                                        <th>Breed</th>
                                        <th>Owner</th>
                                        <th>Gender</th>
                                        <th>Age</th>
                                        <th width="150px">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pets as $pet)
                                        <tr>
                                            <td>{{ $pet->id }}</td>
                                            <td>
                                                <a href="{{ route('pets.show', $pet) }}" class="font-weight-bold text-decoration-none">
                                                    {{ $pet->name }}
                                                </a>
                                            </td>
                                            <td>{{ $pet->species }}</td>
                                            <td>{{ $pet->breed ?? '—' }}</td>
                                            <td>{{ $pet->owner->name }}</td>
                                            <td>{{ $pet->gender ?? '—' }}</td>
                                            <td>
                                                @if ($pet->birth_date)
                                                    {{ $pet->birth_date->diffInYears(now()) }} years
                                                @else
                                                    —
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('pets.show', $pet) }}" class="btn btn-secondary btn-sm" title="View" aria-label="View pet">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('pets.edit', $pet) }}" class="btn btn-info btn-sm" title="Edit">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                                <form action="{{ route('pets.destroy', $pet) }}" method="POST" class="d-inline delete-form"
                                                      data-confirm="Delete the pet {{ $pet->name }}?">
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
                            {{ $pets->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@include('partials.datatables', ['tableId' => 'pets-table', 'actionsColumn' => 7])
@include('partials.delete-confirm')