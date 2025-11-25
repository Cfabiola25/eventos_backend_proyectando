<div class="overflow-x-auto rounded-lg border border-gray-200">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-primary-600">
            <tr>
                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">
                    Tipo
                </th>
                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">
                    Descripción
                </th>
                <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-white uppercase tracking-wider">
                    Estado
                </th>
                <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-white uppercase tracking-wider">
                    Fecha Creación
                </th>
                <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-white uppercase tracking-wider">
                    Última Actualización
                </th>
                <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-white uppercase tracking-wider">
                    Acciones
                </th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($userTypes as $userType)
            <tr class="hover:bg-gray-50 transition-colors duration-200">
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 h-10 w-10 bg-primary-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-user-tag text-primary-600"></i>
                        </div>
                        <div class="ml-4">
                            <div class="text-sm font-bold text-gray-900">{{ $userType->type }}</div>
                        </div>
                    </div>
                </td>
                <td class="px-6 py-4">
                    <div class="text-sm text-gray-700">{{ Str::limit($userType->description, 60) }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-center">
                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $userType->is_active ? 'text-green-600 bg-green-100' : 'text-red-600 bg-red-100' }}">
                        {{ $userType->is_active ? 'Activo' : 'Inactivo' }}
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">
                    <i class="fas fa-calendar-alt mr-1"></i>
                    {{ $userType->created_at->format('d/m/Y') }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">
                    <i class="fas fa-clock mr-1"></i>
                    {{ $userType->updated_at->format('d/m/Y H:i') }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                    <div class="flex justify-center space-x-2">
                        <!-- Botón Editar -->
                        <button onclick="editUserType('{{ $userType->uuid }}')"
                                class="text-blue-600 hover:text-blue-900 transition-colors"
                                title="Editar">
                            <i class="fas fa-edit text-lg"></i>
                        </button>

                        <!-- Botón Cambiar Estado -->
                        <button onclick="toggleStatus('{{ $userType->uuid }}')"
                                class="text-yellow-600 hover:text-yellow-900 transition-colors"
                                title="Cambiar Estado">
                            <i class="fas fa-toggle-{{ $userType->is_active ? 'on' : 'off' }} text-lg"></i>
                        </button>

                        <!-- Botón Eliminar -->
                        <button onclick="deleteUserType('{{ $userType->uuid }}')"
                                class="text-red-600 hover:text-red-900 transition-colors"
                                title="Eliminar">
                            <i class="fas fa-trash-alt text-lg"></i>
                        </button>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="px-6 py-8 text-center">
                    <div class="flex flex-col items-center justify-center">
                        <i class="fas fa-inbox text-gray-400 text-5xl mb-3"></i>
                        <p class="text-gray-500 text-lg font-semibold">No hay tipos de usuario registrados</p>
                        <p class="text-gray-400 text-sm mt-1">Haz clic en "Agregar Tipo de Usuario" para comenzar</p>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Paginación -->
<div class="mt-4 flex justify-between items-center">
    <div class="text-sm text-gray-700">
        Mostrando <span class="font-semibold">{{ $userTypes->count() }}</span> resultado(s)
    </div>
</div>