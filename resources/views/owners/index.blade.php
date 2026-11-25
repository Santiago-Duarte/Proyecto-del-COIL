@extends('layouts.app')

@section('title', 'Owners List')

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
                                <a href="{{ route('owners.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> New Owner</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="owners-table" class="table table-bordered table-hover" style="width:100%">
                                <thead class="text-primary">
                                    <tr>
                                        <th width="10px">ID</th>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>Pets</th>
                                        <th width="150px">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($owners as $owner)
                                        <tr>
                                            <td>{{ $owner->id }}</td>
                                            <td>
                                                <strong>{{ $owner->name }}</strong>
                                            </td>
                                            <td>{{ $owner->phone }}</td>
                                            <td>{{ $owner->email }}</td>
                                            <td>{{ Str::limit($owner->address ?? '—', 40) }}</td>
                                            <td>
                                                <span class="badge badge-primary badge-pill">{{ $owner->pets_count }}</span>
                                            </td>
                                            <td>
                                                <a href="{{ route('owners.show', $owner) }}" class="btn btn-secondary btn-sm" title="View" aria-label="View owner">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('owners.edit', $owner) }}" class="btn btn-info btn-sm" title="Edit">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                                <form action="{{ route('owners.destroy', $owner) }}" method="POST" class="d-inline delete-form"
                                                      data-confirm="Delete the owner {{ $owner->name }}?">
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
                            {{ $owners->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@include('partials.datatables', ['tableId' => 'owners-table', 'actionsColumn' => 6])
@include('partials.delete-confirm')