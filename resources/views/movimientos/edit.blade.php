@extends('layouts.app')

@section('content')
    <div class="page">
        <!-- Sidebar -->


        <div class="page-wrapper">
            <div class="page-header d-print-none">
                <div class="container-xl">
                    <div class="row g-2 align-items-center">
                        <div class="col">
                            <h1 class="page-title">Entradas</h1>
                        </div>
                        <div class="col-auto ms-auto">
                            <div class="btn-list">

                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="page-body">
                <div class="container-xl">
                    <form action="{{ route('movimientos.update', $movimiento->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <!-- Departamento -->
                            <div class="col-md-6 mb-3">
                                <label for="departamento_destino_id">Departamento</label>
                                <select name="departamento_destino_id" id="departamento_destino_id" class="form-select"
                                    required>
                                    @foreach ($departamentos as $dep)
                                        <option value="{{ $dep->id }}" {{ $movimiento->departamento_destino_id == $dep->id ? 'selected' : '' }}>
                                            {{ $dep->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Proveedor -->
                            <div class="col-md-6 mb-3">
                                <label for="proveedor_id">Proveedor</label>
                                <select name="proveedor_id" id="proveedor_id" class="form-select" required>
                                    @foreach ($proveedores as $id => $razon)
                                        <option value="{{ $id }}" {{ $movimiento->proveedor_id == $id ? 'selected' : '' }}>
                                            {{ $razon }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Fecha -->
                            <div class="col-md-6 mb-3">
                                <label for="fecha">Fecha</label>
                                <input type="date" name="fecha" class="form-control"
                                    value="{{ $movimiento->fecha->format('Y-m-d') }}" required>
                            </div>

                            <!-- Factura -->
                            <div class="col-md-6 mb-3">
                                <label for="factura">Factura</label>
                                <input type="text" name="factura" class="form-control" value="{{ $movimiento->factura }}">
                            </div>

                            <!-- Descripción -->
                            <div class="col-md-6 mb-3">
                                <label for="descripcion">Descripción</label>
                                <textarea name="descripcion" class="form-control"
                                    required>{{ $movimiento->descripcion }}</textarea>
                            </div>

                            <!-- Observación -->
                            <div class="col-md-6 mb-3">
                                <label for="observacion">Observación</label>
                                <textarea name="observacion"
                                    class="form-control">{{ $movimiento->observaciones }}</textarea>
                            </div>
                        </div>



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
                                    @foreach($movimiento->bienes as $index => $item)
                                        <tr class="table-info">
                                            <td>{{ $item->bien->nombre }}</td>
                                            <td>{{ $item->bien->codigo_inventario }}</td>
                                            <td>{{ $item->bien->categoria->nombre ?? '-' }}</td>
                                            <td>{{ $item->bien->unidad_medida ?? '-' }}</td>
                                            <td>
                                                <input type="number" name="cantidades[{{ $item->id }}]" class="form-control"
                                                    value="{{ $item->cantidad }}" min="1" required>
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-end mt-3">
                            <a href="{{ route('movimientos.index') }}" class="btn btn-danger">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Actualizar</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>



@endsection