<div class="overflow-x-auto rounded-lg border-2 border-gray-300">
    <table class="min-w-full divide-y-2 divide-gray-300 border-collapse">
        <thead class="bg-primary-600">
            <tr class="divide-x-2 divide-primary-700">
                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider border-r-2 border-primary-700">
                    Evento
                </th>
                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider border-r-2 border-primary-700">
                    Modalidad
                </th>
                <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-white uppercase tracking-wider border-r-2 border-primary-700">
                    Capacidad
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
            @forelse($events as $event)
            <tr class="hover:bg-gray-50 transition-colors duration-200 divide-x-2 divide-gray-300">
                <td class="px-6 py-4 whitespace-nowrap border-r-2 border-gray-300">
                    <div class="flex items-center">
                        @if($event->image)
                        <div class="flex-shrink-0 h-12 w-12 mr-3">
                            <img class="h-12 w-12 rounded-lg object-cover border-2 border-gray-200"
                                src="{{ $event->image }}"
                                alt="{{ $event->title }}">
                        </div>
                        @else
                        <div class="flex-shrink-0 h-12 w-12 mr-3 rounded-lg bg-primary-100 flex items-center justify-center">
                            <i class="fas fa-calendar-alt text-primary-600 text-xl"></i>
                        </div>
                        @endif
                        <div>
                            <div class="text-sm font-bold text-gray-900 cursor-help"
                                title="{{ $event->title }}"
                                data-tooltip="true">
                                {{ Str::limit($event->title, 40) }}
                            </div>
                            @if($event->description)
                            <div class="text-xs text-gray-500">
                                <i class="fas fa-align-left mr-1"></i>{{ Str::limit($event->description, 50) }}
                            </div>
                            @endif
                            @if($event->categories->count() > 0)
                            <div class="text-xs text-gray-500 mt-1">
                                <i class="fas fa-tags mr-1"></i>
                                {{ $event->categories->pluck('name')->implode(', ') }}
                            </div>
                            @endif
                        </div>
                    </div>
                </td>
                <td class="px-6 py-4 border-r-2 border-gray-300">
                    @if($event->modality)
                    <div class="text-sm text-gray-700">
                        <span class="font-semibold">{{ $event->modality->name }}</span>
                    </div>
                    @if($event->virtual_link)
                    <div class="text-xs text-gray-500 mt-1">
                        <i class="fas fa-link mr-1"></i>
                        <a href="{{ $event->virtual_link }}" target="_blank" class="text-primary-600 hover:underline">
                            Enlace virtual
                        </a>
                    </div>
                    @endif
                    @else
                    <span class="text-xs text-gray-400">Sin modalidad</span>
                    @endif
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-center border-r-2 border-gray-300">
                    @if($event->max_capacity)
                    <div class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                        <i class="fas fa-users mr-1"></i>
                        {{ $event->max_capacity }}
                    </div>
                    @else
                    <span class="text-xs text-gray-400">Sin límite</span>
                    @endif
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-center border-r-2 border-gray-300">
                    <button onclick="toggleStatus('{{ $event->uuid }}')"
                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold transition-colors cursor-pointer
                                {{ $event->is_active ? 'bg-green-100 text-green-800 hover:bg-green-200' : 'bg-red-100 text-red-800 hover:bg-red-200' }}"
                            title="Click para cambiar estado">
                        <i class="fas {{ $event->is_active ? 'fa-check-circle' : 'fa-times-circle' }} mr-1"></i>
                        {{ $event->is_active ? 'Activo' : 'Inactivo' }}
                    </button>
                </td>

                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                    <div class="flex justify-center space-x-3">
                        <!-- Botón Ver Detalles -->
                        <button onclick="showEventDetails('{{ $event->uuid }}')"
                                class="text-blue-600 hover:text-blue-900 transition-colors"
                                title="Ver detalles del evento">
                            <i class="fas fa-eye text-lg"></i>
                        </button>

                        <!-- Botón Editar -->
                        <a href="{{ route('events.edit', $event->uuid) }}"
                            class="text-yellow-600 hover:text-yellow-900 transition-colors"
                            title="Editar evento">
                            <i class="fas fa-edit text-lg"></i>
                        </a>

                        <!-- Botón Eliminar -->
                        <button onclick="confirmDelete('{{ $event->uuid }}', '{{ $event->title }}')"
                                class="text-red-600 hover:text-red-900 transition-colors"
                                title="Eliminar evento">
                            <i class="fas fa-trash-alt text-lg"></i>
                        </button>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="px-6 py-8 text-center">
                    <div class="flex flex-col items-center justify-center">
                        <i class="fas fa-calendar-times text-gray-400 text-5xl mb-3"></i>
                        <p class="text-gray-500 text-lg font-semibold">No hay eventos registrados</p>
                        <p class="text-gray-400 text-sm mt-1">Haz clic en "Nuevo Evento" para comenzar</p>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Paginación Mejorada -->
<div class="mt-6 flex flex-col sm:flex-row justify-between items-center gap-4">
    <div class="text-sm text-gray-700">
        Mostrando
        <span class="font-semibold">{{ $events->firstItem() ?? 0 }}</span>
        -
        <span class="font-semibold">{{ $events->lastItem() ?? 0 }}</span>
        de
        <span class="font-semibold">{{ $events->total() }}</span>
        resultado(s)
    </div>

    @if($events->hasPages())
    <div class="flex items-center space-x-1">
        <!-- Botón Primera Página -->
        @if ($events->currentPage() > 2)
            <a href="{{ $events->url(1) }}"
                    class="px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:text-primary-600 transition-colors"
                    title="Primera página">
                1
            </a>
            @if ($events->currentPage() > 3)
                <span class="px-2 py-2 text-sm text-gray-500">...</span>
            @endif
        @endif

        <!-- Páginas alrededor de la actual -->
        @php
            $currentPage = $events->currentPage();
            $lastPage = $events->lastPage();
            $startPage = max(1, $currentPage - 2);
            $endPage = min($lastPage, $currentPage + 2);
        @endphp

        @for ($page = $startPage; $page <= $endPage; $page++)
            @if ($page == $events->currentPage())
                <span class="px-3 py-2 text-sm font-medium text-white bg-primary-600 border border-primary-600 rounded-lg">
                    {{ $page }}
                </span>
            @else
                <a href="{{ $events->url($page) }}"
                        class="px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:text-primary-600 transition-colors">
                    {{ $page }}
                </a>
            @endif
        @endfor

        <!-- Botón Última Página -->
        @if ($events->currentPage() < $lastPage - 1)
            @if ($events->currentPage() < $lastPage - 2)
                <span class="px-2 py-2 text-sm text-gray-500">...</span>
            @endif
            <a href="{{ $events->url($lastPage) }}"
                    class="px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:text-primary-600 transition-colors"
                    title="Última página">
                {{ $lastPage }}
            </a>
        @endif

        <!-- Navegación Anterior/Siguiente -->
        @if ($events->onFirstPage())
            <span class="px-3 py-2 text-sm font-medium text-gray-400 bg-gray-100 border border-gray-300 rounded-lg cursor-not-allowed">
                <i class="fas fa-chevron-left"></i>
            </span>
        @else
            <a href="{{ $events->previousPageUrl() }}"
                    class="px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:text-primary-600 transition-colors"
                    title="Página anterior">
                <i class="fas fa-chevron-left"></i>
            </a>
        @endif

        @if ($events->hasMorePages())
            <a href="{{ $events->nextPageUrl() }}"
                    class="px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:text-primary-600 transition-colors"
                    title="Página siguiente">
                <i class="fas fa-chevron-right"></i>
            </a>
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

/* Estilos para los badges de relaciones */
.inline-flex.items-center.px-2\.py-0\.5 {
    max-width: 120px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}
</style>