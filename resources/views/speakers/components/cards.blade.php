<div class="flex flex-wrap sm:flex-nowrap gap-4 mb-6">
    <!-- Total de Ponentes -->
    <div class="w-full sm:w-1/3 bg-white rounded-lg shadow p-6 text-center transition-transform transform hover:-translate-y-1 duration-300 border border-transparent hover:border-primary-600 hover:shadow-primary-300">
        <div class="flex justify-center mb-2">
            <i class="fas fa-chalkboard-teacher text-primary-600 text-4xl"></i>
        </div>
        <p class="text-sm text-gray-500 font-semibold">Total de Ponentes</p>
        <p id="totalSpeakersCount" class="text-3xl font-bold text-primary-600">{{ $totalSpeakers }}</p>
    </div>

    <!-- Ponentes Activos -->
    <div class="w-full sm:w-1/3 bg-white rounded-lg shadow p-6 text-center transition-transform transform hover:-translate-y-1 duration-300 border border-transparent hover:border-primary-600 hover:shadow-primary-300">
        <div class="flex justify-center mb-2">
            <i class="fas fa-user-check text-primary-600 text-4xl"></i>
        </div>
        <p class="text-sm text-gray-500 font-semibold">Ponentes Activos</p>
        <p id="activeSpeakersCount" class="text-3xl font-bold text-primary-600">{{ $activeSpeakers }}</p>
    </div>

    <!-- Ponentes Inactivos -->
    <div class="w-full sm:w-1/3 bg-white rounded-lg shadow p-6 text-center transition-transform transform hover:-translate-y-1 duration-300 border border-transparent hover:border-red-600 hover:shadow-primary-300">
        <div class="flex justify-center mb-2">
            <i class="fas fa-user-times text-red-600 text-4xl"></i>
        </div>
        <p class="text-sm text-gray-500 font-semibold">Ponentes Inactivos</p>
        <p id="inactiveSpeakersCount" class="text-3xl font-bold text-red-600">{{ $inactiveSpeakers }}</p>
    </div>
</div>