<div class="overflow-x-auto rounded-lg border-2 border-gray-300">
    <table class="min-w-full divide-y-2 divide-gray-300 border-collapse">
        <thead class="bg-primary-600">
            <tr class="divide-x-2 divide-primary-700">
                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider border-r-2 border-primary-700">
                    Usuario
                </th>
                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider border-r-2 border-primary-700">
                    Documento
                </th>
                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider border-r-2 border-primary-700">
                    Modalidad
                </th>
                <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-white uppercase tracking-wider border-r-2 border-primary-700">
                    Fecha Registro
                </th>
                <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-white uppercase tracking-wider border-r-2 border-primary-700">
                    Estado Asistencia
                </th>
                <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-white uppercase tracking-wider">
                    Acciones
                </th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y-2 divide-gray-300">
            @forelse($attendances as $attendance)
            @php
                $user = $attendance->registration->user;
                $hasConfirmedAttendance = $attendance->attendance !== null;
            @endphp
            <tr class="hover:bg-gray-50 transition-colors duration-200 divide-x-2 divide-gray-300">
                <td class="px-6 py-4 whitespace-nowrap border-r-2 border-gray-300">
                    <div class="flex items-center">
                        @if($user->photo)
                        <div class="flex-shrink-0 h-10 w-10 mr-3">
                            <img class="h-10 w-10 rounded-full object-cover border-2 border-gray-200"
                                src="{{ $user->photo }}"
                                alt="{{ $user->first_name }}">
                        </div>
                        @else
                        <div class="flex-shrink-0 h-10 w-10 mr-3 rounded-full bg-primary-100 flex items-center justify-center">
                            <i class="fas fa-user text-primary-600"></i>
                        </div>
                        @endif
                        <div>
                            <div class="text-sm font-semibold text-gray-900">
                                {{ $user->first_name }} {{ $user->last_name }}
                            </div>
                            <div class="text-xs text-gray-500">
                                {{ $user->email }}
                            </div>
                        </div>
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap border-r-2 border-gray-300">
                    <div class="text-sm text-gray-900">
                        {{ $user->documentType->code ?? 'N/A' }}: {{ $user->document_number }}
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap border-r-2 border-gray-300">
                    @if($user->modality)
                    <div class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                        <i class="fas fa-desktop mr-1"></i>
                        {{ $user->modality->name }}
                    </div>
                    @else
                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                        <i class="fas fa-times mr-1"></i>
                        Sin asignar
                    </span>
                    @endif
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-center border-r-2 border-gray-300">
                    <div class="text-sm text-gray-900">
                        {{ $attendance->created_at->format('d/m/Y H:i') }}
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-center border-r-2 border-gray-300">
                    @if($hasConfirmedAttendance)
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                        <i class="fas fa-check-circle mr-1"></i>
                        Confirmada
                    </span>
                    @if($attendance->attendance->checked_in_at)
                    <div class="text-xs text-gray-500 mt-1">
                        Check-in: {{ $attendance->attendance->checked_in_at->format('H:i') }}
                    </div>
                    @endif
                    @else
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800">
                        <i class="fas fa-clock mr-1"></i>
                        Pendiente
                    </span>
                    @endif
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                    <div class="flex justify-center space-x-2">
                        @if(!$hasConfirmedAttendance)
                        <button onclick="confirmAttendance('{{ $attendance->uuid }}', '{{ $user->first_name }} {{ $user->last_name }}')"
                            class="text-green-600 hover:text-green-900 transition-colors bg-green-100 hover:bg-green-200 px-3 py-2 rounded-lg flex items-center"
                            title="Confirmar asistencia">
                            <i class="fas fa-user-check mr-1"></i>
                            Confirmar
                        </button>
                        @else
                        <span class="text-gray-400 bg-gray-100 px-3 py-2 rounded-lg cursor-not-allowed flex items-center">
                            <i class="fas fa-check-circle mr-1"></i>
                            Confirmada
                        </span>
                        @endif
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="px-6 py-8 text-center">
                    <div class="flex flex-col items-center justify-center">
                        <i class="fas fa-users text-gray-400 text-5xl mb-3"></i>
                        <p class="text-gray-500 text-lg font-semibold">No hay usuarios registrados</p>
                        <p class="text-gray-400 text-sm mt-1">No se encontraron usuarios con los criterios de búsqueda</p>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Paginación -->
@if($attendances->hasPages())
<div class="mt-6 flex flex-col sm:flex-row justify-between items-center gap-4">
    <div class="text-sm text-gray-700">
        Mostrando
        <span class="font-semibold">{{ $attendances->firstItem() ?? 0 }}</span>
        -
        <span class="font-semibold">{{ $attendances->lastItem() ?? 0 }}</span>
        de
        <span class="font-semibold">{{ $attendances->total() }}</span>
        resultado(s)
    </div>

    <div class="flex items-center space-x-1">
        <!-- Botón Primera Página -->
        @if ($attendances->currentPage() > 2)
            <button data-page="1"
                    class="pagination-link px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:text-primary-600 transition-colors"
                    title="Primera página">
                1
            </button>
            @if ($attendances->currentPage() > 3)
                <span class="px-2 py-2 text-sm text-gray-500">...</span>
            @endif
        @endif

        <!-- Páginas alrededor de la actual -->
        @php
            $currentPage = $attendances->currentPage();
            $lastPage = $attendances->lastPage();
            $startPage = max(1, $currentPage - 2);
            $endPage = min($lastPage, $currentPage + 2);
        @endphp

        @for ($page = $startPage; $page <= $endPage; $page++)
            @if ($page == $attendances->currentPage())
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
        @if ($attendances->currentPage() < $lastPage - 1)
            @if ($attendances->currentPage() < $lastPage - 2)
                <span class="px-2 py-2 text-sm text-gray-500">...</span>
            @endif
            <button data-page="{{ $lastPage }}"
                    class="pagination-link px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:text-primary-600 transition-colors"
                    title="Última página">
                {{ $lastPage }}
            </button>
        @endif

        <!-- Navegación Anterior/Siguiente -->
        @if ($attendances->onFirstPage())
            <span class="px-3 py-2 text-sm font-medium text-gray-400 bg-gray-100 border border-gray-300 rounded-lg cursor-not-allowed">
                <i class="fas fa-chevron-left"></i>
            </span>
        @else
            <button data-page="{{ $attendances->currentPage() - 1 }}"
                    class="pagination-link px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:text-primary-600 transition-colors"
                    title="Página anterior">
                <i class="fas fa-chevron-left"></i>
            </button>
        @endif

        @if ($attendances->hasMorePages())
            <button data-page="{{ $attendances->currentPage() + 1 }}"
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