@extends('layouts.app')

@section('title', 'Lista de usuarios')

@section('content')
    <div class="w-full px-4 py-6 mx-auto mt-16">
        <!-- Cards de estadísticas -->
        @include('user.components.cards', [
            'totalUsers' => $totalUsers,
            'activeUsers' => $activeUsers,
            'inactiveUsers' => $inactiveUsers,
            'downloadedDiplomas' => $downloadedDiplomas,
        ])

        <!-- Contenedor principal con tabla -->
        <div class="w-full mt-6 bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="p-6">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                    <h2 class="text-2xl font-bold text-gray-800">
                        <i class="fas fa-users text-primary-600 mr-2"></i>
                        Lista de Usuarios
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

                        @if(Auth::user()->is_admin)
                        <!-- NUEVO: Botón para acciones masivas de diplomas -->
                        <div class="relative">
                            <button onclick="toggleMassDiplomaActions()"
                                class="bg-primary-600 hover:bg-primary-700 text-white font-bold py-2.5 px-6 rounded-lg shadow-lg transition duration-300 flex items-center justify-center whitespace-nowrap">
                                <i class="fas fa-certificate mr-2"></i> Diplomas
                                <i class="fas fa-chevron-down ml-2 text-sm"></i>
                            </button>

                            <!-- Menú desplegable para acciones masivas -->
                            <div id="massDiplomaMenu"
                                class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl z-10 border border-gray-200">
                                <div class="py-1">
                                    <button onclick="confirmMassDiplomaAction('activate')"
                                        class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 flex items-center">
                                        <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                        Activar Todos
                                    </button>
                                    <button onclick="confirmMassDiplomaAction('deactivate')"
                                        class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-red-50 hover:text-red-700 flex items-center">
                                        <i class="fas fa-times-circle text-red-500 mr-2"></i>
                                        Desactivar Todos
                                    </button>
                                    <hr class="my-1">
                                    <button onclick="confirmMassDiplomaAction('toggle_all')"
                                        class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 flex items-center">
                                        <i class="fas fa-sync-alt text-blue-500 mr-2"></i>
                                        Invertir Estados
                                    </button>
                                </div>
                            </div>
                        </div>
                       @endif

                       @if(Auth::user()->is_admin)
                        <!-- Botón Agregar -->
                        <a href="{{ route('users.create') }}"
                            class="bg-primary-600 hover:bg-primary-700 text-white font-bold py-2.5 px-6 rounded-lg shadow-lg transition duration-300 flex items-center justify-center whitespace-nowrap">
                            <i class="fas fa-plus mr-2"></i> Agregar Usuario
                        </a>
                        @endif
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
                    @include('user.components.table', ['users' => $users])
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

        <!-- Modal de Cambio de Contraseña -->
        @include('user.components.passwordModal')

        <!-- Modal de Confirmación para Eliminar -->
        @include('user.components.deleteModal')

        <!-- Modal de Confirmación para Toggle de Campos Booleanos -->
        @include('user.components.massDiploma')
    </div>
@endsection

@push('scripts')
    <script>
        let searchTimeout = null;
        let currentSearch = '';
        let currentToggleData = null; // Variable para almacenar datos del toggle actual
        let currentDeleteData = null; // Variable para almacenar datos de eliminación
        let currentMassAction = null; // Variable para almacenar datos de la acción masiva

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

            axios.get(`/users/search`, {
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

        // Actualizar estadísticas de las cards - CORREGIDO
        function updateStatsCards(stats) {
            // Validar que stats existe y tiene las propiedades necesarias
            if (!stats || typeof stats !== 'object') {
                console.error('Stats no válido:', stats);
                return;
            }

            const totalCard = document.getElementById('totalUsersCount');
            if (totalCard) {
                const currentValue = parseInt(totalCard.textContent) || 0;
                const newValue = parseInt(stats.total) || 0;
                animateValue(totalCard, currentValue, newValue, 500);
            }

            const activeCard = document.getElementById('activeUsersCount');
            if (activeCard) {
                const currentValue = parseInt(activeCard.textContent) || 0;
                const newValue = parseInt(stats.active) || 0;
                animateValue(activeCard, currentValue, newValue, 500);
            }

            const inactiveCard = document.getElementById('inactiveUsersCount');
            if (inactiveCard) {
                const currentValue = parseInt(inactiveCard.textContent) || 0;
                const newValue = parseInt(stats.inactive) || 0;
                animateValue(inactiveCard, currentValue, newValue, 500);
            }

            const downloadedCard = document.getElementById('downloadedDiplomasCount');
            if (downloadedCard) {
                const currentValue = parseInt(downloadedCard.textContent) || 0;
                const newValue = parseInt(stats.downloaded) || 0;
                animateValue(downloadedCard, currentValue, newValue, 500);
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

        // Toggle Status de Usuario con Axios
        function toggleStatus(uuid) {
            axios.post(`/users/${uuid}/toggle-status`)
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

        // Confirmar toggle de campos booleanos
        function confirmToggle(uuid, field, currentValue, userName) {
            currentToggleData = {
                uuid: uuid,
                field: field,
                currentValue: currentValue,
                userName: userName
            };

            const fieldLabels = {
                'is_admin': 'administrador',
                'is_invited': 'invitado',
                'is_paid': 'estado de pago',
                'kit_confirmed': 'confirmación de kit',
                'is_downloaded': 'descarga de diploma'
            };

            const newValue = !currentValue;
            const action = newValue ? 'activar' : 'desactivar';
            const fieldLabel = fieldLabels[field] || field;

            document.getElementById('confirm-message').textContent =
                `¿Está seguro que desea ${action} el ${fieldLabel}?`;
            document.getElementById('confirm-user-name').textContent = userName;

            const modal = document.getElementById('confirm-toggle-modal');
            modal.classList.remove('hidden');
        }

        // Ejecutar el toggle después de confirmar con Axios
       function executeToggle() {
            if (!currentToggleData) return;

            const {
                uuid,
                field,
                currentValue,
                isAdminAction
            } = currentToggleData;
            const newValue = !currentValue;

            // DECIDIR QUÉ ENDPOINT USAR
            let url = '';
            let data = {};

            if (field === 'is_downloaded') {
                if (isAdminAction) {
                    // Usar la ruta de administrador sin restricciones
                    url = `/users/${uuid}/toggle-diploma-admin`;
                } else {
                    // Usar la ruta normal con restricciones
                    url = `/users/${uuid}/toggle-diploma`;
                }
                data = {
                    value: newValue
                };
            } else {
                url = `/users/${uuid}/toggle-boolean`;
                data = {
                    field: field,
                    value: newValue
                };
            }

            axios.post(url, data)
                .then(response => {
                    const result = response.data;

                    if (result.success) {
                        showNotification(result.message, 'success');
                        closeConfirmToggleModal();

                        // Actualizar estadísticas si vienen en la respuesta
                        if (result.stats && typeof result.stats === 'object') {
                            updateStatsCards(result.stats);
                        } else {
                            // Si no vienen stats, forzar recarga
                            performSearch(currentSearch);
                        }

                        performSearch(currentSearch);
                    } else {
                        showNotification(result.message || 'Error al actualizar', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    if (error.response && error.response.status === 422) {
                        const errorMessage = error.response.data.message ||
                            'No se puede activar el diploma. El usuario no tiene asistencias confirmadas.';
                        showNotification(errorMessage, 'error');
                    } else if (error.response && error.response.data.message) {
                        showNotification(error.response.data.message, 'error');
                    } else {
                        showNotification('Error al actualizar', 'error');
                    }
                });
        }

        // Cerrar modal de confirmación
        function closeConfirmToggleModal() {
            const modal = document.getElementById('confirm-toggle-modal');
            modal.classList.add('hidden');

            // Resetear el contenido del mensaje
            document.getElementById('confirm-message').innerHTML = '';
            document.getElementById('confirm-icon').className = 'fas fa-question-circle text-yellow-500 text-3xl';

            currentToggleData = null;
        }

        // Toggle Diploma - ACTUALIZADO para usar el nuevo sistema
        function toggleDiploma(uuid, userName) {
            // Buscar de manera más específica el botón de diploma
            const diplomaButton = document.querySelector(`button[onclick*="toggleDiploma('${uuid}'"]`);

            let currentValue = false;
            if (diplomaButton) {
                // Verificar por las clases que indican el estado activo
                currentValue = diplomaButton.classList.contains('bg-purple-100') ||
                    diplomaButton.textContent.includes('Descargado');
            }

            // Determinar si es administrador
            const isAdmin = {{ Auth::user()->is_admin ? 'true' : 'false' }};

            if (isAdmin) {
                // Para administradores, usar confirmación especial
                confirmAdminDiplomaToggle(uuid, currentValue, userName);
            } else {
                // Para usuarios normales, usar el sistema con restricciones
                confirmToggle(uuid, 'is_downloaded', currentValue, userName);
            }
        }

        // NUEVA FUNCIÓN: Confirmación especial para administradores
        function confirmAdminDiplomaToggle(uuid, currentValue, userName) {
            currentToggleData = {
                uuid: uuid,
                field: 'is_downloaded',
                currentValue: currentValue,
                userName: userName,
                isAdminAction: true
            };

            const newValue = !currentValue;
            const action = newValue ? 'activar' : 'desactivar';

            // Mensaje principal (a la derecha del icono)
            document.getElementById('admin-modal-message').innerHTML = `
                <p class="font-semibold text-gray-800 text-base">¿ACTIVAR diploma en modo administrador?</p>
                <p class="text-sm text-gray-600 mt-1">Usuario: <span class="font-semibold">${userName}</span></p>
            `;

            // Actualizar icono
            document.getElementById('admin-modal-icon').className = 'fas fa-user-shield text-purple-500 text-3xl mt-1';

            // Información adicional (ocupa el mismo ancho que el warning)
            document.getElementById('admin-modal-info').innerHTML = `
            <div class="bg-purple-50 border border-purple-200 rounded-lg p-4">
                <div class="flex items-start">
                    <i class="fas fa-info-circle text-purple-500 text-lg mt-0.5 mr-3"></i>
                    <div>
                        <p class="text-sm text-purple-700 font-medium">
                            Modo Administrador
                        </p>
                        <p class="text-xs text-purple-600 mt-1">
                            Esta acción ${action}á el diploma sin verificar asistencias. Use con responsabilidad.
                        </p>
                    </div>
                </div>
            </div>
        `;

            const modal = document.getElementById('admin-diploma-modal');
            modal.classList.remove('hidden');
        }

        // Función de cierre actualizada
        function closeAdminDiplomaModal() {
            document.getElementById('admin-diploma-modal').classList.add('hidden');
        }

        // Función de ejecución
        // Función de ejecución para admin diploma - VERSIÓN COMPLETA
        function executeAdminDiplomaToggle() {
            if (!currentToggleData) return;

            const {
                uuid,
                field,
                currentValue,
                isAdminAction
            } = currentToggleData;
            const newValue = !currentValue;

            // Usar la ruta de administrador sin restricciones
            const url = `/users/${uuid}/toggle-diploma-admin`;
            const data = {
                value: newValue
            };

            axios.post(url, data)
                .then(response => {
                    const result = response.data;

                    if (result.success) {
                        showNotification(result.message, 'success');
                        closeAdminDiplomaModal();

                        // Actualizar estadísticas si vienen en la respuesta
                        if (result.stats && typeof result.stats === 'object') {
                            updateStatsCards(result.stats);
                        } else {
                            // Si no vienen stats, forzar recarga
                            performSearch(currentSearch);
                        }

                        performSearch(currentSearch);
                    } else {
                        showNotification(result.message || 'Error al actualizar', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    if (error.response && error.response.data.message) {
                        showNotification(error.response.data.message, 'error');
                    } else {
                        showNotification('Error al actualizar', 'error');
                    }
                });
        }

        // Abrir modal de confirmación para eliminar
        function confirmDelete(uuid, userName) {
            currentDeleteData = {
                uuid: uuid,
                userName: userName
            };

            document.getElementById('delete-user-name').textContent = userName;

            const modal = document.getElementById('delete-modal');
            modal.classList.remove('hidden');
        }

        // Ejecutar eliminación después de confirmar con Axios
        function executeDelete() {
            if (!currentDeleteData) return;

            const {
                uuid
            } = currentDeleteData;

            axios.delete(`/users/${uuid}`)
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

        // Modal de Cambio de Contraseña
        function openPasswordModal(uuid, userName) {
            const modal = document.getElementById('password-modal');
            const form = document.getElementById('password-form');
            const userNameElement = document.getElementById('modal-user-name');

            if (modal && form && userNameElement) {
                userNameElement.textContent = userName;
                form.dataset.userId = uuid;
                modal.classList.remove('hidden');
            }
        }

        function closePasswordModal() {
            const modal = document.getElementById('password-modal');
            const form = document.getElementById('password-form');

            if (modal && form) {
                modal.classList.add('hidden');
                form.reset();
            }
        }

        // Submit del formulario de contraseña con Axios
        document.addEventListener('DOMContentLoaded', function() {
            const passwordForm = document.getElementById('password-form');

            if (passwordForm) {
                passwordForm.addEventListener('submit', async function(e) {
                    e.preventDefault();

                    const uuid = this.dataset.userId;
                    const password = document.getElementById('password').value;
                    const passwordConfirmation = document.getElementById('password_confirmation').value;

                    try {
                        const response = await axios.put(`/users/${uuid}/password`, {
                            password: password,
                            password_confirmation: passwordConfirmation
                        });

                        const result = response.data;

                        if (result.success) {
                            showNotification(result.message, 'success');
                            closePasswordModal();
                        } else {
                            showNotification(result.message || 'Error al actualizar la contraseña',
                                'error');
                        }
                    } catch (error) {
                        console.error('Error:', error);
                        showNotification('Error de conexión al actualizar la contraseña', 'error');
                    }
                });
            }

            // Inicializar eventos de paginación al cargar
            initializePaginationEvents();
        });

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

        // NUEVA FUNCIÓN: Mostrar/ocultar menú de acciones masivas
        function toggleMassDiplomaActions() {
            const menu = document.getElementById('massDiplomaMenu');
            menu.classList.toggle('hidden');
        }

        // Cerrar menú al hacer clic fuera de él
        document.addEventListener('click', function(event) {
            const menu = document.getElementById('massDiplomaMenu');
            const button = document.querySelector('button[onclick="toggleMassDiplomaActions()"]');

            if (!menu.contains(event.target) && !button.contains(event.target)) {
                menu.classList.add('hidden');
            }
        });

        // NUEVA FUNCIÓN: Confirmar acción masiva
        function confirmMassDiplomaAction(action) {
            currentMassAction = action;

            const messages = {
                'activate': '¿Está seguro que desea ACTIVAR los diplomas para TODOS los usuarios?',
                'deactivate': '¿Está seguro que desea DESACTIVAR los diplomas para TODOS los usuarios?',
                'toggle_all': '¿Está seguro que desea INVERTIR el estado de diplomas para TODOS los usuarios?'
            };

            const icons = {
                'activate': 'fa-check-circle text-green-500',
                'deactivate': 'fa-times-circle text-red-500',
                'toggle_all': 'fa-sync-alt text-blue-500'
            };

            document.getElementById('mass-diploma-message').textContent = messages[action] || messages.activate;

            const iconElement = document.getElementById('mass-diploma-icon');
            iconElement.className = `fas ${icons[action] || icons.activate} text-3xl`;

            // Cerrar el menú desplegable
            document.getElementById('massDiplomaMenu').classList.add('hidden');

            // Mostrar el modal
            const modal = document.getElementById('mass-diploma-modal');
            modal.classList.remove('hidden');
        }

        // NUEVA FUNCIÓN: Ejecutar acción masiva con Axios
        function executeMassDiplomaAction() {
            if (!currentMassAction) return;

            // Mostrar indicador de carga
            const executeButton = document.querySelector(
            '#mass-diploma-modal button[onclick="executeMassDiplomaAction()"]');
            const originalText = executeButton.innerHTML;
            executeButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Procesando...';
            executeButton.disabled = true;

            axios.post('/users/mass-diploma-action', {
                    action: currentMassAction
                })
                .then(response => {
                    const data = response.data;
                    if (data.success) {
                        showNotification(data.message, 'success');
                        closeMassDiplomaModal();

                        // Actualizar estadísticas y tabla
                        if (data.stats) {
                            updateStatsCards(data.stats);
                        }

                        // Recargar la tabla
                        performSearch(currentSearch);
                    } else {
                        showNotification(data.message || 'Error en la acción masiva', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showNotification('Error al ejecutar la acción masiva', 'error');
                })
                .finally(() => {
                    // Restaurar botón
                    executeButton.innerHTML = originalText;
                    executeButton.disabled = false;
                });
        }

        // NUEVA FUNCIÓN: Cerrar modal de acción masiva
        function closeMassDiplomaModal() {
            const modal = document.getElementById('mass-diploma-modal');
            modal.classList.add('hidden');
            currentMassAction = null;
        }
    </script>
@endpush
