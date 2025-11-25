@extends('layouts.app')

@section('title', 'Asistencias del Evento: ' . $event->title)

@section('content')
<div class="w-full px-4 py-6 mx-auto mt-4 bg-white rounded-lg shadow-lg">
    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center">
            <a href="{{ route('event-attendances.index') }}" class="mr-4 text-gray-600 hover:text-primary-600 transition-colors">
                <i class="fas fa-arrow-left text-2xl"></i>
            </a>
            <div>
                <h1 class="text-3xl font-bold text-gray-800">
                    <i class="fas fa-users text-primary-600 mr-2"></i>
                    Asistencias del Evento
                </h1>
                <p class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-green-800 mt-1">{{ $event->title }}</p><br>
                @if($event->modality)
                <div class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800 mt-1">
                    <i class="fas fa-desktop mr-1"></i>
                    {{ $event->modality->name }}
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Cards de estadísticas del evento -->
<div class="flex flex-wrap gap-4 mb-6">
    <div class="flex-1 min-w-[200px] bg-white rounded-lg shadow p-6 text-center transition-all duration-300 border-2 border-transparent hover:border-red-600 hover:-translate-y-1 hover:shadow-lg">
        <div class="flex justify-center mb-2">
            <i class="fas fa-user-check text-primary-600 text-4xl"></i>
        </div>
        <p class="text-sm text-gray-500 font-semibold">Total Registrados</p>
        <p id="totalAttendancesCount" class="text-3xl font-bold text-primary-600">{{ $totalAttendances }}</p>
    </div>

    <div class="flex-1 min-w-[200px] bg-white rounded-lg shadow p-6 text-center transition-all duration-300 border-2 border-transparent hover:border-red-600 hover:-translate-y-1 hover:shadow-lg">
        <div class="flex justify-center mb-2">
            <i class="fas fa-check-circle text-green-600 text-4xl"></i>
        </div>
        <p class="text-sm text-gray-500 font-semibold">Asistencias Confirmadas</p>
        <p id="confirmedAttendancesCount" class="text-3xl font-bold text-green-600">{{ $confirmedAttendances }}</p>
    </div>

    <div class="flex-1 min-w-[200px] bg-white rounded-lg shadow p-6 text-center transition-all duration-300 border-2 border-transparent hover:border-red-600 hover:-translate-y-1 hover:shadow-lg">
        <div class="flex justify-center mb-2">
            <i class="fas fa-sign-in-alt text-blue-600 text-4xl"></i>
        </div>
        <p class="text-sm text-gray-500 font-semibold">Check-In Realizados</p>
        <p id="checkedInCount" class="text-3xl font-bold text-blue-600">{{ $checkedInAttendances }}</p>
    </div>

    <div class="flex-1 min-w-[200px] bg-white rounded-lg shadow p-6 text-center transition-all duration-300 border-2 border-transparent hover:border-red-600 hover:-translate-y-1 hover:shadow-lg">
        <div class="flex justify-center mb-2">
            <i class="fas fa-toggle-on text-purple-600 text-4xl"></i>
        </div>
        <p class="text-sm text-gray-500 font-semibold">Asistencias Activas</p>
        <p id="activeAttendancesCount" class="text-3xl font-bold text-purple-600">{{ $activeAttendances }}</p>
    </div>
</div>

    <!-- Contenedor principal con tabla de asistencias -->
    <div class="w-full mt-6 bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="p-6">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                <h2 class="text-2xl font-bold text-gray-800">
                    <i class="fas fa-list text-primary-600 mr-2"></i>
                    Lista de Usuarios Registrados
                </h2>

                <div class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
                    <!-- Buscador -->
                    <div class="relative flex-1 sm:flex-initial sm:w-80">
                        <div class="relative">
                            <input type="text" name="search" id="searchInput"
                                placeholder="Buscar por nombre, email, documento..."
                                class="w-full pl-10 pr-10 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-search text-gray-400"></i>
                            </div>
                            <button type="button" id="clearSearchBtn" onclick="clearSearch()"
                                class="hidden absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Indicador de búsqueda activa -->
            <div id="searchIndicator"
                class="hidden mb-4 p-3 bg-blue-50 border-l-4 border-blue-500 rounded flex items-center justify-between">
                <div class="flex items-center">
                    <i class="fas fa-filter text-blue-500 mr-2"></i>
                    <span class="text-sm text-blue-700">
                        Filtrando por: <strong id="searchTerm"></strong>
                    </span>
                </div>
                <button onclick="clearSearch()" class="text-blue-600 hover:text-blue-800 text-sm font-semibold">
                    Limpiar filtro
                </button>
            </div>

            <!-- Tabla de asistencias -->
            <div id="tableContainer">
                @include('eventAttendance.components.attendance-table', [
                    'attendances' => $attendances,
                    'event' => $event,
                ])
            </div>
        </div>
    </div>

    <!-- Notificaciones -->
    <div id="notification"
        class="hidden fixed top-20 right-4 z-50 bg-white border-l-4 border-green-500 rounded-lg shadow-xl p-4 max-w-md transform transition-all duration-300">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <i id="notificationIcon" class="fas fa-check-circle text-green-500 text-2xl"></i>
            </div>
            <div class="ml-3">
                <p id="notificationMessage" class="text-sm font-medium text-gray-900"></p>
            </div>
            <button onclick="closeNotification()"
                class="ml-auto -mx-1.5 -my-1.5 text-gray-400 hover:text-gray-900 rounded-lg p-1.5 inline-flex h-8 w-8">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>

    <!-- Modal de Confirmación -->
    <div id="confirm-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-md mx-4">
            <!-- Cabecera del modal -->
            <div class="bg-primary-600 text-white p-4 rounded-t-lg flex justify-between items-center">
                <h3 class="text-lg font-semibold flex items-center">
                    <i class="fas fa-exclamation-triangle mr-2"></i>
                    Confirmar Asistencia
                </h3>
                <button onclick="closeConfirmModal()"
                        class="text-white hover:text-gray-200 rounded-full w-8 h-8 flex items-center justify-center transition-colors">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            <!-- Cuerpo del modal -->
            <div class="p-6">
                <div class="flex items-center mb-4">
                    <div class="flex-shrink-0">
                        <i id="confirm-icon" class="fas fa-question-circle text-yellow-500 text-3xl"></i>
                    </div>
                    <div class="ml-4">
                        <p id="confirm-message" class="text-gray-700 font-medium"></p>
                        <p class="text-sm text-gray-600 mt-1">
                            Usuario: <span id="confirm-user-name" class="font-semibold"></span>
                        </p>
                    </div>
                </div>

                <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="fas fa-info-circle text-yellow-400"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-yellow-700">
                                Esta acción confirmará la asistencia del usuario y registrará la hora de check-in.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Botones -->
                <div class="flex justify-end space-x-3">
                    <button type="button"
                            onclick="closeConfirmModal()"
                            class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition-colors">
                        <i class="fas fa-times mr-2"></i>
                        Cancelar
                    </button>
                    <button type="button"
                            onclick="executeUpdate()"
                            class="px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition-colors flex items-center">
                        <i class="fas fa-user-check mr-2"></i>
                        Confirmar Asistencia
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    let searchTimeout = null;
    let currentSearch = '';
    const eventUuid = '{{ $event->uuid }}';
    
    // Variables para la confirmación
    let pendingConfirmation = {
        registrationEventUuid: null,
        userName: null
    };

    // Mostrar notificaciones de sesión
    @if (session('success'))
        showNotification('{{ session('success') }}', 'success');
    @endif

    @if (session('error'))
        showNotification('{{ session('error') }}', 'error');
    @endif

    // Búsqueda en tiempo real con AJAX
    document.getElementById('searchInput').addEventListener('input', function(e) {
        clearTimeout(searchTimeout);
        const searchValue = e.target.value;

        searchTimeout = setTimeout(() => {
            performSearch(searchValue);
        }, 300);
    });

    // Función para realizar la búsqueda con Axios
    function performSearch(searchValue, page = 1) {
        currentSearch = searchValue;
        updateSearchIndicator(searchValue);

        axios.post(`/event-attendances/${eventUuid}/search-attendances`, {
                search: searchValue,
                page: page
            })
            .then(response => {
                const data = response.data;
                if (data.success) {
                    document.getElementById('tableContainer').innerHTML = data.html;
                    initializePaginationEvents();
                    
                    // Actualizar estadísticas si están disponibles en la respuesta
                    if (data.stats) {
                        updateStatsCards(data.stats);
                    }
                }
            })
            .catch(error => {
                console.error('Error en la búsqueda:', error);
                showNotification('Error al realizar la búsqueda', 'error');
            });
    }

    // Actualizar estadísticas de las cards
    function updateStatsCards(stats) {
        const totalCard = document.getElementById('totalAttendancesCount');
        if (totalCard && stats.total !== undefined) {
            totalCard.textContent = stats.total;
        }

        const confirmedCard = document.getElementById('confirmedAttendancesCount');
        if (confirmedCard && stats.confirmed !== undefined) {
            confirmedCard.textContent = stats.confirmed;
        }

        const checkedInCard = document.getElementById('checkedInCount');
        if (checkedInCard && stats.checked_in !== undefined) {
            checkedInCard.textContent = stats.checked_in;
        }

        const activeCard = document.getElementById('activeAttendancesCount');
        if (activeCard && stats.active !== undefined) {
            activeCard.textContent = stats.active;
        }
    }

    // Actualizar indicador de búsqueda
    function updateSearchIndicator(searchValue) {
        const indicator = document.getElementById('searchIndicator');
        const clearBtn = document.getElementById('clearSearchBtn');

        if (searchValue && searchValue.trim() !== '') {
            indicator.classList.remove('hidden');
            document.getElementById('searchTerm').textContent = searchValue;
            clearBtn.classList.remove('hidden');
        } else {
            indicator.classList.add('hidden');
            clearBtn.classList.add('hidden');
        }
    }

    // Inicializar eventos de paginación
    function initializePaginationEvents() {
        document.querySelectorAll('.pagination-link').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const page = this.dataset.page;
                performSearch(currentSearch, page);
            });
        });
    }

    // Limpiar búsqueda
    function clearSearch() {
        document.getElementById('searchInput').value = '';
        currentSearch = '';
        performSearch('');
    }

    // Mostrar modal de confirmación para asistencia
    function confirmAttendance(registrationEventUuid, userName) {
        // Guardar datos para la confirmación
        pendingConfirmation.registrationEventUuid = registrationEventUuid;
        pendingConfirmation.userName = userName;
        
        // Configurar y mostrar el modal
        document.getElementById('confirm-message').textContent = '¿Está seguro que desea confirmar la asistencia de este usuario?';
        document.getElementById('confirm-user-name').textContent = userName;
        document.getElementById('confirm-icon').className = 'fas fa-user-check text-yellow-500 text-3xl';
        
        // Mostrar modal
        document.getElementById('confirm-modal').classList.remove('hidden');
    }

    // Ejecutar la confirmación de asistencia
    function executeUpdate() {
        if (!pendingConfirmation.registrationEventUuid) {
            closeConfirmModal();
            return;
        }

        axios.post(`/event-attendances/${pendingConfirmation.registrationEventUuid}/confirm-attendance`)
            .then(response => {
                const data = response.data;
                if (data.success) {
                    showNotification(data.message, 'success');
                    performSearch(currentSearch);
                } else {
                    showNotification(data.message || 'Error al confirmar', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                if (error.response && error.response.data && error.response.data.message) {
                    showNotification(error.response.data.message, 'error');
                } else {
                    showNotification('Error al confirmar la asistencia', 'error');
                }
            })
            .finally(() => {
                closeConfirmModal();
                // Limpiar datos pendientes
                pendingConfirmation.registrationEventUuid = null;
                pendingConfirmation.userName = null;
            });
    }

    // Cerrar modal de confirmación
    function closeConfirmModal() {
        document.getElementById('confirm-modal').classList.add('hidden');
        // Limpiar datos pendientes
        pendingConfirmation.registrationEventUuid = null;
        pendingConfirmation.userName = null;
    }

    // Mostrar notificación
    function showNotification(message, type) {
        const notification = document.getElementById('notification');
        const icon = document.getElementById('notificationIcon');
        const messageEl = document.getElementById('notificationMessage');

        messageEl.textContent = message;

        notification.classList.remove('border-green-500', 'border-red-500', 'border-blue-500', 'hidden');
        icon.classList.remove('fa-check-circle', 'fa-exclamation-circle', 'fa-info-circle', 'text-green-500',
            'text-red-500', 'text-blue-500');

        if (type === 'success') {
            notification.classList.add('border-green-500');
            icon.classList.add('fa-check-circle', 'text-green-500');
        } else if (type === 'info') {
            notification.classList.add('border-blue-500');
            icon.classList.add('fa-info-circle', 'text-blue-500');
        } else {
            notification.classList.add('border-red-500');
            icon.classList.add('fa-exclamation-circle', 'text-red-500');
        }

        notification.classList.remove('hidden');

        setTimeout(() => {
            closeNotification();
        }, 5000);
    }

    // Cerrar notificación
    function closeNotification() {
        document.getElementById('notification').classList.add('hidden');
    }

    // Inicializar eventos al cargar
    document.addEventListener('DOMContentLoaded', function() {
        initializePaginationEvents();
        
        // Configurar evento para cerrar modal con ESC
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeConfirmModal();
            }
        });
    });
</script>
@endpush