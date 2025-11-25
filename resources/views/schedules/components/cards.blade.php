<div class="flex flex-wrap sm:flex-nowrap gap-4 mb-6">
    <!-- Total de Horarios -->
    <div class="stat-card w-full sm:w-1/3 bg-white rounded-lg shadow p-6 text-center transition-transform transform hover:-translate-y-1 duration-300 border border-transparent hover:border-primary-600 hover:shadow-red-300">
        <div class="flex justify-center mb-2">
            <i class="fas fa-clock text-primary-600 text-4xl"></i>
        </div>
        <p class="text-sm text-gray-500 font-semibold">Total de Horarios</p>
        <p class="text-3xl font-bold text-primary-600">{{ $totalSchedules }}</p>
    </div>

    <!-- Horarios Próximos -->
    <div class="stat-card w-full sm:w-1/3 bg-white rounded-lg shadow p-6 text-center transition-transform transform hover:-translate-y-1 duration-300 border border-transparent hover:border-primary-600 hover:shadow-red-300">
        <div class="flex justify-center mb-2">
            <i class="fas fa-calendar-plus text-primary-600 text-4xl"></i>
        </div>
        <p class="text-sm text-gray-500 font-semibold">Horarios Próximos</p>
        <p class="text-3xl font-bold text-primary-600">{{ $upcomingSchedules }}</p>
    </div>

    <!-- Horarios Pasados -->
    <div class="stat-card w-full sm:w-1/3 bg-white rounded-lg shadow p-6 text-center transition-transform transform hover:-translate-y-1 duration-300 border border-transparent hover:border-primary-600 hover:shadow-red-300">
        <div class="flex justify-center mb-2">
            <i class="fas fa-history text-primary-600 text-4xl"></i>
        </div>
        <p class="text-sm text-gray-500 font-semibold">Horarios Pasados</p>
        <p class="text-3xl font-bold text-primary-600">{{ $pastSchedules }}</p>
    </div>
</div>