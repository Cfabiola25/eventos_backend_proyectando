<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Panel Administrador Proyectando</title>

    <!-- Fonts -->
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('css/all.min.css') }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    
     <!-- SheetJS para exportación a Excel -->
    <script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased bg-gray-50">
    @include('layouts.components.preload')

    <div class="min-h-screen bg-gray-100">
        @include('layouts.components.navigation')
        @include('layouts.components.sidebart')

        <!-- Page Content -->
        <div class="min-h-screen flex items-center justify-center p-1">
            @yield('content')
        </div>
    </div>
</body>
@stack('scripts')
<script src="{{ asset('js/custom.js') }}"></script>
</html>
