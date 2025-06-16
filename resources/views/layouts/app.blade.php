<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'IPASME') }}</title>
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">

    <!-- Fonts -->
    <style>
        .divider:after,
        .divider:before {
            content: "";
            flex: 1;
            height: 1px;
            background: #eee;
        }

        .h-custom {
            height: calc(100% - 73px);
        }

        @media (max-width: 450px) {
            .h-custom {
                height: 100%;
            }
        }
    </style>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div id="app">
        @include('layouts.header')
        <div class="bg-flag-green small-section" data-aos="fade-right"></div>
        <div class="bg-flag-blue small-section" data-aos="fade-right"> </div>

        <main class="">
            @yield('content')
        </main>
    </div>
</body>

@include('script')
@include('sweetalert::alert')

@include('layouts.datatables_js')

</html>