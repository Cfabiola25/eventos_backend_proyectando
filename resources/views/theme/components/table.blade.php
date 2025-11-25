<div class="bg-white rounded-xl shadow p-6">
    <!-- Botón para crear nuevo tema -->
    <div class="mb-4 flex justify-between items-center">
        <h2 class="text-lg font-semibold text-gray-800">Lista de Temas</h2>
        <button onclick="openCreateModal()"
            class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Nuevo Tema
        </button>
    </div>

    <div class="w-full max-w-full overflow-x-auto mt-4 rounded-lg">
        <table class="min-w-full w-full text-sm text-left border border-gray-200">
            <thead class="bg-red-600 text-white">
                <tr class="border-b border-red-700">
                    <th class="px-2 py-2 text-left border-r border-red-700">Nombre</th>
                    <th class="px-2 py-2 text-left border-r border-red-700">Fecha Inicio</th>
                    <th class="px-2 py-2 text-left border-r border-red-700">Agenda Asociada</th>
                    <th class="px-2 py-2 text-left border-r border-red-700">Descripción</th>
                    <th class="px-2 py-2 text-left">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($themes as $theme)
                    <tr class="hover:bg-gray-50 transition-colors" id="theme-row-{{ $theme->uuid }}">

                        <!-- Nombre -->
                        <td class="border px-2 py-2">
                            <div class="font-medium text-gray-900 whitespace-nowrap" id="name-{{ $theme->uuid }}">
                                {{ $theme->name }}
                            </div>
                        </td>

                        <!-- Fecha Inicio -->
                        <td class="border px-2 py-2">
                            <div class="text-xs text-gray-500 whitespace-nowrap"
                                id="start-date-{{ $theme->uuid }}">
                                {{ \Carbon\Carbon::parse($theme->start_date)->format('d/m/Y') }}
                            </div>
                        </td>

                        <!-- Agenda Asociada -->
                        <td class="border px-2 py-2">
                            <div class="text-xs text-gray-500 whitespace-nowrap" id="agenda-{{ $theme->uuid }}">
                                @if($theme->agenda)
                                    {{ $theme->agenda->title }}
                                @else
                                    <span class="text-gray-400">Sin agenda</span>
                                @endif
                            </div>
                        </td>

                        <!-- Descripción (acortada) -->
                        <td class="border px-2 py-2">
                            <div class="text-xs text-gray-900 whitespace-nowrap truncate max-w-[150px]"
                                title="{{ $theme->description }}" id="description-{{ $theme->uuid }}">
                                {{ Str::limit($theme->description, 50, '...') ?? 'Sin descripción' }}
                            </div>
                        </td>

                        <!-- Acciones -->
                        <td class="border px-2 py-2">
                            <div class="flex space-x-1 justify-center">
                                <!-- Botón para ver descripción completa en modal -->
                                <button type="button"
                                    onclick="openDescriptionModal('{{ $theme->name }}', `{{ addslashes($theme->description) }}`)"
                                    class="text-purple-600 hover:text-purple-800 p-1 rounded hover:bg-purple-50"
                                    title="Ver descripción completa">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>
                                <!-- Botón para editar en modal -->
                                <button type="button"
                                    onclick="openEditModal('{{ $theme->uuid }}')"
                                    class="text-blue-600 hover:text-blue-800 p-1 rounded hover:bg-blue-50"
                                    title="Editar tema">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </button>
                                <!-- Botón para eliminar en modal -->
                                <button type="button"
                                    onclick="openDeleteModal('{{ $theme->uuid }}', `{{ addslashes($theme->name) }}`)"
                                    class="text-red-600 hover:text-red-800 p-1 rounded hover:bg-red-50"
                                    title="Eliminar tema">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="border px-4 py-8 text-center text-gray-500">
                            <div class="flex flex-col items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400 mb-4"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                </svg>
                                <h3 class="text-lg font-medium text-gray-700 mb-2">No se encontraron temas</h3>
                                <p class="text-sm text-gray-500">No hay temas registrados en el sistema.</p>
                                <button onclick="openCreateModal()"
                                    class="mt-4 bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                    </svg>
                                    Crear Primer Tema
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>