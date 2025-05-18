@extends('layouts.app')

@section('content')
    <section class="vh-100 p-0">
        <div class="container-fluid" style="padding-left: 0 !important;">
            <div class="row">
                <div class="col-sm-8 p-0 d-none d-sm-block">
                    <img src="imagenes/banner.png" alt="Login image" class="w-100 vh-100">
                </div>
                <div class="col-sm-4 text-black">



                    <div class="d-flex align-items-center justify-content-center h-custom">

                        <!-- Formulario de inicio de sesión -->
                        <form method="POST" action="{{ route('register') }}" style="width: 23rem;">
                        @csrf
                        <h1 class="fw-bold mb-3 pb-3 text-green-sistema login-text">Registrarse</h1>
                        <div class="form-outline mb-4">
                                <label class="form-label" for="name">Nombre</label>
                                <input type="text" id="name" placeholder="Ingrese el nombre" name="name" class="form-control w-100"
                                    value="{{ old('name') }}" required autofocus />
                                @error('name')
                                    <p class="text-danger">{{ $message }}</p> <!-- Mostrar error de validación -->
                                @enderror
                            </div>
                        <div class="form-outline mb-4">
                                <label class="form-label" for="email">Correo Electrónico</label>
                                <input type="email" id="email" placeholder="Ingrese correo electrónico" name="email" class="form-control"
                                    value="{{ old('email') }}" required   />
                                @error('email')
                                    <p class="text-danger">{{ $message }}</p> <!-- Mostrar error de validación -->
                                @enderror
                            </div>
                           
                            <!-- Campo de contraseña -->
                            <div class="form-outline mb-4">
                                <label class="form-label" for="password">Contraseña</label>
                                <input type="password" id="password" placeholder="Ingrese contraseña" name="password" class="form-control "
                                    required />
                                @error('password')
                                    <p class="text-danger">{{ $message }}</p> <!-- Mostrar error de validación -->
                                @enderror
                            </div>
                            <div class="form-outline mb-4">
                                <label class="form-label" for="password_confirmation">Confirmar contraseña</label>
                                <input type="password_confirmation" id="password_confirmation" placeholder="Confirmar contraseña" name="password_confirmation" class="form-control"
                                    required />
                                @error('password_confirmation')
                                    <p class="text-danger">{{ $message }}</p> <!-- Mostrar error de validación -->
                                @enderror
                            </div>
                            <p class="small mb-5 pb-lg-2">
                                <a class="text-muted" href="{{ route('login') }}">Volver al login</a>
                            </p>
                            <div class="pt-1 mb-4">
                                <button class="btn btn-green-sistema w-100" type="submit">Registrarse</button>
                            </div>
                    </form>

                    </div>

                </div>

            </div>
        </div>
    </section>
@endsection
<script>
    // Escucha el evento 'input' en todos los campos de tipo text y textareas y convierte a mayúsculas
    document.addEventListener('DOMContentLoaded', function() {
        // Selecciona todos los inputs de tipo text y los textareas
        const textInputs = document.querySelectorAll('input[type="text"], textarea');

        // Itera sobre cada input y textarea y agrega el listener
        textInputs.forEach(function(input) {
            input.addEventListener('input', function() {
                // Convierte el valor del input o textarea a mayúsculas
                this.value = this.value.toUpperCase();
            });
        });
    });
</script>