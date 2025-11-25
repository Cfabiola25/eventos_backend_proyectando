<div class="overflow-x-auto rounded-lg border-2 border-gray-300">
    <table class="min-w-full divide-y-2 divide-gray-300 border-collapse">
        <thead class="bg-primary-600">
            <tr class="divide-x-2 divide-primary-700">
                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider border-r-2 border-primary-700">
                    Ubicación
                </th>
                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider border-r-2 border-primary-700">
                    Dirección
                </th>
                <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-white uppercase tracking-wider border-r-2 border-primary-700">
                    Ciudad/País
                </th>
                <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-white uppercase tracking-wider border-r-2 border-primary-700">
                    Maps
                </th>
                <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-white uppercase tracking-wider border-r-2 border-primary-700">
                    Estado
                </th>
                <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-white uppercase tracking-wider">
                    Acciones
                </th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y-2 divide-gray-300">
            @forelse($locations as $location)
            <tr class="hover:bg-gray-50 transition-colors duration-200 divide-x-2 divide-gray-300">
                <td class="px-6 py-4 whitespace-nowrap border-r-2 border-gray-300">
                    <div class="flex items-center">
                        @if($location->image)
                        <div class="flex-shrink-0 h-12 w-12 mr-3">
                            <img class="h-12 w-12 rounded-lg object-cover border-2 border-gray-200"
                                src="{{ $location->image }}"
                                alt="{{ $location->name }}">
                        </div>
                        @else
                        <div class="flex-shrink-0 h-12 w-12 mr-3 rounded-lg bg-primary-100 flex items-center justify-center">
                            <i class="fas fa-map-marker-alt text-primary-600 text-xl"></i>
                        </div>
                        @endif
                        <div>
                            <div class="text-sm font-bold text-gray-900 cursor-help"
                                title="{{ $location->name }}"
                                data-tooltip="true">
                                {{ Str::limit($location->name, 25) }}
                            </div>
                            @if($location->room)
                            <div class="text-xs text-gray-500">
                                <i class="fas fa-door-open mr-1"></i>{{ $location->room }}
                            </div>
                            @endif
                        </div>
                    </div>
                </td>
                <td class="px-6 py-4 border-r-2 border-gray-300">
                    <div class="text-sm text-gray-700 cursor-help"
                        title="{{ $location->address }}"
                        data-tooltip="true">
                        {{ Str::limit($location->address, 40) }}
                    </div>
                    @if($location->reference_point)
                    <div class="text-xs text-gray-500 mt-1 cursor-help"
                        title="{{ $location->reference_point }}"
                        data-tooltip="true">
                        <i class="fas fa-info-circle mr-1"></i>{{ Str::limit($location->reference_point, 30) }}
                    </div>
                    @endif
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-center border-r-2 border-gray-300">
                    @if($location->city || $location->country)
                    <div class="text-sm text-gray-700">
                        @if($location->city)
                        <div>
                            <i class="fas fa-city text-primary-600 mr-1"></i>{{ $location->city }}
                        </div>
                        @endif
                        @if($location->country)
                        <div class="text-xs text-gray-500 mt-1">
                            <i class="fas fa-flag text-primary-600 mr-1"></i>{{ $location->country }}
                        </div>
                        @endif
                    </div>
                    @else
                    <span class="text-xs text-gray-400">No especificado</span>
                    @endif
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-center border-r-2 border-gray-300">
                    @if($location->google_maps_link)
                    <a href="{{ $location->google_maps_link }}"
                        target="_blank"
                        class="inline-flex items-center px-3 py-1.5 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 transition-colors"
                        title="Ver en Google Maps"
                        data-tooltip="true">
                        <i class="fas fa-map-marked-alt mr-1"></i>
                        Ver Mapa
                    </a>
                    @else
                    <span class="text-xs text-gray-400">Sin enlace</span>
                    @endif
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-center border-r-2 border-gray-300">
                    <button onclick="toggleStatus('{{ $location->uuid }}')"
                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold transition-colors cursor-pointer
                                {{ $location->is_active ? 'bg-green-100 text-green-800 hover:bg-green-200' : 'bg-red-100 text-red-800 hover:bg-red-200' }}"
                            title="Click para cambiar estado">
                        <i class="fas {{ $location->is_active ? 'fa-check-circle' : 'fa-times-circle' }} mr-1"></i>
                        {{ $location->is_active ? 'Activo' : 'Inactivo' }}
                    </button>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                    <div class="flex justify-center space-x-3">

                        <!-- Botón Editar -->
                        <a href="{{ route('locations.edit', $location->uuid) }}"
                            class="text-blue-600 hover:text-blue-900 transition-colors"
                            title="Editar ubicación">
                            <i class="fas fa-edit text-lg"></i>
                        </a>

                        <!-- Botón Eliminar -->
                        <button onclick="deleteLocation('{{ $location->uuid }}')"
                                class="text-red-600 hover:text-red-900 transition-colors"
                                title="Eliminar ubicación">
                            <i class="fas fa-trash-alt text-lg"></i>
                        </button>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="px-6 py-8 text-center">
                    <div class="flex flex-col items-center justify-center">
                        <i class="fas fa-map-marked-alt text-gray-400 text-5xl mb-3"></i>
                        <p class="text-gray-500 text-lg font-semibold">No hay ubicaciones registradas</p>
                        <p class="text-gray-400 text-sm mt-1">Haz clic en "Agregar Ubicación" para comenzar</p>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Paginación -->
<div class="mt-6 flex flex-col sm:flex-row justify-between items-center gap-4">
    <div class="text-sm text-gray-700">
        Mostrando
        <span class="font-semibold">{{ $locations->firstItem() ?? 0 }}</span>
        -
        <span class="font-semibold">{{ $locations->lastItem() ?? 0 }}</span>
        de
        <span class="font-semibold">{{ $locations->total() }}</span>
        resultado(s)
    </div>

    @if($locations->hasPages())
    <div class="flex items-center space-x-2">
        @if ($locations->onFirstPage())
            <span class="px-3 py-2 text-sm font-medium text-gray-400 bg-gray-100 border border-gray-300 rounded-lg cursor-not-allowed">
                <i class="fas fa-chevron-left"></i>
            </span>
        @else
            <button data-page="{{ $locations->currentPage() - 1 }}"
                    class="pagination-link px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:text-primary-600 transition-colors">
                <i class="fas fa-chevron-left"></i>
            </button>
        @endif

        @foreach ($locations->getUrlRange(1, $locations->lastPage()) as $page => $url)
            @if ($page == $locations->currentPage())
                <span class="px-3 py-2 text-sm font-medium text-white bg-primary-600 border border-primary-600 rounded-lg">
                    {{ $page }}
                </span>
            @else
                <button data-page="{{ $page }}"
                        class="pagination-link px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:text-primary-600 transition-colors">
                    {{ $page }}
                </button>
            @endif
        @endforeach

        @if ($locations->hasMorePages())
            <button data-page="{{ $locations->currentPage() + 1 }}"
                    class="pagination-link px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:text-primary-600 transition-colors">
                <i class="fas fa-chevron-right"></i>
            </button>
        @else
            <span class="px-3 py-2 text-sm font-medium text-gray-400 bg-gray-100 border border-gray-300 rounded-lg cursor-not-allowed">
                <i class="fas fa-chevron-right"></i>
            </span>
        @endif
    </div>
    @endif
</div>

<style>
/* Tooltips mejorados */
[data-tooltip="true"] {
    position: relative;
}

[data-tooltip="true"]:hover::after {
    content: attr(title);
    position: absolute;
    bottom: 100%;
    left: 50%;
    transform: translateX(-50%);
    background-color: #1f2937;
    color: white;
    padding: 8px 12px;
    border-radius: 6px;
    font-size: 12px;
    white-space: normal;
    max-width: 300px;
    width: max-content;
    z-index: 1000;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    animation: fadeIn 0.2s ease-in;
}

[data-tooltip="true"]:hover::before {
    content: '';
    position: absolute;
    bottom: 100%;
    left: 50%;
    transform: translateX(-50%) translateY(6px);
    border: 6px solid transparent;
    border-top-color: #1f2937;
    z-index: 1000;
    animation: fadeIn 0.2s ease-in;
}

@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}
</style>