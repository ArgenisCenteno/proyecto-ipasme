@extends('layouts.app')

@section('content')
    <div class="page">
        <!-- Sidebar -->


        <div class="page-wrapper">
            <div class="page-header d-print-none">
                <div class="container-xl">
                    <div class="row g-2 align-items-center">
                        <div class="col">
                            <h1 class="page-title">Editar ente</h1>
                        </div>
                        <div class="col-auto ms-auto">
                            <div class="btn-list">

                                <a href="{{route('entes.index')}}" class="btn btn-secondary d-none d-sm-inline-block">
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
                    @include('entes.edit_fields')
                </div>
            </div>
        </div>
    </div>

@endsection
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        function validarFormulario() {
            if ($('.is-invalid').length > 0) {
                $('#btn-submit').prop('disabled', true);
            } else {
                $('#btn-submit').prop('disabled', false);
            }
        }

        // Validar teléfono
        $('#telefono').on('input', function () {
            let telefono = $(this).val();
            telefono = telefono.replace(/\D/g, '').slice(0, 11); // solo números y máx 11 dígitos
            $(this).val(telefono);
            const regex = /^(0412|0424|0414|0426|0416)[0-9]{7}$/;

            if (!regex.test(telefono)) {
                $(this).addClass('is-invalid').removeClass('is-valid');
                $(this).next('.invalid-feedback').text('Formato incorrecto. Debe comenzar con 0412, 0414, 0424, 0426 o 0416 y tener 11 dígitos.');
            } else {
                $(this).removeClass('is-invalid').addClass('is-valid');
                $(this).next('.invalid-feedback').text('');
            }
            validarFormulario();
        });

        // Validar encargado (nombres)
        $('#encargado').on('input', function () {
            let encargado = $(this).val();
            encargado = encargado.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ\s]/g, ''); // Eliminar números

            $(this).val(encargado);

            const regex = /^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/;

            if (encargado.trim() == '') {
                $(this).removeClass('is-valid is-invalid');
                $(this).next('.invalid-feedback').text('');
                validarFormulario();
                return; // No hacer nada más si está vacío
            }

            if (!regex.test(encargado)) {
                $(this).addClass('is-invalid').removeClass('is-valid');
                $(this).next('.invalid-feedback').text('Solo se permiten letras.');
            } else {
                $(this).removeClass('is-invalid').addClass('is-valid');
                $(this).next('.invalid-feedback').text('');
            }

            validarFormulario();
        });

        // Validar RIF
        $('#rif').on('input', function () {
            let rif = $(this).val();
            // Expresión regular para validar el formato del RIF
            const regex = /^[JGV]-\d{8}-\d{1}$/;

            if (!regex.test(rif)) {
                $(this).addClass('is-invalid').removeClass('is-valid');
                $(this).next('.invalid-feedback').text('Formato de RIF inválido. Debe ser como J-12345678-9');
            } else {
                $(this).removeClass('is-invalid').addClass('is-valid');
                $(this).next('.invalid-feedback').text('');
            }

            validarFormulario();
        });

        // Validar correo electrónico
        $('#correo').on('input', function () {
            let correo = $(this).val();
            // Expresión regular para validar el formato de correo electrónico
            const regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;

            if (!regex.test(correo)) {
                $(this).addClass('is-invalid').removeClass('is-valid');
                $(this).next('.invalid-feedback').text('Formato de correo electrónico inválido.');
            } else {
                $(this).removeClass('is-invalid').addClass('is-valid');
                $(this).next('.invalid-feedback').text('');
            }

            validarFormulario();
        });
    });
</script>
