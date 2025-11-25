<div class="overflow-x-auto rounded-lg border-2 border-gray-300">
    <table class="min-w-full divide-y-2 divide-gray-300 border-collapse">
        <thead class="bg-primary-600">
            <tr class="divide-x-2 divide-primary-700">
                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider border-r-2 border-primary-700">
                    UUID
                </th>
                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider border-r-2 border-primary-700">
                    Nombre
                </th>
                <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-white uppercase tracking-wider border-r-2 border-primary-700">
                    Color
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
            @forelse($programs as $program)
            <tr class="hover:bg-gray-50 transition-colors duration-200 divide-x-2 divide-gray-300">
                <td class="px-6 py-4 whitespace-nowrap border-r-2 border-gray-300">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 h-10 w-10 bg-primary-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-hashtag text-primary-600 text-sm"></i>
                        </div>
                        <div class="ml-4">
                            <div class="text-sm font-bold text-gray-900">
                                {{ substr($program->uuid, 0, 8) }}...
                            </div>
                            <div class="text-xs text-gray-500">
                                UUID
                            </div>
                        </div>
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap border-r-2 border-gray-300">
                    <div class="text-sm font-semibold text-gray-900">
                        {{ $program->name }}
                    </div>
                    @if($program->description)
                    <div class="text-xs text-gray-500 truncate max-w-xs">
                        {{ $program->description }}
                    </div>
                    @endif
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-center border-r-2 border-gray-300">
                    <div class="flex items-center justify-center space-x-2">
                        <div class="w-6 h-6 rounded-full border border-gray-300" style="background-color: {{ $program->color }}"></div>
                        <span class="text-xs font-mono text-gray-600">{{ $program->color }}</span>
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-center border-r-2 border-gray-300">
                    <button onclick="toggleProgramStatus('{{ $program->uuid }}')"
                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold transition-colors cursor-pointer
                                {{ $program->is_active ? 'bg-green-100 text-green-800 hover:bg-green-200' : 'bg-red-100 text-red-800 hover:bg-red-200' }}"
                            title="Click para cambiar estado">
                        <i class="fas {{ $program->is_active ? 'fa-check-circle' : 'fa-times-circle' }} mr-1"></i>
                        {{ $program->is_active ? 'Activo' : 'Inactivo' }}
                    </button>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                    <div class="flex justify-center space-x-3">
                        <!-- Botón Editar -->
                        <button onclick="editProgram('{{ $program->uuid }}')"
                                class="text-blue-600 hover:text-blue-900 transition-colors"
                                title="Editar programa">
                            <i class="fas fa-edit text-lg"></i>
                        </button>

                        <!-- Botón Eliminar -->
                        <button onclick="confirmDeleteProgram('{{ $program->uuid }}', '{{ $program->name }}')"
                                class="text-red-600 hover:text-red-900 transition-colors"
                                title="Eliminar programa">
                            <i class="fas fa-trash-alt text-lg"></i>
                        </button>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="px-6 py-8 text-center">
                    <div class="flex flex-col items-center justify-center">
                        <i class="fas fa-list-alt text-gray-400 text-5xl mb-3"></i>
                        <p class="text-gray-500 text-lg font-semibold">No hay programas registrados</p>
                        <p class="text-gray-400 text-sm mt-1">Haz clic en "Agregar Programa" para comenzar</p>
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
        <span class="font-semibold">{{ $programs->firstItem() ?? 0 }}</span>
        -
        <span class="font-semibold">{{ $programs->lastItem() ?? 0 }}</span>
        de
        <span class="font-semibold">{{ $programs->total() }}</span>
        resultado(s)
    </div>

    @if($programs->hasPages())
    <div class="flex items-center space-x-2">
        @if ($programs->onFirstPage())
            <span class="px-3 py-2 text-sm font-medium text-gray-400 bg-gray-100 border border-gray-300 rounded-lg cursor-not-allowed">
                <i class="fas fa-chevron-left"></i>
            </span>
        @else
            <button data-page="{{ $programs->currentPage() - 1 }}"
                    class="pagination-link px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:text-primary-600 transition-colors">
                <i class="fas fa-chevron-left"></i>
            </button>
        @endif

        @foreach ($programs->getUrlRange(1, $programs->lastPage()) as $page => $url)
            @if ($page == $programs->currentPage())
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

        @if ($programs->hasMorePages())
            <button data-page="{{ $programs->currentPage() + 1 }}"
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