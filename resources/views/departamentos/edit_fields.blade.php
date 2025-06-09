<form action="{{ route('departamentos.update', $departamento->id) }}" method="POST">
    @csrf
    @method('PUT') <!-- Este campo es necesario para indicar que es una actualización -->

    <div class="row">
        <!-- Nombre -->
        <div class="col-md-6 mb-3">
            <label for="nombre" class="form-label">Nombre <span class="text-danger">*</span></label>
            <input type="text" name="nombre" id="nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre', $departamento->nombre) }}" required>
            <div class="invalid-feedback">
                @error('nombre')
                    {{ $message }}
                @enderror
            </div>
        </div>

        <!-- Descripción -->
        <div class="col-md-6 mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea name="descripcion" id="descripcion" rows="3" class="form-control @error('descripcion') is-invalid @enderror">{{ old('descripcion', $departamento->descripcion) }}</textarea>
            <div class="invalid-feedback">
                @error('descripcion')
                    {{ $message }}
                @enderror
            </div>
        </div>

        <!-- Encargado -->
        <div class="col-md-6 mb-3">
            <label for="encargado" class="form-label">Encargado</label>
            <input type="text" name="encargado" id="encargado" class="form-control @error('encargado') is-invalid @enderror" value="{{ old('encargado', $departamento->encargado) }}">
            <div class="invalid-feedback">
                @error('encargado')
                    {{ $message }}
                @enderror
            </div>
        </div>

        <!-- Estado -->
        <div class="col-md-6 mb-3">
            <label for="estado" class="form-label">Estado <span class="text-danger">*</span></label>
            <select name="estado" id="estado" class="form-select @error('estado') is-invalid @enderror" required>
                <option value="">Seleccione</option>
                <option value="1" {{ old('estado', $departamento->estado) == 1 ? 'selected' : '' }}>Activo</option>
             
            </select>
            <div class="invalid-feedback">
                @error('estado')
                    {{ $message }}
                @enderror
            </div>
        </div>

        <!-- Ente -->
        <div class="col-md-6 mb-3">
            <label for="ente_id" class="form-label">Ente <span class="text-danger">*</span></label>
            <select name="ente_id" id="ente_id" class="form-select @error('ente_id') is-invalid @enderror" required>
                <option value="">Seleccione un Ente</option>
                @foreach ($entes as $ente)
                    <option value="{{ $ente->id }}" {{ old('ente_id', $departamento->ente_id) == $ente->id ? 'selected' : '' }}>{{ $ente->nombre }}</option>
                @endforeach
            </select>
            <div class="invalid-feedback">
                @error('ente_id')
                    {{ $message }}
                @enderror
            </div>
        </div>
    </div>

    <div class="btn-list d-flex justify-content-end">
        <a href="{{ route('departamentos.index') }}" class="btn btn-danger">Cancelar</a>
        <button type="submit" class="btn btn-primary" id="btn-submit">Actualizar</button>
    </div>
</form>
