<form action="{{ route('categorias.update', $categoria->id) }}" method="POST">
    @csrf
    @method('PUT') <!-- Este campo es necesario para indicar que es una actualización -->

    <div class="row">
        <!-- Nombre -->
        <div class="col-md-6 mb-3">
            <label for="nombre" class="form-label">Nombre <span class="text-danger">*</span></label>
            <input type="text" name="nombre" id="nombre" class="only-text form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre', $categoria->nombre) }}" required>
            <div class="invalid-feedback">
                @error('nombre')
                    {{ $message }}
                @enderror
            </div>
        </div>

         <div class="col-md-6 mb-3">
            <label for="estado" class="form-label">Estado <span class="text-danger">*</span></label>
            <select name="estado" id="estado" class="form-select @error('estado') is-invalid @enderror" required>
                <option value="">Seleccione</option>
                <option value="1" {{ old('estado', $categoria->estado) == 1 ? 'selected' : '' }}>Activo</option>
                <option value="0" {{ old('estado', $categoria->estado) == 0 ? 'selected' : '' }}>Inactivo</option>
            </select>
            <div class="invalid-feedback">
                @error('estado')
                    {{ $message }}
                @enderror
            </div>
        </div>
       
    </div>

    <div class="btn-list d-flex justify-content-end">
        <a href="{{ route('categorias.index') }}" class="btn btn-danger">Cancelar</a>
        <button type="submit" class="btn btn-primary" id="btn-submit">Actualizar</button>
    </div>
</form>
