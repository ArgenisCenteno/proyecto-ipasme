@extends('layouts.app')

@section('content')
    <section class="vh-100 p-0">
        <div class="container-fluid" style="padding-left: 0 !important;">
            <div class="row">
                <div class="col-sm-8 p-0 d-none d-sm-block">
                    <img src="../imagenes/banner.png" alt="Login image" class="w-100 vh-100">
                </div>
                <div class="col-sm-4 text-black">



                    <div class="d-flex align-items-center justify-content-center h-custom">

                        <!-- Formulario de inicio de sesión -->
                        <form method="POST" action="{{ route('password.email') }}" style="width: 23rem;" >
                            @csrf <!-- Agregar token CSRF obligatorio -->

                            <h1 class="fw-bold mb-3 pb-3 text-green-sistema email-text">Recuperar Contraseña</h1>

                            <!-- Campo de correo electrónico -->
                            <div class="form-outline mb-4">
                                <label class="form-label" for="email">Correo Electrónico</label>
                                <input id="email" type="email" placeholder="Ingresar email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <!-- Campo de contraseña -->
                            

                            <!-- Botón de inicio de sesión -->
                            <div class="pt-1 mb-4">
                                <button class="btn btn-green-sistema w-100" type="submit">Enviar</button>
                            </div>

                            <!-- Enlace para recuperar la contraseña -->
                            <p class="small mb-5 pb-lg-2">
                                <a class="text-muted" href="{{ route('login') }}">Volver al login</a>
                            </p>

                            <!-- Enlace para registrarse -->
                         </form>

                    </div>

                </div>

            </div>
        </div>
    </section>
@endsection