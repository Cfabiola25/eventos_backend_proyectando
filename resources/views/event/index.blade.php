@extends('layouts.app')

@section('title', 'Lista de Eventos')

@section('content')
    <div class="w-full px-4 py-6 mx-auto mt-16">
        <!-- Cards de estadísticas -->
        @include('event.components.cards', [
            'totalEvents' => $totalEvents,
            'activeEvents' => $activeEvents,
            'inactiveEvents' => $inactiveEvents,
            'virtualEvents' => $virtualEvents,
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

                        <!-- Botón Agregar -->
                        <a href="{{ route('events.create') }}"
                            class="bg-primary-600 hover:bg-primary-700 text-white font-bold py-2.5 px-6 rounded-lg shadow-lg transition duration-300 flex items-center justify-center whitespace-nowrap">
                            <i class="fas fa-plus mr-2"></i> Nuevo Evento
                        </a>
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
                    @include('event.components.table', ['events' => $events])
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

        <!-- Modal de Confirmación para Eliminar -->
        @include('event.components.deleteModal')

        <!-- Modal de Detalles del Evento -->
        @include('event.components.detailModal')
    </div>
@endsection

@push('scripts')
    <script>
        let searchTimeout = null;
        let currentSearch = '';
        let currentDeleteData = null;

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

            axios.get(`{{ route('events.search') }}`, {
                    params: {
                        search: searchValue,
                        page: page
                    }
                })
                .then(response => {
                    const data = response.data;
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
                    showNotification('Error al realizar la búsqueda', 'error');
                });
        }

        // Actualizar estadísticas de las cards
        function updateStatsCards(stats) {
            if (!stats || typeof stats !== 'object') {
                console.error('Stats no válido:', stats);
                return;
            }

            const totalCard = document.getElementById('totalEventsCount');
            if (totalCard) {
                const currentValue = parseInt(totalCard.textContent) || 0;
                const newValue = parseInt(stats.total) || 0;
                animateValue(totalCard, currentValue, newValue, 500);
            }

            const activeCard = document.getElementById('activeEventsCount');
            if (activeCard) {
                const currentValue = parseInt(activeCard.textContent) || 0;
                const newValue = parseInt(stats.active) || 0;
                animateValue(activeCard, currentValue, newValue, 500);
            }

            const inactiveCard = document.getElementById('inactiveEventsCount');
            if (inactiveCard) {
                const currentValue = parseInt(inactiveCard.textContent) || 0;
                const newValue = parseInt(stats.inactive) || 0;
                animateValue(inactiveCard, currentValue, newValue, 500);
            }

            const virtualCard = document.getElementById('virtualEventsCount');
            if (virtualCard) {
                const currentValue = parseInt(virtualCard.textContent) || 0;
                const newValue = parseInt(stats.virtual) || 0;
                animateValue(virtualCard, currentValue, newValue, 500);
            }
        }

        // Función para animar el cambio de números
        function animateValue(element, start, end, duration) {
            if (start === end) {
                element.textContent = end;
                return;
            }

            const range = end - start;
            const increment = range / (duration / 16);
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

        // Toggle Status de Evento con Axios
        function toggleStatus(uuid) {
            axios.post(`/events/${uuid}/toggle-status`)
                .then(response => {
                    const data = response.data;
                    if (data.success) {
                        showNotification(data.message, 'success');

                        // Actualizar estadísticas si vienen en la respuesta
                        if (data.stats && typeof data.stats === 'object') {
                            updateStatsCards(data.stats);
                        } else {
                            // Si no vienen stats, forzar recarga
                            performSearch(currentSearch);
                        }

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

        // Abrir modal de detalles del evento
        // Abrir modal de detalles del evento
        function showEventDetails(uuid) {
            console.log('Mostrando detalles del evento:', uuid);

            // Mostrar loading
            const modal = document.getElementById('detail-modal');
            const content = document.getElementById('detail-content');
            content.innerHTML = `
        <div class="flex justify-center items-center py-8">
            <i class="fas fa-spinner fa-spin text-2xl text-primary-600"></i>
            <span class="ml-2 text-gray-600">Cargando detalles del evento...</span>
        </div>
    `;
            modal.classList.remove('hidden');

            // Obtener datos del evento vía AJAX
            axios.get(`/events/${uuid}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => {
                    console.log('Respuesta del servidor:', response.data);
                    const data = response.data;
                    if (data.success) {
                        const event = data.event;
                        renderEventDetails(event);
                    } else {
                        content.innerHTML = `
                <div class="text-center py-8 text-red-600">
                    <i class="fas fa-exclamation-triangle text-3xl mb-2"></i>
                    <p>Error al cargar los detalles del evento</p>
                    <p class="text-sm text-gray-500 mt-1">${data.message || 'Evento no encontrado'}</p>
                </div>
            `;
                    }
                })
                .catch(error => {
                    console.error('Error en la petición:', error);
                    let errorMessage = 'Error de conexión';

                    if (error.response) {
                        // El servidor respondió con un código de error
                        if (error.response.status === 404) {
                            errorMessage = 'Evento no encontrado';
                        } else if (error.response.data && error.response.data.message) {
                            errorMessage = error.response.data.message;
                        }
                    }

                    content.innerHTML = `
            <div class="text-center py-8 text-red-600">
                <i class="fas fa-exclamation-triangle text-3xl mb-2"></i>
                <p>${errorMessage}</p>
                <p class="text-sm text-gray-500 mt-1">Intente nuevamente</p>
            </div>
        `;
                });
        }

        // Renderizar detalles del evento en el modal
        // Renderizar detalles del evento en el modal
        function renderEventDetails(event) {
            const content = document.getElementById('detail-content');

            // Funciones helper para manejar datos nulos
            const safeGet = (obj, prop, defaultValue = 'No disponible') => {
                return obj && obj[prop] ? obj[prop] : defaultValue;
            };

            const safeArray = (arr, mapper) => {
                return arr && arr.length > 0 ? arr.map(mapper).join('') :
                    `<span class="text-gray-400 text-sm">No disponible</span>`;
            };

            // Construir el HTML
            let categoriesHtml = safeArray(event.categories, cat =>
                `<span class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full mr-1 mb-1">${cat.name}</span>`
            );

            let tagsHtml = safeArray(event.tags, tag =>
                `<span class="inline-block bg-purple-100 text-purple-800 text-xs px-2 py-1 rounded-full mr-1 mb-1">${tag.name}</span>`
            );

            let speakersHtml = safeArray(event.speakers, speaker => `
        <div class="flex items-center mb-2">
            ${speaker.photo ? 
                `<img src="${speaker.photo}" alt="${speaker.name}" class="w-8 h-8 rounded-full mr-2 object-cover">` : 
                `<div class="w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center mr-2"><i class="fas fa-user text-gray-400"></i></div>`
            }
            <div>
                <p class="text-sm font-medium">${safeGet(speaker, 'name')}</p>
                ${speaker.profession ? `<p class="text-xs text-gray-500">${speaker.profession}</p>` : ''}
            </div>
        </div>
    `);

            let programsHtml = safeArray(event.programs, program =>
                `<div class="text-sm text-gray-700 mb-1">${program.name}</div>`
            );

            let themesHtml = safeArray(event.themes, theme =>
                `<div class="text-sm text-gray-700 mb-1">${theme.name}</div>`
            );

            content.innerHTML = `
        <div class="space-y-6">
            <!-- Header -->
            <div class="flex justify-between items-start">
                <div>
                    <h3 class="text-xl font-bold text-gray-800">${safeGet(event, 'title')}</h3>
                    <p class="text-sm text-gray-500">UUID: ${safeGet(event, 'uuid')}</p>
                </div>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium ${event.is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'}">
                    ${event.is_active ? 'Activo' : 'Inactivo'}
                </span>
            </div>

            <!-- Imagen -->
            ${event.image ? `
                <div>
                    <img src="${event.image}" alt="${safeGet(event, 'title')}" class="w-full h-48 object-cover rounded-lg shadow-md">
                </div>
                ` : ''}

            <!-- Información básica -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <h4 class="font-semibold text-gray-700 mb-2 flex items-center">
                        <i class="fas fa-info-circle text-primary-600 mr-2"></i>
                        Información General
                    </h4>
                    <div class="space-y-2 text-sm bg-gray-50 p-3 rounded-lg">
                        <p><strong>Modalidad:</strong> ${event.modality ? safeGet(event.modality, 'name') : 'No asignada'}</p>
                        <p><strong>Capacidad máxima:</strong> ${safeGet(event, 'max_capacity', 'No definida')}</p>
                        ${event.virtual_link ? `<p><strong>Enlace virtual:</strong> <a href="${event.virtual_link}" target="_blank" class="text-primary-600 hover:underline break-all">${event.virtual_link}</a></p>` : ''}
                        ${event.color ? `<p><strong>Color:</strong> <span class="inline-block w-4 h-4 rounded-full border border-gray-300" style="background-color: ${event.color}"></span> ${event.color}</p>` : ''}
                    </div>
                </div>
                
                <div>
                    <h4 class="font-semibold text-gray-700 mb-2 flex items-center">
                        <i class="fas fa-calendar text-primary-600 mr-2"></i>
                        Fechas
                    </h4>
                    <div class="space-y-2 text-sm bg-gray-50 p-3 rounded-lg">
                        <p><strong>Creado:</strong> ${new Date(event.created_at).toLocaleDateString('es-ES')}</p>
                        <p><strong>Actualizado:</strong> ${new Date(event.updated_at).toLocaleDateString('es-ES')}</p>
                    </div>
                </div>
            </div>

            <!-- Descripción -->
            ${event.description ? `
                <div>
                    <h4 class="font-semibold text-gray-700 mb-2 flex items-center">
                        <i class="fas fa-align-left text-primary-600 mr-2"></i>
                        Descripción
                    </h4>
                    <p class="text-sm text-gray-600 bg-gray-50 p-3 rounded-lg">${event.description}</p>
                </div>
                ` : ''}

            <!-- Categorías y Etiquetas -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <h4 class="font-semibold text-gray-700 mb-2 flex items-center">
                        <i class="fas fa-folder text-blue-600 mr-2"></i>
                        Categorías
                    </h4>
                    <div class="flex flex-wrap gap-1">
                        ${categoriesHtml}
                    </div>
                </div>
                <div>
                    <h4 class="font-semibold text-gray-700 mb-2 flex items-center">
                        <i class="fas fa-hashtag text-purple-600 mr-2"></i>
                        Etiquetas
                    </h4>
                    <div class="flex flex-wrap gap-1">
                        ${tagsHtml}
                    </div>
                </div>
            </div>

            <!-- Programas y Temas -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <h4 class="font-semibold text-gray-700 mb-2 flex items-center">
                        <i class="fas fa-graduation-cap text-green-600 mr-2"></i>
                        Programas
                    </h4>
                    <div class="space-y-1">
                        ${programsHtml}
                    </div>
                </div>
                <div>
                    <h4 class="font-semibold text-gray-700 mb-2 flex items-center">
                        <i class="fas fa-palette text-orange-600 mr-2"></i>
                        Temas
                    </h4>
                    <div class="space-y-1">
                        ${themesHtml}
                    </div>
                </div>
            </div>

            <!-- Expositores -->
            <div>
                <h4 class="font-semibold text-gray-700 mb-2 flex items-center">
                    <i class="fas fa-users text-red-600 mr-2"></i>
                    Expositores
                </h4>
                <div class="space-y-2 bg-gray-50 p-3 rounded-lg">
                    ${speakersHtml}
                </div>
            </div>
        </div>
    `;
        }

        // Cerrar modal de detalles
        function closeDetailModal() {
            document.getElementById('detail-modal').classList.add('hidden');
        }

        // Abrir modal de confirmación para eliminar
        function confirmDelete(uuid, title) {
            currentDeleteData = {
                uuid: uuid,
                title: title
            };

            document.getElementById('delete-event-title').textContent = title;

            const modal = document.getElementById('delete-modal');
            modal.classList.remove('hidden');
        }

        // Ejecutar eliminación después de confirmar con Axios
        function executeDelete() {
            if (!currentDeleteData) return;

            const {
                uuid
            } = currentDeleteData;

            axios.delete(`/events/${uuid}`)
                .then(response => {
                    const data = response.data;
                    if (data.success) {
                        showNotification(data.message, 'success');
                        closeDeleteModal();

                        // Actualizar la tabla después de eliminar
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

        // Cerrar modal de eliminación
        function closeDeleteModal() {
            const modal = document.getElementById('delete-modal');
            modal.classList.add('hidden');
            currentDeleteData = null;
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
    </script>
@endpush
