@extends('layouts.app')

@section('content')
<div class="page">
    <div class="page-wrapper">
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <h1 class="page-title">Editar Salida</h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-body">
            <div class="container-xl">
                <form action="{{ route('salidas.update', $movimiento->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <!-- Ente Origen -->
                        <input type="hidden" name="ente_origen_id" value="{{ $movimiento->ente_origen_id }}">
                        <input type="hidden" name="ente_destino_id" value="{{ $movimiento->ente_destino_id }}">

                        <!-- Departamento Origen -->
                        <div class="col-md-6 mb-3">
                            <label for="departamento_origen_id" class="form-label">Departamento Origen</label>
                            <select name="departamento_origen_id" class="form-select" required>
                                @foreach ($departamentos as $dep)
                                    <option value="{{ $dep->id }}" {{ $movimiento->departamento_origen_id == $dep->id ? 'selected' : '' }}>
                                        {{ $dep->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Departamento Destino -->
                        <div class="col-md-6 mb-3">
                            <label for="departamento_destino_id" class="form-label">Departamento Destino</label>
                            <select name="departamento_destino_id" class="form-select" required>
                                @foreach ($departamentos as $dep)
                                    <option value="{{ $dep->id }}" {{ $movimiento->departamento_destino_id == $dep->id ? 'selected' : '' }}>
                                        {{ $dep->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Fecha -->
                        <div class="col-md-6 mb-3">
                            <label for="fecha" class="form-label">Fecha</label>
                            <input type="date" name="fecha" class="form-control" value="{{ $movimiento->fecha->format('Y-m-d') }}" required>
                        </div>

                        <!-- Monto -->
                        <div class="col-md-6 mb-3">
                            <label for="monto" class="form-label">Monto</label>
                            <input type="number" name="monto" step="any" class="form-control" value="{{ $movimiento->monto }}" required>
                        </div>

                        <!-- Factura -->
                        <div class="col-md-6 mb-3">
                            <label for="factura" class="form-label">Factura</label>
                            <input type="text" name="factura" class="form-control" value="{{ $movimiento->factura }}">
                        </div>

                        <!-- Descripción -->
                        <div class="col-md-12 mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea name="descripcion" class="form-control" required>{{ $movimiento->descripcion }}</textarea>
                        </div>

                        <!-- Observación -->
                        <div class="col-md-12 mb-3">
                            <label for="observacion" class="form-label">Observación</label>
                            <textarea name="observacion" class="form-control">{{ $movimiento->observaciones }}</textarea>
                        </div>
                    </div>

                    <div class="table-responsive mt-4">
                        <table class="table table-bordered table-striped">
                            <thead class="bg-dark text-white">
                                <tr>
                                    <th>Nombre del Bien</th>
                                    <th>Código Inventario</th>
                                    <th>Categoría</th>
                                    <th>Unidad</th>
                                    <th>Cantidad</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($movimiento->bienes as $item)
                                    <tr>
                                        <td>{{ $item->bien->nombre }}</td>
                                        <td>{{ $item->bien->codigo_inventario }}</td>
                                        <td>{{ $item->bien->categoria->nombre ?? '-' }}</td>
                                        <td>{{ $item->bien->unidad_medida ?? '-' }}</td>
                                        <td>
                                            <input type="number" name="cantidades[{{ $item->id }}]" class="form-control" min="1" required value="{{ $item->cantidad }}">
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <a href="{{ route('salidas.index') }}" class="btn btn-danger me-2">Cancelar</a>
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
