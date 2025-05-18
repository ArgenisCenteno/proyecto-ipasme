@extends('layouts.app')

@section('content')
    <div class="page">
        <!-- Sidebar -->


        <div class="page-wrapper">
            <div class="page-header d-print-none">
                <div class="container-xl">
                    <div class="row g-2 align-items-center">
                        <div class="col">
                            <h1 class="page-title">Registrar categoría</h1>
                        </div>
                        <div class="col-auto ms-auto">
                            <div class="btn-list">

                                <a href="{{route('categorias.index')}}" class="btn btn-secondary d-none d-sm-inline-block">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <line x1="5" y1="12" x2="19" y2="12" />
                                        <line x1="5" y1="12" x2="11" y2="18" />
                                        <line x1="5" y1="12" x2="11" y2="6" />
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
                    @include('categorias.fields')
                </div>
            </div>
        </div>
    </div>

@endsection
