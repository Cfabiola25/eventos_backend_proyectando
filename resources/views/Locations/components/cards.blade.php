<div class="flex flex-wrap sm:flex-nowrap gap-4 mb-6">
    <!-- Total de Ubicaciones -->
    <div class="w-full sm:w-1/3 bg-white rounded-lg shadow p-6 text-center transition-transform transform hover:-translate-y-1 duration-300 border border-transparent hover:border-primary-600 hover:shadow-red-300">
        <div class="flex justify-center mb-2">
            <i class="fas fa-map-marker-alt text-primary-600 text-4xl"></i>
        </div>
        <p class="text-sm text-gray-500 font-semibold">Total de Ubicaciones</p>
        <p id="totalLocationsCount" class="text-3xl font-bold text-primary-600">{{ $totalLocations }}</p>
    </div>

    <!-- Ubicaciones Activas -->
    <div class="w-full sm:w-1/3 bg-white rounded-lg shadow p-6 text-center transition-transform transform hover:-translate-y-1 duration-300 border border-transparent hover:border-primary-600 hover:shadow-red-300">
        <div class="flex justify-center mb-2">
            <i class="fas fa-check-circle text-primary-600 text-4xl"></i>
        </div>
        <p class="text-sm text-gray-500 font-semibold">Ubicaciones Activas</p>
        <p id="activeLocationsCount" class="text-3xl font-bold text-primary-600">{{ $activeLocations }}</p>
    </div>

    <!-- Ubicaciones Inactivas -->
    <div class="w-full sm:w-1/3 bg-white rounded-lg shadow p-6 text-center transition-transform transform hover:-translate-y-1 duration-300 border border-transparent hover:border-primary-600 hover:shadow-red-300">
        <div class="flex justify-center mb-2">
            <i class="fas fa-times-circle text-red-600 text-4xl"></i>
        </div>
        <p class="text-sm text-gray-500 font-semibold">Ubicaciones Inactivas</p>
        <p id="inactiveLocationsCount" class="text-3xl font-bold text-red-600">{{ $inactiveLocations }}</p>
    </div>
</div>