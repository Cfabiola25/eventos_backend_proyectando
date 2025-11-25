<div class="flex flex-wrap sm:flex-nowrap gap-4 mb-6">
    <!-- Total de Modalidades -->
    <div class="stat-card w-full sm:w-1/3 bg-white rounded-lg shadow p-6 text-center transition-transform transform hover:-translate-y-1 duration-300 border border-transparent hover:border-primary-600 hover:shadow-red-300">
        <div class="flex justify-center mb-2">
            <i class="fas fa-layer-group text-primary-600 text-4xl"></i>
        </div>
        <p class="text-sm text-gray-500 font-semibold">Total de Modalidades</p>
        <p id="totalModalitiesCount" class="text-3xl font-bold text-primary-600">{{ $totalModalities }}</p>
    </div>

    <!-- Modalidades Activas -->
    <div class="stat-card w-full sm:w-1/3 bg-white rounded-lg shadow p-6 text-center transition-transform transform hover:-translate-y-1 duration-300 border border-transparent hover:border-primary-600 hover:shadow-red-300">
        <div class="flex justify-center mb-2">
            <i class="fas fa-check-circle text-green-600 text-4xl"></i>
        </div>
        <p class="text-sm text-gray-500 font-semibold">Modalidades Activas</p>
        <p id="activeModalitiesCount" class="text-3xl font-bold text-green-600">{{ $activeModalities }}</p>
    </div>

    <!-- Modalidades Inactivas -->
    <div class="stat-card w-full sm:w-1/3 bg-white rounded-lg shadow p-6 text-center transition-transform transform hover:-translate-y-1 duration-300 border border-transparent hover:border-primary-600 hover:shadow-red-300">
        <div class="flex justify-center mb-2">
            <i class="fas fa-times-circle text-gray-600 text-4xl"></i>
        </div>
        <p class="text-sm text-gray-500 font-semibold">Modalidades Inactivas</p>
        <p id="inactiveModalitiesCount" class="text-3xl font-bold text-gray-600">{{ $inactiveModalities }}</p>
    </div>
</div>