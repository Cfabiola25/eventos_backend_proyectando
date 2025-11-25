@extends('layouts.app')

@section('title', 'Gestión de Eventos y Asistencias')

@section('content')
<div class="w-full px-4 py-6 mx-auto mt-16">
    <!-- Cards de estadísticas -->
    @include('eventAttendance.components.cards', [
        'totalEvents' => $totalEvents,
        'activeEvents' => $activeEvents,
        'inactiveEvents' => $inactiveEvents,
        'eventsWithAttendance' => $eventsWithAttendance,
    ])

    <!-- Contenedor principal con tabla -->
    <div class="w-full mt-6 bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="p-6">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                <h2 class="text-2xl font-bold text-gray-800">
                    <i class="fas fa-calendar-alt text-primary-600 mr-2"></i>
                    Lista de Eventos
                </h2>

                <div class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
                    <!-- Buscador -->
                    <div class="relative flex-1 sm:flex-initial sm:w-80">
                        <div class="relative">
                            <input type="text" name="search" id="searchInput"
                                placeholder="Buscar por título, descripción..."
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

            <!-- Tabla -->
            <div id="tableContainer">
                @include('eventAttendance.components.table', ['events' => $events])
            </div>
        </div>
    </div>

    <!-- Modal de Detalles del Evento -->
    @include('eventAttendance.components.event-details-modal')

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
</div>
@endsection

@push('scripts')
<script>
    let searchTimeout = null;
    let currentSearch = '';

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

        axios.post('{{ route("event-attendances.search-events") }}', {
                search: searchValue,
                page: page
            })
            .then(response => {
                const data = response.data;
                if (data.success) {
                    document.getElementById('tableContainer').innerHTML = data.html;
                    initializePaginationEvents();
                }
            })
            .catch(error => {
                console.error('Error en la búsqueda:', error);
                showNotification('Error al realizar la búsqueda', 'error');
            });
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

    // Mostrar detalles del evento en modal
    function showEventDetails(eventUuid) {
        axios.get(`/event-attendances/${eventUuid}/details`)
            .then(response => {
                const data = response.data;
                if (data.success) {
                    const event = data.event;
                    
                    // Llenar el modal con los datos del evento
                    document.getElementById('modalEventTitle').textContent = event.title;
                    document.getElementById('modalEventDescription').textContent = event.description || 'Sin descripción';
                    document.getElementById('modalEventModality').textContent = event.modality?.name || 'No asignada';
                    document.getElementById('modalEventCapacity').textContent = event.max_capacity || 'Ilimitada';
                    document.getElementById('modalEventStatus').textContent = event.is_active ? 'Activo' : 'Inactivo';
                    document.getElementById('modalEventStatus').className = event.is_active ? 
                        'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800' :
                        'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800';

                    // Mostrar imagen si existe
                    const eventImage = document.getElementById('modalEventImage');
                    if (event.image) {
                        eventImage.src = event.image;
                        eventImage.classList.remove('hidden');
                    } else {
                        eventImage.classList.add('hidden');
                    }

                    // Mostrar modal
                    document.getElementById('eventDetailsModal').classList.remove('hidden');
                }
            })
            .catch(error => {
                console.error('Error al obtener detalles:', error);
                showNotification('Error al cargar detalles del evento', 'error');
            });
    }

    // Cerrar modal de detalles
    function closeEventDetailsModal() {
        document.getElementById('eventDetailsModal').classList.add('hidden');
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
    });
</script>
@endpush