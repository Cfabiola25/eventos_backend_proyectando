<div class="flex flex-wrap gap-4 mb-6">
    <div class="flex-1 min-w-[200px] bg-white rounded-lg shadow p-6 text-center transition-transform transform hover:-translate-y-1 duration-300 border border-transparent hover:border-primary-600">
        <div class="flex justify-center mb-2">
            <i class="fas fa-calendar-alt text-primary-600 text-4xl"></i>
        </div>
        <p class="text-sm text-gray-500 font-semibold">Total de Eventos</p>
        <p id="totalEventsCount" class="text-3xl font-bold text-primary-600">{{ $totalEvents }}</p>
    </div>

    <div class="flex-1 min-w-[200px] bg-white rounded-lg shadow p-6 text-center transition-transform transform hover:-translate-y-1 duration-300 border border-transparent hover:border-primary-600">
        <div class="flex justify-center mb-2">
            <i class="fas fa-check-circle text-primary-600 text-4xl"></i>
        </div>
        <p class="text-sm text-gray-500 font-semibold">Eventos Activos</p>
        <p id="activeEventsCount" class="text-3xl font-bold text-primary-600">{{ $activeEvents }}</p>
    </div>

    <div class="flex-1 min-w-[200px] bg-white rounded-lg shadow p-6 text-center transition-transform transform hover:-translate-y-1 duration-300 border border-transparent hover:border-primary-600">
        <div class="flex justify-center mb-2">
            <i class="fas fa-times-circle text-red-600 text-4xl"></i>
        </div>
        <p class="text-sm text-gray-500 font-semibold">Eventos Inactivos</p>
        <p id="inactiveEventsCount" class="text-3xl font-bold text-red-600">{{ $inactiveEvents }}</p>
    </div>

    <div class="flex-1 min-w-[200px] bg-white rounded-lg shadow p-6 text-center transition-transform transform hover:-translate-y-1 duration-300 border border-transparent hover:border-primary-600">
        <div class="flex justify-center mb-2">
            <i class="fas fa-desktop text-primary-600 text-4xl"></i>
        </div>
        <p class="text-sm text-gray-500 font-semibold">Eventos Virtuales</p>
        <p id="virtualEventsCount" class="text-3xl font-bold text-primary-600">{{ $virtualEvents }}</p>
    </div>
</div>