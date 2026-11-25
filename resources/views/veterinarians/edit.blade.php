@extends('layouts.app')

@section('title', 'Edit Veterinarian')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Veterinarian</h1>
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
                        <form method="POST" action="{{ route('veterinarians.update', $veterinarian) }}">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                @include('veterinarians._form')
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-lg-2 col-6">
                                        <button type="submit" class="btn btn-primary btn-flat btn-block">Update</button>
                                    </div>
                                    <div class="col-lg-2 col-6">
                                        <a href="{{ route('veterinarians.index') }}" class="btn btn-danger btn-flat btn-block">Back</a>
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