@extends('layouts.app')

@section('content')
    <div class="page">
        <!-- Sidebar -->


        <div class="page-wrapper">
            <div class="page-header d-print-none">
                <div class="container-xl">
                    <div class="row g-2 align-items-center">
                        <div class="col">
                            <h1 class="page-title">Detalles del Bien</h1>
                        </div>
                        <div class="col-auto ms-auto">
                            <div class="btn-list">
                                <span class="d-none d-sm-inline">
                                    <a href="{{ route('pdf.inventario', $bien->id) }}" target="_blank" class="btn btn-success">Descargar </a>
                                </span>
                                <a href="{{ route('bienes.inventario') }}" class="btn btn-primary d-none d-sm-inline-block">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <line x1="12" y1="5" x2="12" y2="19" />
                                        <line x1="5" y1="12" x2="19" y2="12" />
                                    </svg>
                                   Volver
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="page-body">
                <div class="container-xl">
                    @include('bienes.editFieldsInventario')
                </div>
            </div>
        </div>
    </div>

@endsection