<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <title>{{ $user->first_name }} {{ $user->last_name }}</title>
    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-white h-screen flex items-center justify-center p-0 m-0">

    <!-- Contenedor principal para impresión -->
    <div>
    <div class="w-[80mm] h-[50mm] min-h-0 flex flex-col items-center justify-center p-1">
        <div class="text-center">
            <h2 class="text-[15px] font-bold text-black leading-none mb-0 
                       print:text-black print:font-bold print:text-[15px]">
                {{ $user->first_name}} 
            </h2>
            <h2 class="text-[15px] font-bold text-black leading-none 
                       print:text-black print:font-bold print:text-[15px]">
                {{ $user->last_name }}
            </h2>
        </div>

        <div class="flex justify-center mt-2">
             {!! $qr !!}
        </div>
    </div>
</div>
</body>

</html>