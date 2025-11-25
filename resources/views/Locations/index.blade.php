@extends('layouts.app')

@section('content')
<div @class(['w-full', 'px-4', 'py-6', 'mx-auto', 'mt-16'])>
    <!-- Cards de estadísticas -->
    @include('Locations.components.cards', [
        'totalLocations' => $totalLocations,
        'activeLocations' => $activeLocations,
        'inactiveLocations' => $inactiveLocations
    ])

    <!-- Contenedor principal con tabla -->
    <div @class(['w-full', 'mt-6', 'bg-white', 'rounded-lg', 'shadow-lg', 'overflow-hidden'])>
        <div @class(['p-6'])>
            <div @class(['flex', 'flex-col', 'sm:flex-row', 'justify-between', 'items-start', 'sm:items-center', 'mb-6', 'gap-4'])>
                <h2 @class(['text-2xl', 'font-bold', 'text-gray-800'])>
                    <i @class(['fas', 'fa-map-marker-alt', 'text-primary-600', 'mr-2'])></i>
                    Lista de Ubicaciones
                </h2>

                <div @class(['flex', 'flex-col', 'sm:flex-row', 'gap-3', 'w-full', 'sm:w-auto'])>
                    <!-- Buscador -->
                    <div @class(['relative', 'flex-1', 'sm:flex-initial', 'sm:w-80'])>
                        <div @class(['relative'])>
                            <input type="text"
                                   name="search"
                                   id="searchInput"
                                   placeholder="Buscar por nombre, ciudad, dirección..."
                                   @class(['w-full', 'pl-10', 'pr-10', 'py-2.5', 'border', 'border-gray-300', 'rounded-lg', 'focus:ring-2', 'focus:ring-primary-500', 'focus:border-transparent', 'transition-all'])>
                            <div @class(['absolute', 'inset-y-0', 'left-0', 'pl-3', 'flex', 'items-center', 'pointer-events-none'])>
                                <i @class(['fas', 'fa-search', 'text-gray-400'])></i>
                            </div>
                            <button type="button"
                                    id="clearSearchBtn"
                                    onclick="clearSearch()"
                                    @class(['hidden', 'absolute', 'inset-y-0', 'right-0', 'pr-3', 'flex', 'items-center', 'text-gray-400', 'hover:text-gray-600'])>
                                <i @class(['fas', 'fa-times'])></i>
                            </button>
                        </div>
                    </div>

                    <!-- Botón Agregar -->
                    <a href="{{ route('locations.create') }}"
                       @class(['bg-primary-600', 'hover:bg-primary-700', 'text-white', 'font-bold', 'py-2.5', 'px-6', 'rounded-lg', 'shadow-lg', 'transition', 'duration-300', 'flex', 'items-center', 'justify-center', 'whitespace-nowrap'])>
                        <i @class(['fas', 'fa-plus', 'mr-2'])></i> Agregar Ubicación
                    </a>
                </div>
            </div>

            <!-- Indicador de búsqueda activa -->
            <div id="searchIndicator" @class(['hidden', 'mb-4', 'p-3', 'bg-blue-50', 'border-l-4', 'border-blue-500', 'rounded', 'flex', 'items-center', 'justify-between'])>
                <div @class(['flex', 'items-center'])>
                    <i @class(['fas', 'fa-filter', 'text-blue-500', 'mr-2'])></i>
                    <span @class(['text-sm', 'text-blue-700'])>
                        Filtrando por: <strong id="searchTerm"></strong>
                    </span>
                </div>
                <button onclick="clearSearch()"
                        @class(['text-blue-600', 'hover:text-blue-800', 'text-sm', 'font-semibold'])>
                    Limpiar filtro
                </button>
            </div>

            <!-- Tabla -->
            <div id="tableContainer">
                @include('Locations.components.table', ['locations' => $locations])
            </div>
        </div>
    </div>

    <!-- Notificaciones -->
    <div id="notification" @class(['hidden', 'fixed', 'top-20', 'right-4', 'z-50', 'bg-white', 'border-l-4', 'border-green-500', 'rounded-lg', 'shadow-xl', 'p-4', 'max-w-md', 'transform', 'transition-all', 'duration-300'])>
        <div @class(['flex', 'items-center'])>
            <div @class(['flex-shrink-0'])>
                <i id="notificationIcon" @class(['fas', 'fa-check-circle', 'text-green-500', 'text-2xl'])></i>
            </div>
            <div @class(['ml-3'])>
                <p id="notificationMessage" @class(['text-sm', 'font-medium', 'text-gray-900'])></p>
            </div>
            <button onclick="closeNotification()" @class(['ml-auto', '-mx-1.5', '-my-1.5', 'text-gray-400', 'hover:text-gray-900', 'rounded-lg', 'p-1.5', 'inline-flex', 'h-8', 'w-8'])>
                <i @class(['fas', 'fa-times'])></i>
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
    @if(session('success'))
        showNotification('{{ session('success') }}', 'success');
    @endif

    @if(session('error'))
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

    // Función para realizar la búsqueda
    function performSearch(searchValue, page = 1) {
        currentSearch = searchValue;
        updateSearchIndicator(searchValue);

        fetch(`/locations/search?search=${encodeURIComponent(searchValue)}&page=${page}`, {
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('tableContainer').innerHTML = data.html;
                initializePaginationEvents();

                // Actualizar estadísticas de las cards
                if (data.stats) {
                    updateStatsCards(data.stats);
                }
            }
        })
        .catch(error => {
            console.error('Error en la búsqueda:', error);
        });
    }

    // Actualizar estadísticas de las cards
    function updateStatsCards(stats) {
        console.log('Actualizando stats:', stats);

        // Actualizar card de total con animación
        const totalCard = document.getElementById('totalLocationsCount');
        if (totalCard) {
            const currentValue = parseInt(totalCard.textContent) || 0;
            animateValue(totalCard, currentValue, stats.total, 500);
        }

        // Actualizar card de activos con animación
        const activeCard = document.getElementById('activeLocationsCount');
        if (activeCard) {
            const currentValue = parseInt(activeCard.textContent) || 0;
            animateValue(activeCard, currentValue, stats.active, 500);
        }

        // Actualizar card de inactivos con animación
        const inactiveCard = document.getElementById('inactiveLocationsCount');
        if (inactiveCard) {
            const currentValue = parseInt(inactiveCard.textContent) || 0;
            animateValue(inactiveCard, currentValue, stats.inactive, 500);
        }
    }

    // Función para animar el cambio de números
    function animateValue(element, start, end, duration) {
        if (start === end) {
            element.textContent = end;
            return;
        }

        const range = end - start;
        const increment = range / (duration / 16); // 60fps
        let current = start;
        const isIncreasing = increment > 0;

        const timer = setInterval(() => {
            current += increment;

            if ((isIncreasing && current >= end) || (!isIncreasing && current <= end)) {
                element.textContent = end;
                clearInterval(timer);
            } else {
                element.textContent = Math.round(current);
            }
        }, 16);
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

    // Eliminar ubicación
    function deleteLocation(uuid) {
        if (!confirm('¿Está seguro de eliminar esta ubicación?')) {
            return;
        }

        fetch(`/locations/${uuid}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showNotification(data.message, 'success');
                setTimeout(() => {
                    performSearch(currentSearch);
                }, 1500);
            } else {
                showNotification(data.message || 'Error al eliminar', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showNotification('Error al eliminar', 'error');
        });
    }

    // Toggle estado
    function toggleStatus(uuid) {
        fetch(`/locations/${uuid}/toggle-status`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            console.log('Toggle response:', data); // Debug

            if (data.success) {
                showNotification(data.message, 'success');

                // Actualizar estadísticas en tiempo real
                if (data.stats) {
                    updateStatsCards(data.stats);
                }

                // Recargar búsqueda para actualizar la tabla
                performSearch(currentSearch);
            } else {
                showNotification(data.message || 'Error al cambiar el estado', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showNotification('Error al cambiar el estado', 'error');
        });
    }

    // Mostrar notificación
    function showNotification(message, type) {
        const notification = document.getElementById('notification');
        const icon = document.getElementById('notificationIcon');
        const messageEl = document.getElementById('notificationMessage');

        messageEl.textContent = message;

        notification.classList.remove('border-green-500', 'border-red-500', 'hidden');
        icon.classList.remove('fa-check-circle', 'fa-exclamation-circle', 'text-green-500', 'text-red-500');

        if (type === 'success') {
            notification.classList.add('border-green-500');
            icon.classList.add('fa-check-circle', 'text-green-500');
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

    // Inicializar eventos de paginación al cargar
    document.addEventListener('DOMContentLoaded', function() {
        initializePaginationEvents();
    });
</script>
@endpush