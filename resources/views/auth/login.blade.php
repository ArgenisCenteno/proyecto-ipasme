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
                        <form method="POST" action="{{ route('login') }}" style="width: 23rem;" >
                            @csrf <!-- Agregar token CSRF obligatorio -->

                            <h1 class="fw-bold mb-3 pb-3 text-green-sistema login-text">Ingresar</h1>

                            <!-- Campo de correo electrónico -->
                            <div class="form-outline mb-4">
                                <label class="form-label" for="email">Correo Electrónico</label>
                                <input type="email" id="email" placeholder="Ingrese correo electrónico" name="email" class="form-control "
                                    value="{{ old('email') }}" required autofocus />
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

                            <!-- Botón de inicio de sesión -->
                            <div class="pt-1 mb-4">
                                <button class="btn btn-green-sistema w-100" type="submit">Ingresar</button>
                            </div>

                            <!-- Enlace para recuperar la contraseña -->
                            <p class="small mb-5 pb-lg-2">
                                <a class="text-muted" href="{{ route('password.request') }}">¿Olvidó su contraseña?</a>
                            </p>

                            <!-- Enlace para registrarse -->
                            <p>¿No tienes cuenta? <a href="{{ route('register') }}" class="link-info">Registrarse</a></p>
                        </form>

                    </div>

                </div>

            </div>
        </div>
    </section>
@endsection