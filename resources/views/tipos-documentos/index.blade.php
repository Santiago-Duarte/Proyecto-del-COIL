@extends('layouts.admin')

@section('page_title', 'Listar')

@section('content_body')
    <div class="card">
        <div class="card-header bg-secondary">
            <h3 class="card-title text-white" style="font-size: 1.5rem; font-weight: 400;">
                Listado De Tipos de Documentos
            </h3>
            <div class="card-tools">
                <a href="{{ route('tipos-documentos.create') }}" class="btn btn-primary" title="Agregar">
                    <i class="fas fa-plus"></i>
                </a>
            </div>
        </div>

        <div class="card-body">
            <table id="tabla-tipos-documentos" class="table table-sm table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tipo Documento</th>
                        <th>Abreviatura</th>
                        <th>Estado</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tiposDocumentos as $tipoDocumento)
                        <tr>
                            <td>{{ $tipoDocumento->id }}</td>
                            <td>{{ $tipoDocumento->tipo_documento }}</td>
                            <td>{{ $tipoDocumento->abreviatura }}</td>
                            <td>
                                <span class="badge {{ $tipoDocumento->estado ? 'badge-success' : 'badge-danger' }}"
                                    style="font-size: 14px; padding: 12px 26px; border-radius: 4px;">
                                    {{ $tipoDocumento->estado ? 'Activo' : 'Inactivo' }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('tipos-documentos.edit', $tipoDocumento) }}"
                                    class="btn btn-info px-2" title="Editar">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                                <button type="button" class="btn btn-danger px-2 ml-1 btn-eliminar"
                                    data-url="{{ route('tipos-documentos.destroy', $tipoDocumento) }}" title="Eliminar">
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
    @include('partials.datatables', ['tableId' => 'tabla-tipos-documentos', 'actionsColumn' => 4])
@endsection
