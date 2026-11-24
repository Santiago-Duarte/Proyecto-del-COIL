@extends('layouts.admin')

@section('page_title', 'Listar')

@section('content_body')
    <div class="card">
        <div class="card-header bg-secondary">
            <h3 class="card-title text-white" style="font-size: 1.5rem; font-weight: 400;">
                Listado De Personas Externas
            </h3>
            <div class="card-tools">
                <a href="{{ route('personas-externas.create') }}" class="btn btn-primary" title="Agregar">
                    <i class="fas fa-plus"></i>
                </a>
            </div>
        </div>

        <div class="card-body">
            <table id="tabla-personas-externas" class="table table-sm table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Email</th>
                        <th>Celular</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($personasExternas as $personaExterna)
                        <tr>
                            <td>{{ $personaExterna->id }}</td>
                            <td>{{ $personaExterna->nombre }}</td>
                            <td>{{ $personaExterna->apellidos }}</td>
                            <td>{{ $personaExterna->email }}</td>
                            <td>{{ $personaExterna->celular }}</td>
                            <td>
                                <a href="{{ route('personas-externas.edit', $personaExterna) }}"
                                    class="btn btn-info px-2" title="Editar">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                                <button type="button" class="btn btn-danger px-2 ml-1 btn-eliminar"
                                    data-url="{{ route('personas-externas.destroy', $personaExterna) }}" title="Eliminar">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @include('partials.delete-confirm')
    @include('partials.datatables', ['tableId' => 'tabla-personas-externas', 'actionsColumn' => 5])
@endsection
