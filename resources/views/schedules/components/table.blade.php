<div class="overflow-x-auto rounded-lg border-2 border-gray-300">
    <table class="min-w-full divide-y-2 divide-gray-300 border-collapse">
        <thead class="bg-primary-600">
            <tr class="divide-x-2 divide-primary-700">
                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider border-r-2 border-primary-700">
                    Fecha de Inicio
                </th>
                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider border-r-2 border-primary-700">
                    Fecha de Finalización
                </th>
                <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-white uppercase tracking-wider border-r-2 border-primary-700">
                    Hora de Inicio
                </th>
                <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-white uppercase tracking-wider border-r-2 border-primary-700">
                    Hora de Finalización
                </th>
                <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-white uppercase tracking-wider border-r-2 border-primary-700">
                    Duración
                </th>
                <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-white uppercase tracking-wider">
                    Acciones
                </th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y-2 divide-gray-300">
            @forelse($schedules as $schedule)
            @php
                // CALCULAR DURACIÓN CON CARBON - VERSIÓN CORREGIDA
                try {
                    // Si las fechas ya son objetos Carbon, usar directamente
                    $startDateTime = $schedule->start_date->copy()->setTimeFromTimeString($schedule->start_time);
                    $endDateTime = $schedule->end_date->copy()->setTimeFromTimeString($schedule->end_time);
                    
                    // Calcular diferencia en minutos
                    $totalMinutes = $startDateTime->diffInMinutes($endDateTime);
                    
                    // Convertir a horas y minutos
                    $hours = floor($totalMinutes / 60);
                    $minutes = $totalMinutes % 60;
                    
                    // Formatear la duración
                    if ($hours > 0 && $minutes > 0) {
                        $duration = $hours . 'h ' . $minutes . 'm';
                    } elseif ($hours > 0) {
                        $duration = $hours . 'h';
                    } else {
                        $duration = $minutes . 'm';
                    }
                } catch (Exception $e) {
                    $duration = 'Error';
                }
            @endphp
            <tr class="hover:bg-gray-50 transition-colors duration-200 divide-x-2 divide-gray-300">
                <td class="px-6 py-4 whitespace-nowrap border-r-2 border-gray-300">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 h-10 w-10 bg-primary-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-calendar-day text-primary-600"></i>
                        </div>
                        <div class="ml-4">
                            <div class="text-sm font-bold text-gray-900">
                                {{ $schedule->start_date->format('d/m/Y') }}
                            </div>
                            <div class="text-xs text-gray-500">
                                {{ ucfirst($schedule->start_date->locale('es')->translatedFormat('l')) }}
                            </div>
                        </div>
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap border-r-2 border-gray-300">
                    <div class="text-sm font-semibold text-gray-900">
                        {{ $schedule->end_date->format('d/m/Y') }}
                    </div>
                    <div class="text-xs text-gray-500">
                        {{ ucfirst($schedule->end_date->locale('es')->translatedFormat('l')) }}
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-center border-r-2 border-gray-300">
                    <div class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                        <i class="fas fa-play-circle mr-1"></i>
                        {{ \Carbon\Carbon::parse($schedule->start_time)->format('h:i A') }}
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-center border-r-2 border-gray-300">
                    <div class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-800">
                        <i class="fas fa-stop-circle mr-1"></i>
                        {{ \Carbon\Carbon::parse($schedule->end_time)->format('h:i A') }}
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-center border-r-2 border-gray-300">
                    <div class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-800">
                        <i class="fas fa-hourglass-half mr-1"></i>
                        {{ $duration }}
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                    <div class="flex justify-center space-x-3">
                        <!-- Botón Editar -->
                        <button onclick="editSchedule('{{ $schedule->uuid }}')"
                                class="text-blue-600 hover:text-blue-900 transition-colors"
                                title="Editar horario">
                            <i class="fas fa-edit text-lg"></i>
                        </button>

                        <!-- Botón Eliminar - AHORA ABRE MODAL -->
                        <button onclick="confirmDeleteSchedule('{{ $schedule->uuid }}')"
                                class="text-red-600 hover:text-red-900 transition-colors"
                                title="Eliminar horario">
                            <i class="fas fa-trash-alt text-lg"></i>
                        </button>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="px-6 py-8 text-center">
                    <div class="flex flex-col items-center justify-center">
                        <i class="fas fa-inbox text-gray-400 text-5xl mb-3"></i>
                        <p class="text-gray-500 text-lg font-semibold">No hay horarios registrados</p>
                        <p class="text-gray-400 text-sm mt-1">Haz clic en "Agregar Horario" para comenzar</p>
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
        <span class="font-semibold">{{ $schedules->firstItem() ?? 0 }}</span>
        -
        <span class="font-semibold">{{ $schedules->lastItem() ?? 0 }}</span>
        de
        <span class="font-semibold">{{ $schedules->total() }}</span>
        resultado(s)
    </div>

    @if($schedules->hasPages())
    <div class="flex items-center space-x-2">
        @if ($schedules->onFirstPage())
            <span class="px-3 py-2 text-sm font-medium text-gray-400 bg-gray-100 border border-gray-300 rounded-lg cursor-not-allowed">
                <i class="fas fa-chevron-left"></i>
            </span>
        @else
            <button data-page="{{ $schedules->currentPage() - 1 }}"
                    class="pagination-link px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:text-primary-600 transition-colors">
                <i class="fas fa-chevron-left"></i>
            </button>
        @endif

        @foreach ($schedules->getUrlRange(1, $schedules->lastPage()) as $page => $url)
            @if ($page == $schedules->currentPage())
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

        @if ($schedules->hasMorePages())
            <button data-page="{{ $schedules->currentPage() + 1 }}"
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