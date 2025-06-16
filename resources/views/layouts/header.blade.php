<header class="navbar navbar-expand-md  bg-success d-print-none">
    <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu"
            aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand navbar-brand-autodark" href="javascript:void(0)">
            <img src="{{ asset('imagenes/salud.png') }}" alt="salud" width="50px">
        </a>
        <div class="collapse navbar-collapse" id="navbar-menu" >
            <ul class="navbar-nav me-auto mb-2 mb-md-0" >
                @php 
                $user = Auth::user();
                @endphp
                @if(@isset($user))
                
                <li class="nav-item {{ request()->is('home*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('/home') }}">
                        <span class="nav-link-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-home">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                                <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                                <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                            </svg>
                       </span>
                        <span class="nav-link-title text-white"> Inicio </span>
                    </a>
                </li>
  <li class="nav-item ">
                    <a class="nav-link" href="{{ route('proveedores.index') }}">
                        <span class="nav-link-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users-group"
                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M5 7a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                <path d="M15 7a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                <path d="M5 21v-2a4 4 0 0 1 4 -4h2" />
                                <path d="M15 15h2a4 4 0 0 1 4 4v2" />
                                <path d="M12 12a3 3 0 1 0 -3 -3a3 3 0 0 0 3 3z" />
                                <path d="M12 12v6" />
                            </svg>
                        </span>
                        <span class="nav-link-title"> Proveedores </span>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="{{route('categorias.index')}}">
                        <span class="nav-link-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-file-spark">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path
                                    d="M19 22.5a4.75 4.75 0 0 1 3.5 -3.5a4.75 4.75 0 0 1 -3.5 -3.5a4.75 4.75 0 0 1 -3.5 3.5a4.75 4.75 0 0 1 3.5 3.5" />
                                <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                <path d="M12 21h-5a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v3.5" />
                            </svg>
                        </span>
                        <span class="nav-link-title"> Categorías </span>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="{{ route('departamentos.index') }}">
                        <span class="nav-link-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-building-store">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M3 21l18 0" />
                                <path
                                    d="M3 7v1a3 3 0 0 0 6 0v-1m0 1a3 3 0 0 0 6 0v-1m0 1a3 3 0 0 0 6 0v-1h-18l2 -4h14l2 4" />
                                <path d="M5 21l0 -10.15" />
                                <path d="M19 21l0 -10.15" />
                                <path d="M9 21v-4a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v4" />
                            </svg>
                        </span>
                        <span class="nav-link-title"> Departamentos </span>
                    </a>
                </li>
               
                <li class="nav-item ">
                    <a class="nav-link" href="{{ route('bienes.index') }}">
                        <span class="nav-link-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-building-estate">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M3 21h18" />
                                <path d="M19 21v-4" />
                                <path d="M19 17a2 2 0 0 0 2 -2v-2a2 2 0 1 0 -4 0v2a2 2 0 0 0 2 2z" />
                                <path d="M14 21v-14a3 3 0 0 0 -3 -3h-4a3 3 0 0 0 -3 3v14" />
                                <path d="M9 17v4" />
                                <path d="M8 13h2" />
                                <path d="M8 9h2" />
                            </svg>
                        </span>
                        <span class="nav-link-title"> Bienes </span>
                    </a>
                </li>
                 <li class="nav-item ">
                    <a class="nav-link" href="{{ route('bienes.inventario') }}">
                        <span class="nav-link-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-settings-check">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path
                                    d="M11.445 20.913a1.665 1.665 0 0 1 -1.12 -1.23a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.31 .318 1.643 1.79 .997 2.694" />
                                <path d="M15 19l2 2l4 -4" />
                                <path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" />
                            </svg>
                        </span>
                        <span class="nav-link-title"> Inventario </span>
                    </a>
                </li>
              
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('movimientos.index') }}">
                        <span class="nav-link-icon">
                            <!-- Icono Entrada -->
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="icon icon-tabler icon-tabler-arrow-bar-to-down" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 4v10" />
                                <path d="M12 14l4 -4" />
                                <path d="M12 14l-4 -4" />
                                <path d="M4 20h16" />
                            </svg>
                        </span>
                        <span class="nav-link-title"> Entradas </span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('salidas.index') }}">
                        <span class="nav-link-icon">
                            <!-- Icono Salida -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-bar-to-up"
                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 20v-10" />
                                <path d="M12 10l4 4" />
                                <path d="M12 10l-4 4" />
                                <path d="M4 4h16" />
                            </svg>
                        </span>
                        <span class="nav-link-title"> Salidas </span>
                    </a>
                </li>

                
                @endif
            </ul>
            <ul class="navbar-nav">
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="javascript:void(0)">
                                <span class="nav-link-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-user">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                        <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                    </svg>
                                </span>
                                <span class="nav-link-title"> Ingresar </span>
                            </a>
                        </li>
                    @endif
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="javascript:void(0)">
                                <span class="nav-link-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="icon">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M9 11l3 3l8 -8"></path>
                                        <path d="M20 12v6a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h9">
                                        </path>
                                    </svg>
                                </span>
                                <span class="nav-link-title"> Registrarse </span>
                            </a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <span class="avatar avatar-sm" style="background-image: url('imagenes/iglesia.webp')"></span>
                            <span class="d-none d-xl-inline ps-2">{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a href="{{ route('logout') }}" class="dropdown-item"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Cerrar sesión
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</header>
<style>
    .navbar-nav .nav-link,
    .navbar-nav .nav-link span,
    .navbar-nav .nav-link svg {
        color: white !important;
        stroke: white !important;
    }
</style>
