<form action="{{ route('entes.update', $ente->id) }}" method="POST">
    @csrf
    @method('PUT') <!-- Necesario para hacer una actualización -->
    <div class="row">
        <!-- Nombre -->
        <div class="col-md-6 mb-3">
            <label for="nombre" class="form-label">Nombre <span class="text-danger">*</span></label>
            <input type="text" name="nombre" id="nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre', $ente->nombre) }}" required>
            <div class="invalid-feedback">
                @error('nombre')
                    {{ $message }}
                @enderror
            </div>
        </div>

        <!-- Encargado -->
        <div class="col-md-6 mb-3">
            <label for="encargado" class="form-label">Encargado</label>
            <input type="text" name="encargado" id="encargado" class="form-control @error('encargado') is-invalid @enderror" value="{{ old('encargado', $ente->encargado) }}">
            <div class="invalid-feedback">
                @error('encargado')
                    {{ $message }}
                @enderror
            </div>
        </div>

        <!-- Teléfono -->
        <div class="col-md-6 mb-3">
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="text" name="telefono" id="telefono" class="form-control @error('telefono') is-invalid @enderror" value="{{ old('telefono', $ente->telefono) }}" required>
            <div class="invalid-feedback">
                @error('telefono')
                    {{ $message }}
                @enderror
            </div>
        </div>

        <!-- Correo -->
        <div class="col-md-6 mb-3">
            <label for="correo" class="form-label">Correo electrónico</label>
            <input type="email" name="correo" id="correo" class="form-control @error('correo') is-invalid @enderror" value="{{ old('correo', $ente->correo) }}">
            <div class="invalid-feedback">
                @error('correo')
                    {{ $message }}
                @enderror
            </div>
        </div>

        <!-- RIF -->
        <div class="col-md-6 mb-3">
            <label for="rif" class="form-label">RIF <span class="text-danger">*</span></label>
            <input type="text" name="rif" id="rif" class="form-control @error('rif') is-invalid @enderror" value="{{ old('rif', $ente->rif) }}" required>
            <div class="invalid-feedback">
                @error('rif')
                    {{ $message }}
                @enderror
            </div>
        </div>

        <!-- Estado -->
        <div class="col-md-6 mb-3">
            <label for="estado" class="form-label">Estado <span class="text-danger">*</span></label>
            <select name="estado" id="estado" class="form-select @error('estado') is-invalid @enderror" required>
                <option value="">Seleccione</option>
                <option value="1" {{ old('estado', $ente->estado) == 1 ? 'selected' : '' }}>Activo</option>
                <option value="0" {{ old('estado', $ente->estado) == 0 ? 'selected' : '' }}>Inactivo</option>
            </select>
            <div class="invalid-feedback">
                @error('estado')
                    {{ $message }}
                @enderror
            </div>
        </div>

        <!-- Dirección -->
        <div class="col-md-12 mb-3">
            <label for="direccion" class="form-label">Dirección</label>
            <textarea name="direccion" id="direccion" rows="3" class="form-control @error('direccion') is-invalid @enderror">{{ old('direccion', $ente->direccion) }}</textarea>
            <div class="invalid-feedback">
                @error('direccion')
                    {{ $message }}
                @enderror
            </div>
        </div>
    </div>

    <div class="btn-list d-flex justify-content-end">
        <a href="{{ route('entes.index') }}" class="btn btn-danger">Cancelar</a>
        <button type="submit" class="btn btn-primary" id="btn-submit">Actualizar</button>
    </div>
</form>
