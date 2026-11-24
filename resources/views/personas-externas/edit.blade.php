@extends('layouts.admin')

@section('page_title', 'Editar')

@section('content_body')
    <div class="card">
        <form novalidate action="{{ route('personas-externas.update', $personaExterna) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="card-body" style="background-color: #f4f6f9;">
                @include('personas-externas._form', ['personaExterna' => $personaExterna])
            </div>

            <div class="card-footer" style="background-color: #f4f6f9;">
                <button type="submit" class="btn btn-primary mr-3" style="min-width: 140px;">Actualizar</button>
                <a href="{{ route('personas-externas.index') }}" class="btn btn-danger"
                    style="min-width: 140px;">Atrás</a>
            </div>
        </form>
    </div>
@endsection
