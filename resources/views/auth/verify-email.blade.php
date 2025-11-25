@extends('layouts.guest')
@section('title', 'Verifica tu correo electrónico')
@section('content')
    <div class="w-full max-w-md bg-white rounded-2xl shadow-xl overflow-hidden relative">
        <!-- Onda superior -->
        <div class="h-24 w-full overflow-hidden">
            <svg class="w-full h-24" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" fill="#F50606"></path>
            </svg>
        </div>

        <!-- Icono de email -->
        <div class="flex justify-center -mt-16 mb-4 relative z-10">
            <div class="cursor-pointer z-10 relative group">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-14 h-14 text-primary-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
                <span class="absolute top-full mt-2 left-1/2 -translate-x-1/2 px-3 py-1 text-sm text-white bg-gray-800 rounded-md opacity-0 group-hover:opacity-100 transition-opacity duration-300 whitespace-nowrap z-20">
                    Verificar email
                </span>
            </div>
        </div>

        <!-- Logo FESC -->
        <div class="flex justify-left px-6">
            <img class="h-16 w-auto object-contain" src="{{ asset('images/logos/fesc.png') }}" alt="Logo FESC">
        </div>

        <!-- Mensaje informativo -->
        <div class="px-8 pt-2 text-center">
            <h2 class="text-xl font-semibold text-gray-800 mb-2">Verifica tu dirección de email</h2>
            <p class="text-sm text-gray-600 mb-6">
                Gracias por registrarte. Antes de comenzar, ¿podrías verificar tu dirección de email haciendo clic en el enlace que te acabamos de enviar? Si no recibiste el email, con gusto te enviaremos otro.
            </p>
            
            <!-- Mensaje de estado -->
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6" role="alert">
                <p class="text-sm">Se ha enviado un nuevo enlace de verificación a tu dirección de email.</p>
            </div>
        </div>

        <!-- Formulario -->
        <div class="px-8 py-4">
            <form method="POST" action="{{ route('verification.send') }}">
                 @csrf
                <!-- Submit Button -->
                <div class="mb-5">
                    <button type="submit" class="w-full py-3 px-4 bg-primary-500 hover:bg-primary-600 focus:ring-primary-500 focus:ring-offset-primary-200 text-white transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 rounded-lg">
                        Reenviar email de verificación
                    </button>
                </div>
            </form>
            
            <!-- Cerrar sesión -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full py-3 px-4 border border-primary-500 text-primary-500 hover:bg-primary-50 transition ease-in duration-200 text-center text-base font-semibold rounded-lg">
                    Cerrar sesión
                </button>
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
        console.log('Verify Email Page');
    </script>
@endpush
