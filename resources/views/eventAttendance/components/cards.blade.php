<div class="flex flex-wrap gap-4 mb-6">
    <div class="flex-1 min-w-[200px] bg-white rounded-lg shadow p-6 text-center transition-all duration-300 border-2 border-transparent hover:border-red-600 hover:-translate-y-1 hover:shadow-lg">
        <div class="flex justify-center mb-2">
            <i class="fas fa-calendar-alt text-primary-600 text-4xl"></i>
        </div>
        <p class="text-sm text-gray-500 font-semibold">Total de Eventos</p>
        <p id="totalEventsCount" class="text-3xl font-bold text-primary-600">{{ $totalEvents }}</p>
    </div>

    <div class="flex-1 min-w-[200px] bg-white rounded-lg shadow p-6 text-center transition-all duration-300 border-2 border-transparent hover:border-red-600 hover:-translate-y-1 hover:shadow-lg">
        <div class="flex justify-center mb-2">
            <i class="fas fa-play-circle text-green-600 text-4xl"></i>
        </div>
        <p class="text-sm text-gray-500 font-semibold">Eventos Activos</p>
        <p id="activeEventsCount" class="text-3xl font-bold text-green-600">{{ $activeEvents }}</p>
    </div>

    <div class="flex-1 min-w-[200px] bg-white rounded-lg shadow p-6 text-center transition-all duration-300 border-2 border-transparent hover:border-red-600 hover:-translate-y-1 hover:shadow-lg">
        <div class="flex justify-center mb-2">
            <i class="fas fa-pause-circle text-red-600 text-4xl"></i>
        </div>
        <p class="text-sm text-gray-500 font-semibold">Eventos Inactivos</p>
        <p id="inactiveEventsCount" class="text-3xl font-bold text-red-600">{{ $inactiveEvents }}</p>
    </div>

    <div class="flex-1 min-w-[200px] bg-white rounded-lg shadow p-6 text-center transition-all duration-300 border-2 border-transparent hover:border-red-600 hover:-translate-y-1 hover:shadow-lg">
        <div class="flex justify-center mb-2">
            <i class="fas fa-users text-purple-600 text-4xl"></i>
        </div>
        <p class="text-sm text-gray-500 font-semibold">Con Asistencias</p>
        <p id="eventsWithAttendanceCount" class="text-3xl font-bold text-purple-600">{{ $eventsWithAttendance }}</p>
    </div>
</div>