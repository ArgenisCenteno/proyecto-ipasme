<form action="{{ route('bienes.actualizarBienAsignado', $bien->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="tipo" class="form-label">Tipo</label>
            <input type="text" class="form-control" id="tipo" value="{{ ucfirst($movimiento->tipo) }}" disabled>
        </div>
        <div class="col-md-4">
            <label for="fecha" class="form-label">Fecha</label>
            <input type="text" class="form-control" id="fecha" value="{{ $movimiento->fecha->format('d-m-Y') }}"
                disabled>
        </div>
       
    </div>

    

    <div class="row mb-3">
        <div class="col-md-6">
            <label for="departamento_origen" class="form-label">Departamento Origen</label>
            <input type="text" class="form-control" id="departamento_origen"
                value="{{ $movimiento->departamentoOrigen->nombre ?? '-' }}" disabled>
        </div>
        <div class="col-md-6">
            <label for="departamento_destino" class="form-label">Departamento Destino</label>
            <input type="text" class="form-control" id="departamento_destino"
                value="{{ $movimiento->departamentoDestino->nombre ?? '-' }}" disabled>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <label for="usuario" class="form-label">Registrado por</label>
            <input type="text" class="form-control" id="usuario" value="{{ $movimiento->user->name ?? '-' }}" disabled>
        </div>
        <div class="col-md-6">
            <label for="codigo" class="form-label">Código Inventario</label>
            <input type="text" class="form-control" id="codigo" value="{{ $bien->codigo_inventario ?? '-' }}" disabled>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-6">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea class="form-control" id="descripcion" rows="2" disabled>{{ $movimiento->descripcion }}</textarea>
        </div>
        <div class="col-md-6">
            <label for="observaciones" class="form-label">Observaciones</label>
            <textarea class="form-control" id="observaciones" rows="2"
                disabled>{{ $movimiento->observaciones }}</textarea>
        </div>
        <div class="mb-3 col-md-6 mt-3">

            <label for="estado" class="form-label">Modificar estado</label>
            <select name="estado" id="estado" class="form-control @error('estado') is-invalid @enderror" required>
                <option value="Activo" {{ old('estado', $bien->estado) == 'Activo' ? 'selected' : '' }}>Activo</option>
                <option value="Inactivo" {{ old('estado', $bien->estado) == 'Inactivo' ? 'selected' : '' }}>Inactivo
                </option>
                <option value="Dañado" {{ old('estado', $bien->estado) == 'Dañado' ? 'selected' : '' }}>Dañado</option>
                <option value="Mantenimiento" {{ old('estado', $bien->estado) == 'Mantenimiento' ? 'selected' : '' }}>
                    Mantenimiento
                <option value="Descartado" {{ old('estado', $bien->estado) == 'Descartado' ? 'selected' : '' }}>Descartado

                </option>
                <option value="Desaparecido" {{ old('estado', $bien->estado) == 'Desaparecido' ? 'selected' : '' }}>
                    Desaparecido

                </option>
            </select>
            @error('estado')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="btn-list d-flex justify-content-end">
        <a href="{{ route('bienes.index') }}" class="btn btn-danger">Cancelar</a>
        <button type="submit" class="btn btn-primary" id="btn-submit">Actualizar</button>
    </div>
</form>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tipo</th>
            <th>Ente Origen</th>
            <th>Ente Destino</th>
            <th>Departamento Origen</th>
            <th>Departamento Destino</th>
            <th>Fecha</th>
        </tr>
    </thead>
    <tbody>


        @foreach ($movimientos as $index => $movimiento)
            <tr class="{{ $index === 0 ? 'table-success' : 'table-danger' }}">
                <td>{{ $movimiento->id }}</td>
                <td>{{ $movimiento->tipo }}</td>
                <td>{{ optional($movimiento->enteOrigen)->nombre ?? '-' }}</td>
                <td>{{ optional($movimiento->enteDestino)->nombre ?? '-' }}</td>
                <td>{{ optional($movimiento->departamentoOrigen)->nombre ?? '-' }}</td>
                <td>{{ optional($movimiento->departamentoDestino)->nombre ?? '-' }}</td>
                <td>{{ $movimiento->created_at->format('Y-m-d H:i') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>