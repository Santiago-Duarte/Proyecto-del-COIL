@php($tipoDocumento = $tipoDocumento ?? null)
@php($estadoActual = old('estado', $tipoDocumento?->estado ?? true) ? '1' : '0')

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="tipo_documento" class="font-weight-bold" style="font-size: 14px;">
                Tipo Documento <span class="text-danger">(*)</span>
            </label>
            <input type="text" name="tipo_documento" id="tipo_documento"
                class="form-control @error('tipo_documento') is-invalid @enderror"
                value="{{ old('tipo_documento', $tipoDocumento?->tipo_documento) }}"
                placeholder="Por ejemplo, Cédula de Ciudadanía">
            @error('tipo_documento')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="abreviatura" class="font-weight-bold" style="font-size: 14px;">
                Abreviatura <span class="text-danger">(*)</span>
            </label>
            <input type="text" name="abreviatura" id="abreviatura"
                class="form-control @error('abreviatura') is-invalid @enderror"
                value="{{ old('abreviatura', $tipoDocumento?->abreviatura) }}" placeholder="Por ejemplo, CC">
            @error('abreviatura')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="estado" class="font-weight-bold" style="font-size: 14px;">
                Estado <span class="text-danger">(*)</span>
            </label>
            <select name="estado" id="estado" class="form-control @error('estado') is-invalid @enderror">
                <option value="1" @selected($estadoActual === '1')>Activo</option>
                <option value="0" @selected($estadoActual === '0')>Inactivo</option>
            </select>
            @error('estado')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
    </div>
</div>
