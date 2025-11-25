@extends('layouts.app')

@section('title', 'Gestión de Registros de Eventos')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Gestión de Registros de Eventos</h1>
            <p class="text-gray-600 mt-2">Busca usuarios y gestiona sus registros en eventos</p>
        </div>

        <!-- Search User Section -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Buscar Usuario</h2>
            <div class="relative">
                <input type="text" id="userSearch" placeholder="Buscar por nombre, email o documento..."
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </div>

            <!-- Search Results -->
            <div id="searchResults" class="mt-4 hidden">
                <div class="border border-gray-200 rounded-lg max-h-60 overflow-y-auto">
                    <!-- Results will be populated here -->
                </div>
            </div>
        </div>

        <!-- User Info Section -->
        <div id="userInfoSection" class="bg-white rounded-lg shadow-md p-6 mb-6 hidden">
            <div class="flex justify-between items-start mb-4">
                <div>
                    <h2 class="text-xl font-semibold text-gray-700" id="userName"></h2>
                    <p class="text-gray-600" id="userEmail"></p>
                    <p class="text-sm text-gray-500" id="userModality"></p>
                </div>
                <button id="clearUser" class="text-red-600 hover:text-red-800 text-sm font-medium">
                    Cambiar Usuario
                </button>
            </div>
        </div>

        <!-- Tabs -->
        <div class="bg-white rounded-lg shadow-md">
            <div class="border-b border-gray-200">
                <nav class="flex -mb-px">
                    <button id="registeredTab"
                        class="tab-button active py-4 px-6 text-center border-b-2 border-blue-500 font-medium text-blue-600">
                        <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Eventos Registrados
                    </button>
                    <button id="availableTab"
                        class="tab-button py-4 px-6 text-center border-b-2 border-transparent font-medium text-gray-500 hover:text-gray-700">
                        <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Agregar Eventos
                    </button>
                </nav>
            </div>

            <!-- Content Areas -->
            <div class="p-6">
                <!-- Registered Events -->
                <div id="registeredEventsSection">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-semibold text-gray-700">Eventos Registrados</h3>
                        <span id="registeredCount"
                            class="bg-blue-100 text-blue-800 text-sm font-medium px-3 py-1 rounded-full">
                            0 eventos
                        </span>
                    </div>
                    <div id="registeredEventsList" class="space-y-4">
                        <!-- Events will be populated here -->
                    </div>
                    <div id="noRegisteredEvents" class="text-center py-12 hidden">
                        <div class="bg-gray-50 rounded-lg p-8">
                            <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                </path>
                            </svg>
                            <h3 class="mt-4 text-lg font-medium text-gray-900">No hay eventos registrados</h3>
                            <p class="mt-2 text-gray-500">Este usuario no está registrado en ningún evento.</p>
                            <button onclick="switchTab('available')"
                                class="mt-4 inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Agregar primer evento
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Available Events -->
                <div id="availableEventsSection" class="hidden">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-semibold text-gray-700">Agregar Nuevos Eventos</h3>
                        <span id="availableCount"
                            class="bg-green-100 text-green-800 text-sm font-medium px-3 py-1 rounded-full">
                            0 disponibles
                        </span>
                    </div>

                    <!-- Search Events -->
                    <div class="bg-gray-50 rounded-lg p-4 mb-6">
                        <div class="flex flex-col md:flex-row gap-4">
                            <div class="flex-1 relative">
                                <input type="text" id="eventSearch"
                                    placeholder="Buscar eventos por título, descripción o categoría..."
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <button id="clearEventSearch"
                                class="px-4 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-100 transition-colors whitespace-nowrap">
                                Limpiar
                            </button>
                        </div>
                        <p class="text-sm text-gray-500 mt-2">
                            Ejemplo: busca "turismo", "tecnología", "cultural", etc.
                        </p>
                    </div>

                    <!-- Capacity Legend -->
                    <div class="flex flex-wrap gap-4 mb-6 text-sm">
                        <div class="flex items-center">
                            <div class="w-3 h-3 bg-green-500 rounded-full mr-2"></div>
                            <span class="text-gray-600">Alta disponibilidad (5+ cupos)</span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-3 h-3 bg-yellow-500 rounded-full mr-2"></div>
                            <span class="text-gray-600">Baja disponibilidad (1-5 cupos)</span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-3 h-3 bg-red-500 rounded-full mr-2"></div>
                            <span class="text-gray-600">Sin cupos disponibles</span>
                        </div>
                    </div>

                    <div id="availableEventsList" class="grid gap-4">
                        <!-- Events will be populated here -->
                    </div>
                    <div id="noAvailableEvents" class="text-center py-12 hidden">
                        <div class="bg-gray-50 rounded-lg p-8">
                            <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                </path>
                            </svg>
                            <h3 class="mt-4 text-lg font-medium text-gray-900">No hay eventos disponibles</h3>
                            <p class="mt-2 text-gray-500">No se encontraron eventos que coincidan con tu búsqueda.</p>
                            <button id="resetSearch"
                                class="mt-4 inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                                    </path>
                                </svg>
                                Mostrar todos los eventos
                            </button>
                        </div>
                    </div>
                    <div id="searchingEvents" class="text-center py-8 hidden">
                        <div class="flex justify-center items-center">
                            <svg class="animate-spin h-8 w-8 text-blue-600 mr-3" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                            <span class="text-gray-600">Buscando eventos...</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Loading Spinner -->
    <div id="loadingSpinner" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-blue-100">
                    <svg class="animate-spin h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                            stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor"
                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                        </path>
                    </svg>
                </div>
                <h3 class="text-lg leading-6 font-medium text-gray-900 mt-2">Procesando...</h3>
            </div>
        </div>
    </div>

    <!-- Success Notification -->
    <div id="successNotification"
        class="fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg transform translate-x-full transition-transform duration-300 z-50 hidden">
        <div class="flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            <span id="successMessage"></span>
        </div>
    </div>

    <!-- Error Notification -->
    <div id="errorNotification"
        class="fixed top-4 right-4 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg transform translate-x-full transition-transform duration-300 z-50 hidden">
        <div class="flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
            <span id="errorMessage"></span>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Estado global
        let currentUser = null;
        let searchTimeout = null;
        let eventSearchTimeout = null;

        // Elementos DOM
        const elements = {
            userSearch: document.getElementById('userSearch'),
            searchResults: document.getElementById('searchResults'),
            userInfoSection: document.getElementById('userInfoSection'),
            userName: document.getElementById('userName'),
            userEmail: document.getElementById('userEmail'),
            userModality: document.getElementById('userModality'),
            clearUser: document.getElementById('clearUser'),
            registeredTab: document.getElementById('registeredTab'),
            availableTab: document.getElementById('availableTab'),
            registeredEventsSection: document.getElementById('registeredEventsSection'),
            availableEventsSection: document.getElementById('availableEventsSection'),
            registeredEventsList: document.getElementById('registeredEventsList'),
            availableEventsList: document.getElementById('availableEventsList'),
            noRegisteredEvents: document.getElementById('noRegisteredEvents'),
            noAvailableEvents: document.getElementById('noAvailableEvents'),
            registeredCount: document.getElementById('registeredCount'),
            availableCount: document.getElementById('availableCount'),
            eventSearch: document.getElementById('eventSearch'),
            clearEventSearch: document.getElementById('clearEventSearch'),
            resetSearch: document.getElementById('resetSearch'),
            searchingEvents: document.getElementById('searchingEvents'),
            loadingSpinner: document.getElementById('loadingSpinner'),
            successNotification: document.getElementById('successNotification'),
            errorNotification: document.getElementById('errorNotification'),
            successMessage: document.getElementById('successMessage'),
            errorMessage: document.getElementById('errorMessage')
        };

        // Funciones de utilidad
        function showLoading() {
            elements.loadingSpinner.classList.remove('hidden');
        }

        function hideLoading() {
            elements.loadingSpinner.classList.add('hidden');
        }

        function showNotification(element, message) {
            const messageElement = element === elements.successNotification ?
                elements.successMessage : elements.errorMessage;
            messageElement.textContent = message;
            element.classList.remove('hidden', 'translate-x-full');
            element.classList.add('translate-x-0');

            setTimeout(() => {
                element.classList.remove('translate-x-0');
                element.classList.add('translate-x-full');
                setTimeout(() => element.classList.add('hidden'), 300);
            }, 3000);
        }

        function showSuccess(message) {
            showNotification(elements.successNotification, message);
        }

        function showError(message) {
            showNotification(elements.errorNotification, message);
        }

        // Búsqueda de usuarios
        elements.userSearch.addEventListener('input', function(e) {
            clearTimeout(searchTimeout);
            const searchTerm = e.target.value.trim();

            if (searchTerm.length < 3) {
                elements.searchResults.classList.add('hidden');
                return;
            }

            searchTimeout = setTimeout(() => {
                searchUsers(searchTerm);
            }, 500);
        });

        async function searchUsers(searchTerm) {
            try {
                showLoading();
                const response = await axios.post('{{ route('user-event-management.search-users') }}', {
                    search: searchTerm
                });

                displaySearchResults(response.data);
            } catch (error) {
                console.error('Error searching users:', error);
                showError('Error al buscar usuarios');
            } finally {
                hideLoading();
            }
        }

        function displaySearchResults(users) {
            const resultsContainer = elements.searchResults;
            resultsContainer.innerHTML = '';

            if (users.length === 0) {
                resultsContainer.innerHTML = `
                <div class="p-4 text-center text-gray-500">
                    No se encontraron usuarios
                </div>
            `;
            } else {
                users.forEach(user => {
                    const userElement = document.createElement('div');
                    userElement.className =
                        'p-4 border-b border-gray-100 hover:bg-gray-50 cursor-pointer transition-colors';
                    userElement.innerHTML = `
                    <div class="flex justify-between items-center">
                        <div>
                            <h4 class="font-medium text-gray-900">${user.name}</h4>
                            <p class="text-sm text-gray-600">${user.email}</p>
                            <p class="text-xs text-gray-500">Documento: ${user.document_number}</p>
                        </div>
                        <div class="text-right">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                ${user.modality_name}
                            </span>
                            ${user.has_registration ? 
                                '<span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Inscrito</span>' : 
                                '<span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">Sin inscripción</span>'
                            }
                        </div>
                    </div>
                `;
                    userElement.addEventListener('click', () => selectUser(user));
                    resultsContainer.appendChild(userElement);
                });
            }

            resultsContainer.classList.remove('hidden');
        }

        function selectUser(user) {
            currentUser = user;
            elements.userSearch.value = '';
            elements.searchResults.classList.add('hidden');

            // Mostrar información del usuario
            elements.userName.textContent = user.name;
            elements.userEmail.textContent = user.email;
            elements.userModality.textContent = `Modalidad: ${user.modality_name}`;
            elements.userInfoSection.classList.remove('hidden');

            // Cargar eventos del usuario
            loadUserEvents();

            // Activar pestaña de eventos registrados
            switchTab('registered');
        }

        elements.clearUser.addEventListener('click', function() {
            currentUser = null;
            elements.userInfoSection.classList.add('hidden');
            elements.registeredEventsList.innerHTML = '';
            elements.availableEventsList.innerHTML = '';
            elements.noRegisteredEvents.classList.add('hidden');
            elements.noAvailableEvents.classList.add('hidden');
            elements.registeredCount.textContent = '0 eventos';
            elements.availableCount.textContent = '0 disponibles';
        });

        // Gestión de pestañas
        function switchTab(tab) {
            // Reset estilos de pestañas
            elements.registeredTab.classList.remove('active', 'border-blue-500', 'text-blue-600');
            elements.registeredTab.classList.add('border-transparent', 'text-gray-500');
            elements.availableTab.classList.remove('active', 'border-blue-500', 'text-blue-600');
            elements.availableTab.classList.add('border-transparent', 'text-gray-500');

            // Ocultar secciones
            elements.registeredEventsSection.classList.add('hidden');
            elements.availableEventsSection.classList.add('hidden');

            // Activar pestaña seleccionada
            if (tab === 'registered') {
                elements.registeredTab.classList.add('active', 'border-blue-500', 'text-blue-600');
                elements.registeredEventsSection.classList.remove('hidden');
                if (currentUser) loadUserEvents();
            } else {
                elements.availableTab.classList.add('active', 'border-blue-500', 'text-blue-600');
                elements.availableEventsSection.classList.remove('hidden');
                if (currentUser) {
                    loadAvailableEvents();
                    // Limpiar búsqueda de eventos al cambiar de pestaña
                    elements.eventSearch.value = '';
                }
            }
        }

        elements.registeredTab.addEventListener('click', () => switchTab('registered'));
        elements.availableTab.addEventListener('click', () => switchTab('available'));

        // Cargar eventos del usuario
        async function loadUserEvents() {
            if (!currentUser) return;

            try {
                showLoading();
                const response = await axios.get(`/user-event-management/user/${currentUser.id}/events`);
                displayUserEvents(response.data.registered_events);
            } catch (error) {
                console.error('Error loading user events:', error);
                showError('Error al cargar eventos del usuario');
            } finally {
                hideLoading();
            }
        }

        function displayUserEvents(events) {
            const container = elements.registeredEventsList;
            container.innerHTML = '';

            // Actualizar contador
            elements.registeredCount.textContent = `${events.length} evento${events.length !== 1 ? 's' : ''}`;

            if (events.length === 0) {
                elements.noRegisteredEvents.classList.remove('hidden');
                return;
            }

            elements.noRegisteredEvents.classList.add('hidden');

            events.forEach(event => {
                const eventElement = document.createElement('div');
                eventElement.className =
                    'bg-white border border-gray-200 rounded-lg p-6 hover:shadow-md transition-shadow';
                eventElement.innerHTML = `
                <div class="flex justify-between items-start">
                    <div class="flex-1">
                        <div class="flex items-start justify-between mb-3">
                            <h4 class="font-semibold text-gray-900 text-lg">${event.title}</h4>
                            
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 text-sm text-gray-600 mb-3">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                                <span>${event.modality}</span>
                            </div>
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span>${event.locations || 'No asignada'}</span>
                            </div>
                        </div>
                        
                        ${event.schedules.length > 0 ? `
                                            <div class="mt-3">
                                                <span class="font-medium text-sm text-gray-700">Horarios:</span>
                                                <div class="mt-2 flex flex-wrap gap-2">
                                                    ${event.schedules.map(schedule => `
                                                <div class="bg-blue-50 text-blue-700 px-3 py-1 rounded-full text-xs font-medium">
                                                    <div class="text-center">
                                                        <div class="font-semibold">${schedule.date}</div>
                                                        <div class="text-xs mt-1">${schedule.time}</div>
                                                    </div>
                                                </div>
                                                `).join('')}
                                                </div>
                                            </div>
                                        ` : ''}
                    </div>
                    <div class="ml-6 flex-shrink-0">
                        <button onclick="removeFromEvent(${event.id})" 
                                class="flex items-center px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors text-sm font-medium">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            Eliminar
                        </button>
                    </div>
                </div>
            `;
                container.appendChild(eventElement);
            });
        }

        // Búsqueda de eventos disponibles
        elements.eventSearch.addEventListener('input', function(e) {
            clearTimeout(eventSearchTimeout);
            const searchTerm = e.target.value.trim();

            elements.searchingEvents.classList.remove('hidden');
            elements.availableEventsList.classList.add('hidden');

            eventSearchTimeout = setTimeout(() => {
                if (currentUser) {
                    searchAvailableEvents(searchTerm);
                }
            }, 800);
        });

        elements.clearEventSearch.addEventListener('click', function() {
            elements.eventSearch.value = '';
            if (currentUser) {
                loadAvailableEvents();
            }
        });

        elements.resetSearch.addEventListener('click', function() {
            elements.eventSearch.value = '';
            if (currentUser) {
                loadAvailableEvents();
            }
        });

        async function searchAvailableEvents(searchTerm = '') {
            if (!currentUser) return;

            try {
                const response = await axios.get(
                    `/user-event-management/user/${currentUser.id}/search-available-events`, {
                        params: {
                            search: searchTerm
                        }
                    });

                displayAvailableEvents(response.data);
            } catch (error) {
                console.error('Error searching available events:', error);
                showError('Error al buscar eventos');
            } finally {
                elements.searchingEvents.classList.add('hidden');
                elements.availableEventsList.classList.remove('hidden');
            }
        }

        // Cargar eventos disponibles
        async function loadAvailableEvents() {
            if (!currentUser) return;

            try {
                elements.searchingEvents.classList.remove('hidden');
                elements.availableEventsList.classList.add('hidden');

                const response = await axios.get(`/user-event-management/user/${currentUser.id}/available-events`);
                displayAvailableEvents(response.data);
            } catch (error) {
                console.error('Error loading available events:', error);
                showError('Error al cargar eventos disponibles');
            } finally {
                elements.searchingEvents.classList.add('hidden');
                elements.availableEventsList.classList.remove('hidden');
            }
        }

        function displayAvailableEvents(events) {
            const container = elements.availableEventsList;
            container.innerHTML = '';

            // Actualizar contador
            const availableEvents = events.filter(event => event.has_capacity);
            elements.availableCount.textContent =
                `${availableEvents.length} disponible${availableEvents.length !== 1 ? 's' : ''}`;

            if (events.length === 0) {
                elements.noAvailableEvents.classList.remove('hidden');
                return;
            }

            elements.noAvailableEvents.classList.add('hidden');

            events.forEach(event => {
                const eventElement = document.createElement('div');
                eventElement.className = `bg-white border ${
                event.has_capacity ? 'border-gray-200 hover:shadow-md' : 'border-red-200 opacity-75'
            } rounded-lg p-6 transition-all`;
                eventElement.innerHTML = `
                <div class="flex justify-between items-start">
                    <div class="flex-1">
                        <div class="flex items-start justify-between mb-3">
                            <h4 class="font-semibold text-gray-900 text-lg">${event.title}</h4>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium ${
                                event.capacity_status === 'high' ? 'bg-green-100 text-green-800' : 
                                event.capacity_status === 'low' ? 'bg-yellow-100 text-yellow-800' : 
                                'bg-red-100 text-red-800'
                            }">
                                 cupos disponibles
                            </span>
                        </div>
                        
                        ${event.description ? `
                                            <p class="text-gray-600 text-sm mb-3 line-clamp-2">${event.description}</p>
                                        ` : ''}
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 text-sm text-gray-600 mb-3">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                                <span>${event.modality}</span>
                            </div>
                          
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span>${event.locations || 'No asignada'}</span>
                            </div>
                        </div>
                        
                        ${event.schedules.length > 0 ? `
                                            <div class="mt-3">
                                                <span class="font-medium text-sm text-gray-700">Horarios:</span>
                                                <div class="mt-2 flex flex-wrap gap-2">
                                                   ${event.schedules.map(schedule => `
    <div class="bg-blue-50 text-blue-700 px-4 py-2 rounded-lg min-w-[120px]">
                                            <div class="text-center">
                                                <div class="font-semibold text-sm leading-tight">${schedule.date}</div>
                                                <div class="text-xs mt-1 text-blue-600 font-medium">${schedule.time}</div>
                                            </div>
                                        </div>
    `).join('')}
                                                </div>
                                            </div>
                                        ` : ''}
                    </div>
                    <div class="ml-6 flex-shrink-0">
                        <button onclick="registerToEvent(${event.id})" 
                                ${!event.has_capacity ? 'disabled' : ''}
                                class="flex items-center px-4 py-2 ${
                                    event.has_capacity ? 
                                    'bg-blue-600 hover:bg-blue-700 text-white' : 
                                    'bg-gray-400 cursor-not-allowed text-gray-200'
                                } rounded-lg transition-colors text-sm font-medium">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            ${event.has_capacity ? 'Agregar' : 'Sin cupos'}
                        </button>
                    </div>
                </div>
            `;
                container.appendChild(eventElement);
            });
        }

        // Funciones de registro y eliminación - FUERA de displayAvailableEvents
        async function registerToEvent(eventId) {
            if (!currentUser) return;

            try {
                showLoading();
                const response = await axios.post('{{ route('user-event-management.register-event') }}', {
                    user_id: currentUser.id,
                    event_id: eventId
                });

                //console.log('📥 Respuesta del servidor:', response.data);

                if (response.data.success) {
                    showSuccess('Usuario registrado exitosamente en el evento');
                    // Recargar ambas listas
                    loadUserEvents();
                    loadAvailableEvents();
                } else {
                    showError(response.data.message);
                }
            } catch (error) {
                console.error('Error registering to event:', error);
                if (error.response && error.response.data.message) {
                    showError(error.response.data.message);
                } else {
                    showError('Error al registrar usuario en el evento');
                }
            } finally {
                hideLoading();
            }
        }

        async function removeFromEvent(registrationEventId) {
            if (!confirm('¿Estás seguro de que deseas eliminar este registro?')) {
                return;
            }

            try {
                showLoading();
                const response = await axios.delete(`/user-event-management/remove-event/${registrationEventId}`);

                if (response.data.success) {
                    showSuccess('Registro eliminado exitosamente');
                    // Recargar ambas listas
                    loadUserEvents();
                    loadAvailableEvents();
                } else {
                    showError(response.data.message);
                }
            } catch (error) {
                console.error('Error removing from event:', error);
                if (error.response && error.response.data.message) {
                    showError(error.response.data.message);
                } else {
                    showError('Error al eliminar registro');
                }
            } finally {
                hideLoading();
            }
        }

        // Cerrar resultados de búsqueda al hacer clic fuera
        document.addEventListener('click', function(e) {
            if (!elements.searchResults.contains(e.target) && e.target !== elements.userSearch) {
                elements.searchResults.classList.add('hidden');
            }
        });
    </script>

    <style>
        .tab-button.active {
            border-bottom-color: #3b82f6;
            color: #2563eb;
        }

        .tab-button:hover:not(.active) {
            color: #374151;
        }

        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
@endpush
