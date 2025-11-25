<div class="overflow-x-auto rounded-lg border-2 border-gray-300">
    <table class="min-w-full divide-y-2 divide-gray-300 border-collapse">
        <thead class="bg-primary-600">
            <tr class="divide-x-2 divide-primary-700">
                <th scope="col"
                    class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider border-r-2 border-primary-700">
                    ID
                </th>
                <th scope="col"
                    class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider border-r-2 border-primary-700">
                    Nombre
                </th>
                <th scope="col"
                    class="px-6 py-4 text-center text-xs font-bold text-white uppercase tracking-wider border-r-2 border-primary-700">
                    Estado
                </th>
                <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-white uppercase tracking-wider">
                    Acciones
                </th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y-2 divide-gray-300">
            @forelse($modalities as $modality)
                <tr class="hover:bg-gray-50 transition-colors duration-200 divide-x-2 divide-gray-300">
                    <td class="px-6 py-4 whitespace-nowrap border-r-2 border-gray-300">
                        <div class="flex items-center">
                            <div
                                class="flex-shrink-0 h-10 w-10 bg-primary-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-hashtag text-primary-600 text-sm"></i>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-bold text-gray-900">
                                    #{{ $modality->id }}
                                </div>
                                <div class="text-xs text-gray-500">
                                    ID
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap border-r-2 border-gray-300">
                        <div class="text-sm font-semibold text-gray-900">
                            {{ $modality->name }}
                        </div>
                        <div class="text-xs text-gray-500">
                            Modalidad
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-center border-r-2 border-gray-300">
                        <button onclick="toggleModalityStatus('{{ $modality->id }}')"
                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold transition-colors cursor-pointer
                {{ $modality->is_active ? 'bg-green-100 text-green-800 hover:bg-green-200' : 'bg-red-100 text-red-800 hover:bg-red-200' }}"
                            title="Click para cambiar estado">
                            <i class="fas {{ $modality->is_active ? 'fa-check-circle' : 'fa-times-circle' }} mr-1"></i>
                            {{ $modality->is_active ? 'Activo' : 'Inactivo' }}
                        </button>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                        <div class="flex justify-center space-x-3">
                            <!-- Botón Editar -->
                            <button onclick="editModality('{{ $modality->id }}')"
                                class="text-blue-600 hover:text-blue-900 transition-colors" title="Editar modalidad">
                                <i class="fas fa-edit text-lg"></i>
                            </button>

                            <!-- Botón Eliminar -->
                            <button onclick="confirmDeleteModality('{{ $modality->id }}', '{{ $modality->name }}')"
                                class="text-red-600 hover:text-red-900 transition-colors" title="Eliminar modalidad">
                                <i class="fas fa-trash-alt text-lg"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-6 py-8 text-center">
                        <div class="flex flex-col items-center justify-center">
                            <i class="fas fa-layer-group text-gray-400 text-5xl mb-3"></i>
                            <p class="text-gray-500 text-lg font-semibold">No hay modalidades registradas</p>
                            <p class="text-gray-400 text-sm mt-1">Haz clic en "Agregar Modalidad" para comenzar</p>
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
        <span class="font-semibold">{{ $modalities->firstItem() ?? 0 }}</span>
        -
        <span class="font-semibold">{{ $modalities->lastItem() ?? 0 }}</span>
        de
        <span class="font-semibold">{{ $modalities->total() }}</span>
        resultado(s)
    </div>

    @if ($modalities->hasPages())
        <div class="flex items-center space-x-2">
            @if ($modalities->onFirstPage())
                <span
                    class="px-3 py-2 text-sm font-medium text-gray-400 bg-gray-100 border border-gray-300 rounded-lg cursor-not-allowed">
                    <i class="fas fa-chevron-left"></i>
                </span>
            @else
                <button data-page="{{ $modalities->currentPage() - 1 }}"
                    class="pagination-link px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:text-primary-600 transition-colors">
                    <i class="fas fa-chevron-left"></i>
                </button>
            @endif

            @foreach ($modalities->getUrlRange(1, $modalities->lastPage()) as $page => $url)
                @if ($page == $modalities->currentPage())
                    <span
                        class="px-3 py-2 text-sm font-medium text-white bg-primary-600 border border-primary-600 rounded-lg">
                        {{ $page }}
                    </span>
                @else
                    <button data-page="{{ $page }}"
                        class="pagination-link px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:text-primary-600 transition-colors">
                        {{ $page }}
                    </button>
                @endif
            @endforeach

            @if ($modalities->hasMorePages())
                <button data-page="{{ $modalities->currentPage() + 1 }}"
                    class="pagination-link px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:text-primary-600 transition-colors">
                    <i class="fas fa-chevron-right"></i>
                </button>
            @else
                <span
                    class="px-3 py-2 text-sm font-medium text-gray-400 bg-gray-100 border border-gray-300 rounded-lg cursor-not-allowed">
                    <i class="fas fa-chevron-right"></i>
                </span>
            @endif
        </div>
    @endif
</div>
