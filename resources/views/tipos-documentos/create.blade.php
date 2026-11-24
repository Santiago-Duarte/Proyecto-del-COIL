@extends('layouts.admin')

@section('page_title', 'Agregar')

@section('content_body')
    <div class="card">
        <form novalidate action="{{ route('tipos-documentos.store') }}" method="POST">
            @csrf

            <div class="card-body" style="background-color: #f4f6f9;">
                @include('tipos-documentos._form')
            </div>

            <div class="card-footer" style="background-color: #f4f6f9;">
                <button type="submit" class="btn btn-primary mr-3" style="min-width: 140px;">Registrar</button>
                <a href="{{ route('tipos-documentos.index') }}" class="btn btn-danger"
                    style="min-width: 140px;">Atrás</a>
            </div>
        </form>
    </div>
@endsection
