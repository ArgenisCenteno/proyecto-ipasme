@extends('layouts.app')

@section('content')
    <div class="page">
        <!-- Sidebar -->


        <div class="page-wrapper">
            <div class="page-header d-print-none">
                <div class="container-xl">
                    <div class="row g-2 align-items-center">
                        <div class="col">
                            <h1 class="page-title">Salidas</h1>
                        </div>
                        <div class="col-auto ms-auto">
                            <div class="btn-list">
                               <div class="btn-list">
                                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#modalEntradasPorFecha">
                                    Exportar
                                </button>
                                 
                            </div>
                                <a href="{{ route('salidas.create') }}" class="btn btn-primary d-none d-sm-inline-block">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <line x1="12" y1="5" x2="12" y2="19" />
                                        <line x1="5" y1="12" x2="19" y2="12" />
                                    </svg>
                                    Registrar entrada
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="page-body">
                <div class="container-xl">
                     @include('movimientos.salidasTable')
                </div>
            </div>
        </div>
    </div>
<!-- Modal -->
<div class="modal modal-blur fade" id="modalEntradasPorFecha" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Exportar Salidas por Fecha</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{ route('exportar.salidas.fecha') }}" method="GET">
                <div class="modal-body">
                    <div class="row">
                        <!-- Ente -->
                        <div class="col-md-6 mb-3">
                            <label for="ente_id" class="form-label">Ente Destino<span class="text-danger">*</span></label>
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
                            <label for="departamento_destino_id" class="form-label">Departamento Destino<span
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

                    <div class="row">
                        <!-- Desde -->
                        <div class="col-md-6 mb-3">
                            <label for="desde" class="form-label">Desde</label>
                            <input type="date" name="desde" id="desde" class="form-control" required>
                        </div>

                        <!-- Hasta -->
                        <div class="col-md-6 mb-3">
                            <label for="hasta" class="form-label">Hasta</label>
                            <input type="date" name="hasta" id="hasta" class="form-control" required>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                        Cancelar
                    </button>
                    <button type="submit" class="btn btn-success ms-auto">
                        Consultar
                    </button>
                </div>
            </form>

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