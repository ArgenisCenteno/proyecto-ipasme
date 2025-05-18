<form action="{{ route('proveedores.store') }}" method="POST">
    @csrf

    <div class="row">
        <div class="mb-3 col-md-6">
            <label for="razon_social" class="form-label">Razón Social</label>
            <input type="text" class="form-control @error('razon_social') is-invalid @enderror" id="razon_social"
                name="razon_social" value="{{ old('razon_social') }}" required>
            @error('razon_social')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3 col-md-6">
            <label for="rif" class="form-label">RIF</label>
            <input type="text" class="form-control @error('rif') is-invalid @enderror" id="rif" name="rif"
                value="{{ old('rif') }}" required>
            <div class="invalid-feedback">
                @error('rif')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <div class="row">
        <div class="mb-3 col-md-6">
            <label for="direccion" class="form-label">Dirección</label>
            <textarea class="form-control @error('direccion') is-invalid @enderror" id="direccion" name="direccion"
                rows="2">{{ old('direccion') }}</textarea>
            @error('direccion')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3 col-md-6">
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="text" class="form-control @error('telefono') is-invalid @enderror" id="telefono"
                name="telefono" value="{{ old('telefono') }}">
            <div class="invalid-feedback">
                @error('telefono')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <div class="row">
        <div class="mb-3 col-md-6">
            <label for="email" class="form-label">Correo electrónico</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="correo" name="email"
                value="{{ old('email') }}">
            <div class="invalid-feedback"></div>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3 col-md-6">
        <label for="estado" class="form-label">Estado</label>
        <select name="estado" id="estado" class="form-control @error('estado') is-invalid @enderror" required>
            <option value="1" {{ old('estado') == '1' ? 'selected' : '' }}>Activo</option>
            <option value="0" {{ old('estado') == '0' ? 'selected' : '' }}>Inactivo</option>
        </select>
        <div class="invalid-feedback">
            @error('estado')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    
    </div>
    
    <div class="btn-list d-flex justify-content-end">
        <a href="{{ route('proveedores.index') }}" class="btn btn-danger">Cancelar</a>

        <button type="submit" class="btn btn-primary" id="btn-submit">Registrar</button>
    </div>
</form>