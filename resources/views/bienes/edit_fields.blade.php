<form action="{{ route('bienes.update', $bien->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="row">
        <div class="col-md-6 mb-3">
            <div class="form-group">
                <label class="form-label" for="nombre">Nombre</label>
                <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre"
                    value="{{ old('nombre', $bien->nombre) }}" required>
                @error('nombre')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-md-6 mb-3">
            <div class="form-group">
                <label class="form-label" for="descripcion">Descripción</label>
                <textarea class="form-control @error('descripcion') is-invalid @enderror" id="descripcion"
                    name="descripcion" rows="4">{{ old('descripcion', $bien->descripcion) }}</textarea>
                @error('descripcion')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
 <div class="row">
        <div class="col-md-6 mb-3">
            <div class="form-group">
                <label class="form-label" for="marca">Marca</label>
                <input type="text" class="form-control @error('marca') is-invalid @enderror" value="{{ $bien->marca }}" id="marca" name="marca"
                    value="{{ old('marca') }}" required>
                @error('marca')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <!-- Descripción -->
        <div class="col-md-6 mb-3">
            <label for="modelo" class="form-label">Módelo</label>
            <input name="modelo"  type="text" id="modelo" rows="3" value="{{ $bien->modelo }}" class="form-control @error('modelo') is-invalid @enderror" />
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
                        <option value="{{ $categoria->id }}"
                            {{ old('categoria_id', $bien->categoria_id) == $categoria->id ? 'selected' : '' }}>
                            {{ $categoria->nombre }}</option>
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
                    @foreach(['UNIDAD', 'PAQUETE', 'CAJA', 'LITRO', 'KILOGRAMO', 'METRO'] as $unidad)
                        <option value="{{ $unidad }}"
                            {{ old('unidad_medida', $bien->unidad_medida) == $unidad ? 'selected' : '' }}>
                            {{ $unidad }}
                        </option>
                    @endforeach
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
                    @foreach(['Activo', 'Inactivo'] as $estado)
                        <option value="{{ $estado }}"
                            {{ old('estado', $bien->estado) == $estado ? 'selected' : '' }}>
                            {{ $estado }}
                        </option>
                    @endforeach
                </select>
                @error('estado')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
         <div class="col-md-6 mb-3">
            <label for="activo" class="form-label">Activo</label>
            <input name="activo" type="text" id="activo" value="{{ $bien->activo ?? '' }}"   class="form-control @error('activo') is-invalid @enderror" />
            <div class="invalid-feedback">
                @error('activo')
                    {{ $message }}
                @enderror
            </div>
        </div>
    </div>

    <div class="btn-list d-flex justify-content-end">
        <a href="{{ route('bienes.index') }}" class="btn btn-danger">Cancelar</a>
        <button type="submit" class="btn btn-primary" id="btn-submit">Actualizar</button>
    </div>
</form>
