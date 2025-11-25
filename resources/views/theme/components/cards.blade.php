<!-- Tarjetas de métricas de Temas -->
<div class="flex flex-wrap sm:flex-nowrap gap-4 mb-6">
    <!-- Total de temas -->
    <div
        class="w-full sm:w-1/3 bg-white rounded-lg shadow p-6 text-center transition-transform transform hover:-translate-y-1 duration-300 border border-transparent hover:border-red-600">
        <div class="flex justify-center mb-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-600" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
            </svg>
        </div>
        <p class="text-sm text-gray-500">Total de Temas</p>
        <p class="text-3xl font-bold text-red-600" id="total-themes-count">{{ $themes->count() }}</p>
    </div>

    <!-- Temas activos (próximos) - CORREGIDO -->
    <div
        class="w-full sm:w-1/3 bg-white rounded-lg shadow p-6 text-center transition-transform transform hover:-translate-y-1 duration-300 border border-transparent hover:border-red-600">
        <div class="flex justify-center mb-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-600" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
        <p class="text-sm text-gray-500">Temas Próximos</p>
        <p class="text-3xl font-bold text-red-600" id="upcoming-themes-count">
            {{ $themes->filter(function($theme) {
                $startDate = $theme->start_date instanceof \Carbon\Carbon 
                    ? $theme->start_date 
                    : \Carbon\Carbon::parse($theme->start_date);
                return $startDate->gte(now()->startOfDay());
            })->count() }}
        </p>
    </div>

    <!-- Temas pasados - CORREGIDO -->
    <div
        class="w-full sm:w-1/3 bg-white rounded-lg shadow p-6 text-center transition-transform transform hover:-translate-y-1 duration-300 border border-transparent hover:border-red-600">
        <div class="flex justify-center mb-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-600" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
        <p class="text-sm text-gray-500">Temas Pasados</p>
        <p class="text-3xl font-bold text-red-600" id="past-themes-count">
            {{ $themes->filter(function($theme) {
                $startDate = $theme->start_date instanceof \Carbon\Carbon 
                    ? $theme->start_date 
                    : \Carbon\Carbon::parse($theme->start_date);
                return $startDate->lt(now()->startOfDay());
            })->count() }}
        </p>
    </div>
</div>