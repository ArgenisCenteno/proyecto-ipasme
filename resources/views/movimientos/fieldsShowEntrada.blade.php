<div class="row mb-3">
    <div class="col-md-4">
        <label for="tipo" class="form-label">Tipo</label>
        <input type="text" class="form-control" id="tipo" value="{{ ucfirst($movimiento->tipo) }}" disabled>
    </div>
    <div class="col-md-4">
        <label for="fecha" class="form-label">Fecha</label>
        <input type="text" class="form-control" id="fecha" value="{{ $movimiento->fecha }}" disabled>
    </div>
    <div class="col-md-4">
        <label for="monto" class="form-label">Monto</label>
        <input type="text" class="form-control" id="monto" value="{{ number_format($movimiento->monto, 2) }}" disabled>
    </div>
</div>

<div class="row mb-3">
    <div class="col-md-6">
        <label for="ente_origen" class="form-label">Ente Origen</label>
        <input type="text" class="form-control" id="ente_origen" value="{{ $movimiento->enteOrigen->nombre ?? '-' }}" disabled>
    </div>
    <div class="col-md-6">
        <label for="ente_destino" class="form-label">Ente Destino</label>
        <input type="text" class="form-control" id="ente_destino" value="{{ $movimiento->enteDestino->nombre ?? '-' }}" disabled>
    </div>
</div>

<div class="row mb-3">
    <div class="col-md-6">
        <label for="departamento_origen" class="form-label">Departamento Origen</label>
        <input type="text" class="form-control" id="departamento_origen" value="{{ $movimiento->departamentoOrigen->nombre ?? '-' }}" disabled>
    </div>
    <div class="col-md-6">
        <label for="departamento_destino" class="form-label">Departamento Destino</label>
        <input type="text" class="form-control" id="departamento_destino" value="{{ $movimiento->departamentoDestino->nombre ?? '-' }}" disabled>
    </div>
</div>

<div class="row mb-3">
    <div class="col-md-6">
        <label for="usuario" class="form-label">Registrado por</label>
        <input type="text" class="form-control" id="usuario" value="{{ $movimiento->user->name ?? '-' }}" disabled>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-6">
        <label for="descripcion" class="form-label">Descripción</label>
        <textarea class="form-control" id="descripcion" rows="2" disabled>{{ $movimiento->descripcion }}</textarea>
    </div>
    <div class="col-md-6">
        <label for="observaciones" class="form-label">Observaciones</label>
        <textarea class="form-control" id="observaciones" rows="2" disabled>{{ $movimiento->observaciones }}</textarea>
    </div>
</div>



<h4>Productos Asociados</h4>
<div class="table-responsive">
    <table class="table table-bordered table-striped">
        <thead class="bg-dark text-white">
            <tr>
                <th>Nombre</th>
                <th>Código</th>
                <th>Categoría</th>
                <th>Unidad</th>
                <th>Cantidad</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bienes as $item)
                <tr class="table-info">
                    <td>{{ $item->bien->nombre }}</td>
                    <td>{{ $item->bien->codigo_inventario }}</td>
                    <td>{{ $item->bien->categoria->nombre ?? '-' }}</td>
                    <td>{{ $item->bien->unidad_medida ?? '-' }}</td>
                    <td>{{ $item->cantidad }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{-- Paginación --}}
<div class="d-flex justify-content-center">
    {{ $bienes->links() }}
</div>
