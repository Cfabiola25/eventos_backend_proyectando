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
                @if(Auth::user()->is_admin)
                <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-white uppercase tracking-wider border-r-2 border-primary-700">
                    Tipo / Rol
                </th>
                @endif
                <!-- NUEVA COLUMNA: Modalidad -->
                <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-white uppercase tracking-wider border-r-2 border-primary-700">
                    Modalidad
                </th>
                @if(Auth::user()->is_admin)
                <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-white uppercase tracking-wider border-r-2 border-primary-700">
                    Estado
                </th>
                <!-- NUEVAS COLUMNAS AGREGADAS -->
                <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-white uppercase tracking-wider border-r-2 border-primary-700">
                    Administrador
                </th>
                <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-white uppercase tracking-wider border-r-2 border-primary-700">
                    Invitado
                </th>
                @endif

                <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-white uppercase tracking-wider border-r-2 border-primary-700">
                    Refrigerio
                </th>
                <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-white uppercase tracking-wider border-r-2 border-primary-700">
                    Kit Confirmado
                </th>
                <!-- FIN NUEVAS COLUMNAS -->
                 @if(Auth::user()->is_admin)
                <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-white uppercase tracking-wider border-r-2 border-primary-700">
                    Diploma
                </th>
                 @endif
                <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-white uppercase tracking-wider">
                    Acciones
                </th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y-2 divide-gray-300">
            @forelse($users as $user)
            <tr class="hover:bg-gray-50 transition-colors duration-200 divide-x-2 divide-gray-300">
                <td class="px-6 py-4 whitespace-nowrap border-r-2 border-gray-300">
                    <div class="flex items-center">
                        @if($user->photo)
                        <div class="flex-shrink-0 h-12 w-12 mr-3">
                            <img class="h-12 w-12 rounded-full object-cover border-2 border-gray-200"
                                src="{{ $user->photo }}"
                                alt="{{ $user->first_name }} {{ $user->last_name }}">
                        </div>
                        @else
                        <div class="flex-shrink-0 h-12 w-12 mr-3 rounded-full bg-primary-100 flex items-center justify-center">
                            <i class="fas fa-user text-primary-600 text-xl"></i>
                        </div>
                        @endif
                        <div>
                            <div class="text-sm font-bold text-gray-900 cursor-help"
                                title="{{ $user->first_name }} {{ $user->last_name }}"
                                data-tooltip="true">
                                {{ Str::limit($user->first_name . ' ' . $user->last_name, 25) }}
                            </div>
                            <div class="text-xs text-gray-500">
                                <i class="fas fa-envelope mr-1"></i>{{ Str::limit($user->email, 30) }}
                            </div>
                            @if($user->phone)
                            <div class="text-xs text-gray-500">
                                <i class="fas fa-phone mr-1"></i>{{ $user->phone }}
                            </div>
                            @endif
                        </div>
                    </div>
                </td>
                <td class="px-6 py-4 border-r-2 border-gray-300">
                    @if($user->documentType)
                    <div class="text-sm text-gray-700">
                        <span class="font-semibold">{{ $user->documentType->code ?? 'N/A' }}:</span>
                        {{ $user->document_number }}
                    </div>
                    @else
                    <span class="text-xs text-gray-400">Sin documento</span>
                    @endif
                    @if($user->gender)
                    <div class="text-xs text-gray-500 mt-1">
                        <i class="fas fa-venus-mars mr-1"></i>{{ $user->gender->name }}
                    </div>
                    @endif
                </td>
                @if(Auth::user()->is_admin)
                <td class="px-6 py-4 whitespace-nowrap text-center border-r-2 border-gray-300">
                    @if($user->userType)
                    <div class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                        <i class="fas fa-user-tag mr-1"></i>
                        {{ $user->userType->type }}
                    </div>
                    @endif
                    @if($user->roles->isNotEmpty())
                    <div class="mt-1">
                        @foreach($user->roles as $role)
                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                            <i class="fas fa-shield-alt mr-1"></i>{{ $role->name }}
                        </span>
                        @endforeach
                    </div>
                    @endif
                </td>
                @endif
                <!-- NUEVA COLUMNA: Modalidad -->
                <td class="px-6 py-4 whitespace-nowrap text-center border-r-2 border-gray-300">
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

                @if(Auth::user()->is_admin)
                <td class="px-6 py-4 whitespace-nowrap text-center border-r-2 border-gray-300">
                    <button onclick="toggleStatus('{{ $user->uuid }}')"
                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold transition-colors cursor-pointer
                                {{ $user->status ? 'bg-green-100 text-green-800 hover:bg-green-200' : 'bg-red-100 text-red-800 hover:bg-red-200' }}"
                            title="Click para cambiar estado">
                        <i class="fas {{ $user->status ? 'fa-check-circle' : 'fa-times-circle' }} mr-1"></i>
                        {{ $user->status ? 'Activo' : 'Inactivo' }}
                    </button>
                </td>
                
                <!-- NUEVOS BOTONES PARA CAMPOS BOOLEANOS -->
                <td class="px-6 py-4 whitespace-nowrap text-center border-r-2 border-gray-300">
                    <button onclick="confirmToggle('{{ $user->uuid }}', 'is_admin', {{ $user->is_admin ? 'true' : 'false' }}, '{{ $user->first_name }} {{ $user->last_name }}')"
                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold transition-colors cursor-pointer
                                {{ $user->is_admin ? 'bg-purple-100 text-purple-800 hover:bg-purple-200' : 'bg-gray-100 text-gray-800 hover:bg-gray-200' }}"
                            title="Click para cambiar estado de administrador">
                        <i class="fas {{ $user->is_admin ? 'fa-user-shield' : 'fa-user' }} mr-1"></i>
                        {{ $user->is_admin ? 'Sí' : 'No' }}
                    </button>
                </td>

                <td class="px-6 py-4 whitespace-nowrap text-center border-r-2 border-gray-300">
                    <button onclick="confirmToggle('{{ $user->uuid }}', 'is_invited', {{ $user->is_invited ? 'true' : 'false' }}, '{{ $user->first_name }} {{ $user->last_name }}')"
                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold transition-colors cursor-pointer
                                {{ $user->is_invited ? 'bg-blue-100 text-blue-800 hover:bg-blue-200' : 'bg-gray-100 text-gray-800 hover:bg-gray-200' }}"
                            title="Click para cambiar estado de invitado">
                        <i class="fas {{ $user->is_invited ? 'fa-envelope-open' : 'fa-envelope' }} mr-1"></i>
                        {{ $user->is_invited ? 'Sí' : 'No' }}
                    </button>
                </td>
                @endif

                <td class="px-6 py-4 whitespace-nowrap text-center border-r-2 border-gray-300">
                    <button onclick="confirmToggle('{{ $user->uuid }}', 'is_paid', {{ $user->is_paid ? 'true' : 'false' }}, '{{ $user->first_name }} {{ $user->last_name }}')"
                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold transition-colors cursor-pointer
                                {{ $user->is_paid ? 'bg-green-100 text-green-800 hover:bg-green-200' : 'bg-red-100 text-red-800 hover:bg-red-200' }}"
                            title="Click para cambiar estado de pago">
                        <i class="fas {{ $user->is_paid ? 'fa-mug-hot' : 'fa-cookie-bite' }} mr-1"></i>
                        {{ $user->is_paid ? 'Sí' : 'No' }}
                    </button>
                </td>

                <td class="px-6 py-4 whitespace-nowrap text-center border-r-2 border-gray-300">
                    <button onclick="confirmToggle('{{ $user->uuid }}', 'kit_confirmed', {{ $user->kit_confirmed ? 'true' : 'false' }}, '{{ $user->first_name }} {{ $user->last_name }}')"
                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold transition-colors cursor-pointer
                                {{ $user->kit_confirmed ? 'bg-green-100 text-green-800 hover:bg-green-200' : 'bg-gray-100 text-gray-800 hover:bg-gray-200' }}"
                            title="Click para cambiar estado de kit">
                        <i class="fas {{ $user->kit_confirmed ? 'fa-box-open' : 'fa-box' }} mr-1"></i>
                        {{ $user->kit_confirmed ? 'Sí' : 'No' }}
                    </button>
                </td>
                
                {{-- En la tabla, línea del botón de diploma --}}
                @if(Auth::user()->is_admin)
                <td class="px-6 py-4 whitespace-nowrap text-center border-r-2 border-gray-300">
                    <button onclick="toggleDiploma('{{ $user->uuid }}', {{ $user->is_downloaded ? 'true' : 'false' }}, '{{ $user->first_name }} {{ $user->last_name }}')"
                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold transition-colors cursor-pointer
                                {{ $user->is_downloaded ? 'bg-purple-100 text-purple-800 hover:bg-purple-200' : 'bg-gray-100 text-gray-800 hover:bg-gray-200' }}"
                            title="{{ Auth::user()->is_admin ? 'Click para marcar/desmarcar diploma (Modo Admin)' : 'Click para marcar/desmarcar descarga' }}">
                        <i class="fas {{ $user->is_downloaded ? 'fa-certificate' : 'fa-file-download' }} mr-1"></i>
                        {{ $user->is_downloaded ? 'Descargado' : 'Pendiente' }}
                        @if(Auth::user()->is_admin)
                        <i class="fas fa-user-shield ml-1 text-xs text-purple-500" title="Modo Administrador"></i>
                        @endif
                    </button>
                </td>
                @endif

                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                  
                    <div class="flex justify-center space-x-3">
                        @if(Auth::user()->is_admin)
                        <!-- Botón Ver/Editar -->
                        <a href="{{ route('users.edit', $user->uuid) }}"
                            class="text-blue-600 hover:text-blue-900 transition-colors"
                            title="Editar usuario">
                            <i class="fas fa-edit text-lg"></i>
                        </a>

                        <!-- Botón Cambiar Contraseña -->
                        <button onclick="openPasswordModal('{{ $user->uuid }}', '{{ $user->first_name }} {{ $user->last_name }}')"
                                class="text-yellow-600 hover:text-yellow-900 transition-colors"
                                title="Cambiar contraseña">
                            <i class="fas fa-key text-lg"></i>
                        </button>

                        <!-- Botón Eliminar -->
                        <button onclick="confirmDelete('{{ $user->uuid }}', '{{ $user->first_name }} {{ $user->last_name }}')"
                                class="text-red-600 hover:text-red-900 transition-colors"
                                title="Eliminar usuario">
                            <i class="fas fa-trash-alt text-lg"></i>
                        </button>
                        @endif

                        <!-- Botón Generar Código QR -->
                        <a href="{{ route('qr.index', $user->uuid) }}" target="_blank"
                            class="bg-red-500 text-white p-1 rounded-full hover:bg-red-600 active:bg-red-700 shadow-md hover:shadow-lg transition-all duration-200 transform hover:scale-105 active:scale-95 border-0 w-8 h-8 flex items-center justify-center cursor-pointer"
                            title="Generar código QR">
                            <i class="fas fa-qrcode text-sm"></i>
                        </a>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="11" class="px-6 py-8 text-center"> <!-- Cambiado de 10 a 11 por la nueva columna -->
                    <div class="flex flex-col items-center justify-center">
                        <i class="fas fa-users text-gray-400 text-5xl mb-3"></i>
                        <p class="text-gray-500 text-lg font-semibold">No hay usuarios registrados</p>
                        <p class="text-gray-400 text-sm mt-1">Haz clic en "Agregar Usuario" para comenzar</p>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- Modales de Confirmación --}}
@include('user.components.confirmToggleModal')

{{-- Modal de confirmacion de descarga de diploma en modo admin --}}
@include('user.components.confirmAdminDiplomaModal')

<!-- Paginación Mejorada -->
<div class="mt-6 flex flex-col sm:flex-row justify-between items-center gap-4">
    <div class="text-sm text-gray-700">
        Mostrando
        <span class="font-semibold">{{ $users->firstItem() ?? 0 }}</span>
        -
        <span class="font-semibold">{{ $users->lastItem() ?? 0 }}</span>
        de
        <span class="font-semibold">{{ $users->total() }}</span>
        resultado(s)
    </div>

    @if($users->hasPages())
    <div class="flex items-center space-x-1">
        <!-- Botón Primera Página -->
        @if ($users->currentPage() > 2)
            <button data-page="1"
                    class="pagination-link px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:text-primary-600 transition-colors"
                    title="Primera página">
                1
            </button>
            @if ($users->currentPage() > 3)
                <span class="px-2 py-2 text-sm text-gray-500">...</span>
            @endif
        @endif

        <!-- Páginas alrededor de la actual -->
        @php
            $currentPage = $users->currentPage();
            $lastPage = $users->lastPage();
            $startPage = max(1, $currentPage - 2);
            $endPage = min($lastPage, $currentPage + 2);
        @endphp

        @for ($page = $startPage; $page <= $endPage; $page++)
            @if ($page == $users->currentPage())
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
        @if ($users->currentPage() < $lastPage - 1)
            @if ($users->currentPage() < $lastPage - 2)
                <span class="px-2 py-2 text-sm text-gray-500">...</span>
            @endif
            <button data-page="{{ $lastPage }}"
                    class="pagination-link px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:text-primary-600 transition-colors"
                    title="Última página">
                {{ $lastPage }}
            </button>
        @endif

        <!-- Navegación Anterior/Siguiente -->
        @if ($users->onFirstPage())
            <span class="px-3 py-2 text-sm font-medium text-gray-400 bg-gray-100 border border-gray-300 rounded-lg cursor-not-allowed">
                <i class="fas fa-chevron-left"></i>
            </span>
        @else
            <button data-page="{{ $users->currentPage() - 1 }}"
                    class="pagination-link px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:text-primary-600 transition-colors"
                    title="Página anterior">
                <i class="fas fa-chevron-left"></i>
            </button>
        @endif

        @if ($users->hasMorePages())
            <button data-page="{{ $users->currentPage() + 1 }}"
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