@extends('layouts.guest')

@section('title', 'Confirma tu contraseña')

@section('content')

<div class="w-full max-w-md bg-white rounded-2xl shadow-xl overflow-hidden relative">
        <!-- Onda superior -->
        <div class="h-24 w-full overflow-hidden">
            <svg class="w-full h-24" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" fill="#F50606"></path>
            </svg>
        </div>

        <!-- Icono de candado -->
        <div class="flex justify-center -mt-16 mb-4 relative z-10">
            <div class="cursor-pointer z-10 relative group">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-14 h-14 text-primary-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
                <span class="absolute top-full mt-2 left-1/2 -translate-x-1/2 px-3 py-1 text-sm text-white bg-gray-800 rounded-md opacity-0 group-hover:opacity-100 transition-opacity duration-300 whitespace-nowrap z-20">
                    Confirmar contraseña
                </span>
            </div>
        </div>

        <!-- Logo FESC -->
        <div class="flex justify-left px-6">
            <img class="h-16 w-auto object-contain" src="{{ asset('images/logos/fesc.png') }}" alt="Logo FESC">
        </div>

        <!-- Mensaje informativo -->
        <div class="px-8 pt-2">
            <p class="text-sm text-gray-600 text-center mb-6">
                Esta es un área segura de la aplicación. Por favor confirme su contraseña antes de continuar.
            </p>
        </div>

        <!-- Formulario -->
        <div class="px-8 py-4">
            <form method="POST" action="{{ route('password.confirm') }}">
                @csrf

                <!-- Password -->
                <div class="mb-5">
                    <label for="password" class="block text-gray-700 text-sm font-medium mb-2">Contraseña</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <input id="password" type="password" name="password" required autocomplete="current-password" 
                            class="w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none transition duration-150 ease-in-out" 
                            placeholder="Ingrese su contraseña">
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Button -->
                <div class="mb-5">
                    <button type="submit" class="w-full py-3 px-4 bg-primary-500 hover:bg-primary-600 focus:ring-primary-500 focus:ring-offset-primary-200 text-white transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 rounded-lg">
                        Confirmar contraseña
                    </button>
                </div>
            </form>
        </div>

        <!-- Onda inferior -->
        <div class="h-24 w-full overflow-hidden mt-6">
            <svg class="w-full h-24 rotate-180" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" fill="#F50606"></path>
            </svg>
        </div>
    </div>
@endsection
@push('scripts-guest')
    <script>
        console.log('Confirm Password Page');
    </script>
@endpush
