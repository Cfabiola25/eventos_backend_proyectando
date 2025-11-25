<!-- Tarjetas de métricas de Agenda -->
<div class="flex flex-wrap sm:flex-nowrap gap-4 mb-6">
    <!-- Total de agendas -->
    <div
        class="w-full sm:w-1/3 bg-white rounded-lg shadow p-6 text-center transition-transform transform hover:-translate-y-1 duration-300 border border-transparent hover:border-red-600">
        <div class="flex justify-center mb-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-600" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
        </div>
        <p class="text-sm text-gray-500">Total de Agendas</p>
        <p class="text-3xl font-bold text-red-600">{{ $agendas->count() }}</p>
    </div>

    <!-- Agendas activas (próximas) -->
    <div
        class="w-full sm:w-1/3 bg-white rounded-lg shadow p-6 text-center transition-transform transform hover:-translate-y-1 duration-300 border border-transparent hover:border-red-600">
        <div class="flex justify-center mb-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-600" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
        <p class="text-sm text-gray-500">Agendas Próximas</p>
        <p class="text-3xl font-bold text-red-600">
            {{ $agendas->where('start_date', '>=', now()->format('Y-m-d'))->count() }}
        </p>
    </div>

    <!-- Agendas pasadas -->
    <div
        class="w-full sm:w-1/3 bg-white rounded-lg shadow p-6 text-center transition-transform transform hover:-translate-y-1 duration-300 border border-transparent hover:border-red-600">
        <div class="flex justify-center mb-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-600" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
        <p class="text-sm text-gray-500">Agendas Pasadas</p>
        <p class="text-3xl font-bold text-red-600">
            {{ $agendas->where('end_date', '<', now()->format('Y-m-d'))->count() }}
        </p>
    </div>
</div>