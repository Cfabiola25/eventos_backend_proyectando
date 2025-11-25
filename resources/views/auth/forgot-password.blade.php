@extends('layouts.guest')

@section('title', 'olvidado tu contraseña')

@section('content')
<div class="w-full max-w-md bg-white rounded-2xl shadow-xl overflow-hidden relative">
        <!-- Onda superior -->
        <div class="h-24 w-full overflow-hidden">
            <svg class="w-full h-24" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" fill="#F50606"></path>
            </svg>
        </div>

        <!-- Icono de ayuda -->
        <div class="flex justify-center -mt-16 mb-4 relative z-10">
            <div class="cursor-pointer z-10 relative group">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-14 h-14 text-primary-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="absolute top-full mt-2 left-1/2 -translate-x-1/2 px-3 py-1 text-sm text-white bg-gray-800 rounded-md opacity-0 group-hover:opacity-100 transition-opacity duration-300 whitespace-nowrap z-20">
                    Recuperar contraseña
                </span>
            </div>
        </div>

        <!-- Logo FESC -->
        <div class="flex justify-left px-6">
            <img class="h-16 w-auto object-contain" src="{{ asset('images/logos/fesc.png') }}" alt="Logo FESC">
        </div>

        <!-- Mensaje informativo -->
        <div class="px-8 pt-2 mt-4">
            <p class="text-sm text-gray-600 text-center mb-6">
                ¿Olvidaste tu contraseña? No hay problema. Ingresa tu email y te enviaremos un enlace para restablecerla.
            </p>
        </div>

        <!-- Formulario -->
        <div class="px-8 py-4">
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <!-- Email Address -->
                <div class="mb-5">
                    <label for="email" class="block text-gray-700 text-sm font-medium mb-2">Correo electrónico</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                            </svg>
                        </div>
                        <input id="email" type="email" name="email" required autofocus autocomplete="email" 
                            class="w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none transition duration-150 ease-in-out" 
                            placeholder="Ingrese su correo electrónico">
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Submit Button -->
                <div class="mb-5">
                    <button type="submit" class="w-full py-3 px-4 bg-primary-500 hover:bg-primary-600 focus:ring-primary-500 focus:ring-offset-primary-200 text-white transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 rounded-lg">
                        Enviar enlace de recuperación
                    </button>
                </div>
                
                <!-- Volver al login -->
                <div class="text-center">
                    <a class="text-sm text-primary-500 hover:text-primary-700 font-medium" href="{{ route('login') }}">
                        ← Volver al inicio de sesión
                    </a>
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
        console.log('Forgot Password Page');
    </script>
@endpush
