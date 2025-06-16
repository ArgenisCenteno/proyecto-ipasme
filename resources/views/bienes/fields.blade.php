<form action="{{ route('bienes.store') }}" method="POST">
    @csrf

    <div class="row">
        <div class="col-md-6 mb-3">
            <div class="form-group">
                <label class="form-label" for="nombre">Nombre</label>
                <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre"
                    value="{{ old('nombre') }}" required>
                @error('nombre')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <!-- Descripción -->
        <div class="col-md-6 mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea name="descripcion" id="descripcion" rows="3"
                class="form-control @error('descripcion') is-invalid @enderror">{{ old('descripcion') }}</textarea>
            <div class="invalid-feedback">
                @error('descripcion')
                    {{ $message }}
                @enderror
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <div class="form-group">
                <label class="form-label" for="marca">Marca</label>
                <input type="text" class="form-control @error('marca') is-invalid @enderror" id="marca" name="marca"
                    value="{{ old('marca') }}" required>
                @error('marca')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <!-- Descripción -->
        <div class="col-md-6 mb-3">
            <label for="modelo" class="form-label">Módelo</label>
            <input name="modelo" type="text" id="modelo" rows="3" class="form-control @error('modelo') is-invalid @enderror" />
            <div class="invalid-feedback">
                @error('modelo')
                    {{ $message }}
                @enderror
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <div class="form-group">
                <label class="form-label" for="categoria_id">Categoría</label>
                <select class="form-control @error('categoria_id') is-invalid @enderror" id="categoria_id"
                    name="categoria_id" required>
                    <option value="">Selecciona una categoría</option>
                    @foreach($categorias as $categoria)
                        <option value="{{ $categoria->id }}" {{ old('categoria_id') == $categoria->id ? 'selected' : '' }}>
                            {{ $categoria->nombre }}
                        </option>
                    @endforeach
                </select>
                @error('categoria_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-md-6 mb-3">
            <div class="form-group">
                <label class="form-label" for="unidad_medida">Unidad de Medida</label>
                <select class="form-control @error('unidad_medida') is-invalid @enderror" id="unidad_medida"
                    name="unidad_medida" required>
                    <option value="">SELECCIONA UNA UNIDAD</option>
                    <option value="UNIDAD" {{ old('unidad_medida') == 'UNIDAD' ? 'selected' : '' }}>UNIDAD</option>
                    <option value="PAQUETE" {{ old('unidad_medida') == 'PAQUETE' ? 'selected' : '' }}>PAQUETE</option>
                    <option value="CAJA" {{ old('unidad_medida') == 'CAJA' ? 'selected' : '' }}>CAJA</option>
                    <option value="LITRO" {{ old('unidad_medida') == 'LITRO' ? 'selected' : '' }}>LITRO</option>
                    <option value="KILOGRAMO" {{ old('unidad_medida') == 'KILOGRAMO' ? 'selected' : '' }}>KILOGRAMO
                    </option>
                    <option value="METRO" {{ old('unidad_medida') == 'METRO' ? 'selected' : '' }}>METRO</option>
                </select>
                @error('unidad_medida')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <div class="form-group">
                <label class="form-label" for="estado">Estado</label>
                <select class="form-control @error('estado') is-invalid @enderror" id="estado" name="estado" required>
                    <option value="Activo" {{ old('estado') == 'Activo' ? 'selected' : '' }}>Activo</option>
                    <option value="Inactivo" {{ old('estado') == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                    <option value="Dañado" {{ old('estado') == 'Dañado' ? 'selected' : '' }}>Dañado</option>
                    <option value="Mantenimiento" {{ old('estado') == 'Mantenimiento' ? 'selected' : '' }}>Mantenimiento
                    </option>
                    <option value="Desaparecido" {{ old('estado') == 'Desaparecido' ? 'selected' : '' }}>Desaparecido
                    </option>
                </select>
                @error('estado')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
         <div class="col-md-6 mb-3">
            <label for="activo" class="form-label">Activo</label>
            <input name="activo" type="text" id="activo"   class="form-control @error('activo') is-invalid @enderror" />
            <div class="invalid-feedback">
                @error('activo')
                    {{ $message }}
                @enderror
            </div>
        </div>
    </div>

    <div class="btn-list d-flex justify-content-end">
        <a href="{{ route('bienes.index') }}" class="btn btn-danger">Cancelar</a>
        <button type="submit" class="btn btn-primary" id="btn-submit">Registrar</button>
    </div>
</form>