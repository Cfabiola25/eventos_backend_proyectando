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
                @if(Auth::user()->is_admin)
                 <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-white uppercase tracking-wider border-r-2 border-primary-700">
                    Capacidad
                </th> 
                @endif    
                <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-white uppercase tracking-wider border-r-2 border-primary-700">
                    Registrados
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
            <tr class="hover:bg-gray-50 transition-colors duration-200 divide-x-2 divide-gray-300 event-row">
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
                            <i class="fas fa-calendar text-primary-600 text-xl"></i>
                        </div>
                        @endif
                        <div>
                            <div class="text-sm font-bold text-gray-900 cursor-help"
                                title="{{ $event->title }}"
                                data-tooltip="true">
                                {{ Str::limit($event->title, 35) }}
                            </div>
                            @if($event->description)
                            <div class="text-xs text-gray-500 mt-1">
                                {{ Str::limit($event->description, 50) }}
                            </div>
                            @endif
                        </div>
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap border-r-2 border-gray-300">
                    @if($event->modality)
                    <div class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                        <i class="fas fa-desktop mr-1"></i>
                        {{ $event->modality->name }}
                    </div>
                    @else
                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                        <i class="fas fa-times mr-1"></i>
                        Sin asignar
                    </span>
                    @endif
                </td>
                {{-- aqui tambien debe comentarearse --}}
                @if(Auth::user()->is_admin)
                <td class="px-6 py-4 whitespace-nowrap text-center border-r-2 border-gray-300">
                    <div class="text-sm text-gray-700 font-semibold">
                        {{ $event->max_capacity ?? 'Ilimitada' }}
                    </div>
                </td>   
                @endif    
                {{-- hasta aqui  --}}
                <td class="px-6 py-4 whitespace-nowrap text-center border-r-2 border-gray-300">
                    <div class="flex flex-col items-center">
                        <span class="text-lg font-bold text-primary-600">
                            {{ $event->registration_events_count }}
                        </span>
                        @if($event->max_capacity)
                        <div class="w-full bg-gray-200 rounded-full h-2 mt-1">
                            <div class="bg-primary-600 h-2 rounded-full" 
                                style="width: {{ min(100, ($event->registration_events_count / $event->max_capacity) * 100) }}%">
                            </div>
                        </div>
                        <span class="text-xs text-gray-500 mt-1">
                            {{ number_format(($event->registration_events_count / $event->max_capacity) * 100, 1) }}%
                        </span>
                        @endif
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-center border-r-2 border-gray-300">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold
                        {{ $event->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        <i class="fas {{ $event->is_active ? 'fa-check-circle' : 'fa-times-circle' }} mr-1"></i>
                        {{ $event->is_active ? 'Activo' : 'Inactivo' }}
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                    <div class="flex justify-center space-x-3">
                        <!-- Botón Ver Asistencias -->
                        <a href="{{ route('event-attendances.show-attendances', $event->uuid) }}"
                            class="text-blue-600 hover:text-blue-900 transition-colors bg-blue-100 hover:bg-blue-200 p-2 rounded-lg"
                            title="Ver usuarios registrados">
                            <i class="fas fa-users text-lg"></i>
                        </a>

                        @if(Auth::user()->is_admin)
                        <!-- Botón Ver Detalles -->
                        <button onclick="showEventDetails('{{ $event->uuid }}')"
                            class="text-purple-600 hover:text-purple-900 transition-colors bg-purple-100 hover:bg-purple-200 p-2 rounded-lg"
                            title="Ver detalles">
                            <i class="fas fa-eye text-lg"></i>
                        </button>
                        @endif    
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="px-6 py-8 text-center">
                    <div class="flex flex-col items-center justify-center">
                        <i class="fas fa-calendar-times text-gray-400 text-5xl mb-3"></i>
                        <p class="text-gray-500 text-lg font-semibold">No hay eventos registrados</p>
                        <p class="text-gray-400 text-sm mt-1">No se encontraron eventos con los criterios de búsqueda</p>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Paginación -->
@if($events->hasPages())
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

    <div class="flex items-center space-x-1">
        <!-- Botón Primera Página -->
        @if ($events->currentPage() > 2)
            <button data-page="1"
                    class="pagination-link px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:text-primary-600 transition-colors"
                    title="Primera página">
                1
            </button>
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
                <button data-page="{{ $page }}"
                        class="pagination-link px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:text-primary-600 transition-colors">
                    {{ $page }}
                </button>
            @endif
        @endfor

        <!-- Botón Última Página -->
        @if ($events->currentPage() < $lastPage - 1)
            @if ($events->currentPage() < $lastPage - 2)
                <span class="px-2 py-2 text-sm text-gray-500">...</span>
            @endif
            <button data-page="{{ $lastPage }}"
                    class="pagination-link px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:text-primary-600 transition-colors"
                    title="Última página">
                {{ $lastPage }}
            </button>
        @endif

        <!-- Navegación Anterior/Siguiente -->
        @if ($events->onFirstPage())
            <span class="px-3 py-2 text-sm font-medium text-gray-400 bg-gray-100 border border-gray-300 rounded-lg cursor-not-allowed">
                <i class="fas fa-chevron-left"></i>
            </span>
        @else
            <button data-page="{{ $events->currentPage() - 1 }}"
                    class="pagination-link px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:text-primary-600 transition-colors"
                    title="Página anterior">
                <i class="fas fa-chevron-left"></i>
            </button>
        @endif

        @if ($events->hasMorePages())
            <button data-page="{{ $events->currentPage() + 1 }}"
                    class="pagination-link px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:text-primary-600 transition-colors"
                    title="Página siguiente">
                <i class="fas fa-chevron-right"></i>
            </button>
        @else
            <span class="px-3 py-2 text-sm font-medium text-gray-400 bg-gray-100 border border-gray-300 rounded-lg cursor-not-allowed">
                <i class="fas fa-chevron-right"></i>
            </span>
        @endif
    </div>
</div>
@endif