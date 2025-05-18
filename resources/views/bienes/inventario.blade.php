@extends('layouts.app')

@section('content')
    <div class="page">
        <!-- Sidebar -->


        <div class="page-wrapper">
            <div class="page-header d-print-none">
                <div class="container-xl">
                    <div class="row g-2 align-items-center">
                        <div class="col">
                            <h1 class="page-title">Inventario</h1>
                        </div>
                        <div class="col-auto ms-auto">
                            <div class="btn-list">
                                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#modal-consulta-excel">
                                    Exportar
                                </button>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="page-body">
                <div class="container-xl">
                    @include('bienes.tableInventario')
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal modal-blur fade" id="modal-consulta-excel" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Consultar bienes por departamento</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('exportar.bienes.departamento') }}" method="GET" class="row">
                        <div class="col-12">
                            <div class="row">
                                <!-- Ente -->
                                <div class="col-md-6 mb-3">
                                    <label for="ente_id" class="form-label">Ente <span class="text-danger">*</span></label>
                                    <select name="ente_id" id="ente_id"
                                        class="form-select @error('ente_id') is-invalid @enderror" required>
                                        <option value="">Seleccione un ente</option>
                                        @foreach ($entes as $id => $nombre)
                                            <option value="{{ $id }}" {{ old('ente_id') == $id ? 'selected' : '' }}>
                                                {{ $nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        @error('ente_id') {{ $message }} @enderror
                                    </div>
                                </div>

                                <!-- Departamento -->
                                <div class="col-md-6 mb-3">
                                    <label for="departamento_destino_id" class="form-label">Departamento <span
                                            class="text-danger">*</span></label>
                                    <select name="departamento_destino_id" id="departamento_destino_id"
                                        class="form-select @error('departamento_destino_id') is-invalid @enderror" required>
                                        <option value="">Seleccione un departamento</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        @error('departamento_destino_id') {{ $message }} @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Footer del modal con el botón -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-success">Consultar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function () {

        document.getElementById('ente_id').addEventListener('change', function () {
            const enteId = this.value;
            const departamentoSelect = document.getElementById('departamento_destino_id');

            // Vaciar el select de departamentos
            departamentoSelect.innerHTML = '<option value="">Cargando...</option>';

            if (enteId) {
                fetch(`/departamentos-data/${enteId}`)
                    .then(response => response.json())
                    .then(data => {
                        let options = '<option value="">Seleccione un departamento</option>';
                        for (const [id, nombre] of Object.entries(data)) {
                            options += `<option value="${id}">${nombre}</option>`;
                        }
                        departamentoSelect.innerHTML = options;
                    })
                    .catch(() => {
                        departamentoSelect.innerHTML = '<option value="">Error al cargar departamentos</option>';
                    });
            } else {
                departamentoSelect.innerHTML = '<option value="">Seleccione un ente primero</option>';
            }
        });

    });
</script>