<div class="flex flex-wrap sm:flex-nowrap gap-4 mb-6">
    <!-- Total de Tipos de Usuario -->
    <div class="w-full sm:w-1/3 bg-white rounded-lg shadow p-6 text-center transition-transform transform hover:-translate-y-1 duration-300 border border-transparent hover:border-primary-600 hover:shadow-red-300">
        <div class="flex justify-center mb-2">
            <i class="fas fa-user-tag text-primary-600 text-4xl"></i>
        </div>
        <p class="text-sm text-gray-500 font-semibold">Total de Tipos de Usuario</p>
        <p class="text-3xl font-bold text-primary-600">{{ $totalUserTypes }}</p>
    </div>

    <!-- Tipos Activos -->
    <div class="w-full sm:w-1/3 bg-white rounded-lg shadow p-6 text-center transition-transform transform hover:-translate-y-1 duration-300 border border-transparent hover:border-primary-600 hover:shadow-red-300">
        <div class="flex justify-center mb-2">
            <i class="fas fa-check-circle text-primary-600 text-4xl"></i>
        </div>
        <p class="text-sm text-gray-500 font-semibold">Tipos Activos</p>
        <p class="text-3xl font-bold text-primary-600">{{ $activeUserTypes }}</p>
    </div>

    <!-- Tipos Inactivos -->
    <div class="w-full sm:w-1/3 bg-white rounded-lg shadow p-6 text-center transition-transform transform hover:-translate-y-1 duration-300 border border-transparent hover:border-primary-600 hover:shadow-red-300">
        <div class="flex justify-center mb-2">
            <i class="fas fa-times-circle text-primary-600 text-4xl"></i>
        </div>
        <p class="text-sm text-gray-500 font-semibold">Tipos Inactivos</p>
        <p class="text-3xl font-bold text-primary-600">{{ $inactiveUserTypes }}</p>
    </div>
</div>