<div class="flex flex-wrap sm:flex-nowrap gap-4 mb-6">
    <!-- Total de Programas -->
    <div class="stat-card w-full sm:w-1/3 bg-white rounded-lg shadow p-6 text-center transition-transform transform hover:-translate-y-1 duration-300 border border-transparent hover:border-primary-600 hover:shadow-red-300">
        <div class="flex justify-center mb-2">
            <i class="fas fa-list-alt text-primary-600 text-4xl"></i>
        </div>
        <p class="text-sm text-gray-500 font-semibold">Total de Programas</p>
        <p id="totalProgramsCount" class="text-3xl font-bold text-primary-600">{{ $totalPrograms }}</p>
    </div>

    <!-- Programas Activos -->
    <div class="stat-card w-full sm:w-1/3 bg-white rounded-lg shadow p-6 text-center transition-transform transform hover:-translate-y-1 duration-300 border border-transparent hover:border-primary-600 hover:shadow-red-300">
        <div class="flex justify-center mb-2">
            <i class="fas fa-check-circle text-green-600 text-4xl"></i>
        </div>
        <p class="text-sm text-gray-500 font-semibold">Programas Activos</p>
        <p id="activeProgramsCount" class="text-3xl font-bold text-green-600">{{ $activePrograms }}</p>
    </div>

    <!-- Programas Inactivos -->
    <div class="stat-card w-full sm:w-1/3 bg-white rounded-lg shadow p-6 text-center transition-transform transform hover:-translate-y-1 duration-300 border border-transparent hover:border-primary-600 hover:shadow-red-300">
        <div class="flex justify-center mb-2">
            <i class="fas fa-times-circle text-red-600 text-4xl"></i>
        </div>
        <p class="text-sm text-gray-500 font-semibold">Programas Inactivos</p>
        <p id="inactiveProgramsCount" class="text-3xl font-bold text-red-600">{{ $inactivePrograms }}</p>
    </div>
</div>