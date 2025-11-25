<div class="flex flex-wrap gap-4 mb-6">
    <div class="flex-1 min-w-[200px] bg-white rounded-lg shadow p-6 text-center transition-transform transform hover:-translate-y-1 duration-300 border border-transparent hover:border-primary-600">
        <div class="flex justify-center mb-2">
            <i class="fas fa-users text-primary-600 text-4xl"></i>
        </div>
        <p class="text-sm text-gray-500 font-semibold">Total de Usuarios</p>
        <p id="totalUsersCount" class="text-3xl font-bold text-primary-600">{{ $totalUsers }}</p>
    </div>

    <div class="flex-1 min-w-[200px] bg-white rounded-lg shadow p-6 text-center transition-transform transform hover:-translate-y-1 duration-300 border border-transparent hover:border-primary-600">
        <div class="flex justify-center mb-2">
            <i class="fas fa-user-check text-primary-600 text-4xl"></i>
        </div>
        <p class="text-sm text-gray-500 font-semibold">Usuarios Activos</p>
        <p id="activeUsersCount" class="text-3xl font-bold text-primary-600">{{ $activeUsers }}</p>
    </div>

    <div class="flex-1 min-w-[200px] bg-white rounded-lg shadow p-6 text-center transition-transform transform hover:-translate-y-1 duration-300 border border-transparent hover:border-primary-600">
        <div class="flex justify-center mb-2">
            <i class="fas fa-user-times text-red-600 text-4xl"></i>
        </div>
        <p class="text-sm text-gray-500 font-semibold">Usuarios Inactivos</p>
        <p id="inactiveUsersCount" class="text-3xl font-bold text-red-600">{{ $inactiveUsers }}</p>
    </div>

    <div class="flex-1 min-w-[200px] bg-white rounded-lg shadow p-6 text-center transition-transform transform hover:-translate-y-1 duration-300 border border-transparent hover:border-primary-600">
        <div class="flex justify-center mb-2">
            <i class="fas fa-certificate text-primary-600 text-4xl"></i>
        </div>
        <p class="text-sm text-gray-500 font-semibold">Diplomas Descargados</p>
        <p id="downloadedDiplomasCount" class="text-3xl font-bold text-primary-600">{{ $downloadedDiplomas }}</p>
    </div>
</div>