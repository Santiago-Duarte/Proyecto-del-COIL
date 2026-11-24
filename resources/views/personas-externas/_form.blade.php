@php($personaExterna = $personaExterna ?? null)

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="nombre" class="font-weight-bold" style="font-size: 14px;">
                Nombre <span class="text-danger">(*)</span>
            </label>
            <input type="text" name="nombre" id="nombre"
                class="form-control @error('nombre') is-invalid @enderror"
                value="{{ old('nombre', $personaExterna?->nombre) }}" placeholder="Por ejemplo, Carlos">
            @error('nombre')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="apellidos" class="font-weight-bold" style="font-size: 14px;">
                Apellido <span class="text-danger">(*)</span>
            </label>
            <input type="text" name="apellidos" id="apellidos"
                class="form-control @error('apellidos') is-invalid @enderror"
                value="{{ old('apellidos', $personaExterna?->apellidos) }}"
                placeholder="Por ejemplo, Puentes Florez">
            @error('apellidos')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="email" class="font-weight-bold" style="font-size: 14px;">
                Email <span class="text-danger">(*)</span>
            </label>
            <input type="email" name="email" id="email"
                class="form-control @error('email') is-invalid @enderror"
                value="{{ old('email', $personaExterna?->email) }}" placeholder="Por ejemplo, cmpf@gmail.com">
            @error('email')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="celular" class="font-weight-bold" style="font-size: 14px;">
                Celular <span class="text-danger">(*)</span>
            </label>
            <input type="text" name="celular" id="celular"
                class="form-control @error('celular') is-invalid @enderror"
                value="{{ old('celular', $personaExterna?->celular) }}" placeholder="Por ej, 3125693456">
            @error('celular')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
    </div>
</div>
