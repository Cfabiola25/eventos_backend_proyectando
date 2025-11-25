@extends('layouts.app')

@section('title', 'Gestión de Temas')

@section('content')
    <div class="mt-4 min-h-screen w-full mx-auto">
        <h1 class="text-2xl font-bold mb-6 text-gray-800">Gestión de Temas</h1>

        <!-- Tarjetas de métricas de Temas -->
        @include('theme.components.cards')

        <!-- Tabla de temas -->
        @include('theme.components.table')
    </div>

    <!-- Modal para crear nuevo tema -->
    @include('theme.components.modalCreate')

    <!-- Modal para ver descripción completa -->
    @include('theme.components.modalShow')

    <!-- Modal para eliminar -->
    @include('theme.components.modalDelete')

    <!-- Modal para editar -->
    @include('theme.components.modalEdit')

    <!-- Notificación -->
    @include('theme.components.notification')
@endsection

@push('scripts')
    <script>
        // Variables para los modales
        let descriptionModal = document.getElementById('descriptionModal');
        let deleteModal = document.getElementById('deleteModal');
        let editModal = document.getElementById('editModal');
        let createModal = document.getElementById('createModal');
        let notification = document.getElementById('notification');
        let notificationIcon = document.getElementById('notificationIcon');

        // Función para mostrar notificación
        function showNotification(message, isSuccess = true) {
            const notificationText = document.getElementById('notificationText');

            if (isSuccess) {
                notification.classList.add('bg-green-500');
                notification.classList.remove('bg-red-500');
                notificationIcon.innerHTML =
                    '<path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>';
            } else {
                notification.classList.add('bg-red-500');
                notification.classList.remove('bg-green-500');
                notificationIcon.innerHTML =
                    '<path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/>';
            }

            notificationText.textContent = message;
            notification.classList.remove('translate-y-[-100px]');
            notification.classList.add('translate-y-0');

            setTimeout(() => {
                notification.classList.remove('translate-y-0');
                notification.classList.add('translate-y-[-100px]');
            }, 3000);
        }

        // =============================================
        // FUNCIONES PARA ACTUALIZAR CARDS
        // =============================================

        // Función para calcular métricas de temas
        function calculateThemeMetrics() {
            const themeRows = document.querySelectorAll('tbody tr[id^="theme-row-"]');
            let total = themeRows.length;
            let upcoming = 0;
            let past = 0;

            const today = new Date();
            today.setHours(0, 0, 0, 0);

            themeRows.forEach(row => {
                const startDateElement = row.querySelector('[id^="start-date-"]');
                if (startDateElement) {
                    const dateText = startDateElement.textContent.trim();

                    // Parsear fecha en formato dd/mm/yyyy
                    const parts = dateText.split('/');
                    if (parts.length === 3) {
                        const day = parseInt(parts[0]);
                        const month = parseInt(parts[1]) - 1; // Meses en JS son 0-based
                        const year = parseInt(parts[2]);

                        const themeDate = new Date(year, month, day);

                        if (themeDate >= today) {
                            upcoming++;
                        } else {
                            past++;
                        }
                    }
                }
            });

            return {
                total,
                upcoming,
                past
            };
        }

        // Función para animar el cambio de números en las cards
        function animateCount(elementId, targetValue) {
            const element = document.getElementById(elementId);
            if (!element) return;

            const currentValue = parseInt(element.textContent) || 0;

            if (currentValue === targetValue) return;

            // Animación simple
            element.style.transform = 'scale(1.1)';
            element.style.transition = 'transform 0.3s ease';

            setTimeout(() => {
                element.textContent = targetValue;
                element.style.transform = 'scale(1)';
            }, 150);
        }

        // Función para actualizar las cards con animación
        function updateCardsWithAnimation() {
            const metrics = calculateThemeMetrics();

            // Animación de conteo para mejor experiencia de usuario
            animateCount('total-themes-count', metrics.total);
            animateCount('upcoming-themes-count', metrics.upcoming);
            animateCount('past-themes-count', metrics.past);
        }

        // =============================================
        // FUNCIONES PARA LA TABLA
        // =============================================

        // Función para agregar nuevo tema a la tabla
        function addThemeToTable(theme) {
            const tbody = document.querySelector('tbody');

            // Verificar si la tabla está vacía (tiene el mensaje de "no se encontraron temas")
            const emptyRow = tbody.querySelector('td[colspan="5"]');
            if (emptyRow) {
                tbody.innerHTML = ''; // Limpiar el mensaje de tabla vacía
            }

            // Crear la fila con el nuevo tema
            const newRow = document.createElement('tr');
            newRow.id = `theme-row-${theme.uuid}`;
            newRow.className = 'hover:bg-gray-50 transition-colors';

            // Formatear fecha
            const formattedDate = formatDate(theme.start_date);

            // Crear descripción corta
            const shortDescription = theme.description ?
                (theme.description.length > 50 ? theme.description.substring(0, 50) + '...' : theme.description) :
                'Sin descripción';

            newRow.innerHTML = `
                <!-- Nombre -->
                <td class="border px-2 py-2">
                    <div class="font-medium text-gray-900 whitespace-nowrap" id="name-${theme.uuid}">
                        ${theme.name}
                    </div>
                </td>

                <!-- Fecha Inicio -->
                <td class="border px-2 py-2">
                    <div class="text-xs text-gray-500 whitespace-nowrap" id="start-date-${theme.uuid}">
                        ${formattedDate}
                    </div>
                </td>

                <!-- Agenda Asociada -->
                <td class="border px-2 py-2">
                    <div class="text-xs text-gray-500 whitespace-nowrap" id="agenda-${theme.uuid}">
                        ${theme.agenda_title || '<span class="text-gray-400">Sin agenda</span>'}
                    </div>
                </td>

                <!-- Descripción (acortada) -->
                <td class="border px-2 py-2">
                    <div class="text-xs text-gray-900 whitespace-nowrap truncate max-w-[150px]"
                        title="${theme.description || 'Sin descripción'}" id="description-${theme.uuid}">
                        ${shortDescription}
                    </div>
                </td>

                <!-- Acciones -->
                <td class="border px-2 py-2">
                    <div class="flex space-x-1 justify-center">
                        <!-- Botón para ver descripción completa en modal -->
                        <button type="button"
                            onclick="openDescriptionModal('${theme.name.replace(/'/g, "\\'")}', '${(theme.description || 'Sin descripción').replace(/'/g, "\\'")}')"
                            class="text-purple-600 hover:text-purple-800 p-1 rounded hover:bg-purple-50"
                            title="Ver descripción completa">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                        <!-- Botón para editar en modal -->
                        <button type="button"
                            onclick="openEditModal('${theme.uuid}')"
                            class="text-blue-600 hover:text-blue-800 p-1 rounded hover:bg-blue-50"
                            title="Editar tema">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </button>
                        <!-- Botón para eliminar en modal -->
                        <button type="button"
                            onclick="openDeleteModal('${theme.uuid}', '${theme.name.replace(/'/g, "\\'")}')"
                            class="text-red-600 hover:text-red-800 p-1 rounded hover:bg-red-50"
                            title="Eliminar tema">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </button>
                    </div>
                </td>
            `;

            // Agregar la nueva fila al principio de la tabla
            if (tbody.firstChild) {
                tbody.insertBefore(newRow, tbody.firstChild);
            } else {
                tbody.appendChild(newRow);
            }
        }

        // Función para actualizar los datos en la tabla sin recargar
        function updateThemeInTable(uuid, data) {
            // console.log('Actualizando tabla con:', data);

            // Actualizar cada campo en la tabla
            if (document.getElementById(`name-${uuid}`)) {
                document.getElementById(`name-${uuid}`).textContent = data.name;
            }
            if (document.getElementById(`start-date-${uuid}`)) {
                document.getElementById(`start-date-${uuid}`).textContent = formatDate(data.start_date);
            }
            if (document.getElementById(`description-${uuid}`)) {
                const shortDescription = data.description ?
                    (data.description.length > 50 ? data.description.substring(0, 50) + '...' : data.description) :
                    'Sin descripción';
                document.getElementById(`description-${uuid}`).textContent = shortDescription;
                document.getElementById(`description-${uuid}`).title = data.description || 'Sin descripción';
            }
            if (document.getElementById(`agenda-${uuid}`)) {
                // Actualizar el contenido HTML de la agenda
                const agendaElement = document.getElementById(`agenda-${uuid}`);
                if (data.agenda_title) {
                    agendaElement.innerHTML = data.agenda_title;
                } else {
                    agendaElement.innerHTML = '<span class="text-gray-400">Sin agenda</span>';
                }
            }
        }

        // Función para formatear fecha
        function formatDate(dateString) {
            // Si ya está en formato d/m/Y, devolverlo tal cual
            if (typeof dateString === 'string' && dateString.includes('/')) {
                return dateString;
            }

            // Si es una fecha en formato Y-m-d, formatearla
            if (typeof dateString === 'string' && dateString.includes('-')) {
                const date = new Date(dateString);
                return date.toLocaleDateString('es-ES', {
                    day: '2-digit',
                    month: '2-digit',
                    year: 'numeric'
                }).replace(/\//g, '/');
            }

            // Para cualquier otro caso, intentar parsear la fecha
            try {
                const date = new Date(dateString);
                if (!isNaN(date.getTime())) {
                    return date.toLocaleDateString('es-ES', {
                        day: '2-digit',
                        month: '2-digit',
                        year: 'numeric'
                    }).replace(/\//g, '/');
                }
            } catch (e) {
                console.error('Error formateando fecha:', e);
            }

            // Si no se puede formatear, devolver el string original
            return dateString;
        }

        // =============================================
        // FUNCIONES PARA MODALES
        // =============================================

        // Funciones para el modal de descripción
        function openDescriptionModal(name, description) {
            document.getElementById('modalTitle').textContent = name;
            document.getElementById('modalDescription').textContent = description || 'Sin descripción';
            descriptionModal.classList.remove('hidden');
        }

        function closeDescriptionModal() {
            descriptionModal.classList.add('hidden');
        }

        // Funciones para el modal de eliminar
        function openDeleteModal(uuid, name) {
            document.getElementById('deleteMessage').textContent =
                `¿Estás seguro de que deseas eliminar el tema "${name}"? Esta acción no se puede deshacer.`;
            document.getElementById('deleteForm').action = `/themes/${uuid}`;
            deleteModal.classList.remove('hidden');
        }

        function closeDeleteModal() {
            deleteModal.classList.add('hidden');
        }

        // Funciones para el modal de crear
        function openCreateModal() {
            createModal.classList.remove('hidden');
            // Establecer fecha mínima como hoy
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('create_start_date').min = today;
            document.getElementById('create_start_date').value = today;
        }

        function closeCreateModal() {
            createModal.classList.add('hidden');
            document.getElementById('createForm').reset();
            // Restablecer fecha
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('create_start_date').min = today;
            document.getElementById('create_start_date').value = today;
        }

        // Funciones para el modal de editar
        function openEditModal(uuid) {
            // Mostrar loading en el modal
            document.getElementById('editThemeTitle').textContent = 'Cargando...';
            document.getElementById('edit_name').value = '';
            document.getElementById('edit_description').value = '';
            document.getElementById('edit_start_date').value = '';
            document.getElementById('edit_agenda_id').value = '';

            // Mostrar el modal primero
            editModal.classList.remove('hidden');

            // Hacer petición al servidor para obtener los datos actualizados
            axios.get(`/themes/${uuid}/edit`)
                .then(response => {
                    // console.log('Respuesta del servidor:', response.data);
                    if (response.data.success) {
                        const theme = response.data.data;

                        // Llenar el formulario con los datos actualizados del servidor
                        document.getElementById('editThemeTitle').textContent = theme.name;
                        document.getElementById('edit_name').value = theme.name;
                        document.getElementById('edit_description').value = theme.description || '';
                        document.getElementById('edit_start_date').value = theme.start_date;
                        document.getElementById('edit_agenda_id').value = theme.agenda_id || '';

                        // Actualizar el action del formulario
                        document.getElementById('editForm').action = `/themes/${uuid}`;
                    } else {
                        showNotification('Error al cargar los datos del tema', false);
                        closeEditModal();
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showNotification('Error al cargar los datos del tema', false);
                    closeEditModal();
                });
        }

        function closeEditModal() {
            editModal.classList.add('hidden');
        }

        // =============================================
        // MANEJADORES DE FORMULARIOS
        // =============================================

        // Manejar el envío del formulario de creación con Axios - SIN RECARGAR PÁGINA
        document.getElementById('createForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);
            const url = this.action;

            // DEBUG: Verificar qué datos se están enviando
            console.log('=== DEBUG CREATE FORM ===');
            for (let [key, value] of formData.entries()) {
                console.log(`${key}: ${value}`);
            }
            console.log('=== FIN DEBUG ===');

            // Verificar específicamente si agenda_id se está enviando
            const agendaId = document.getElementById('create_agenda_id').value;
            const nameValue = document.getElementById('create_name').value;

            console.log('Valor del campo name:', nameValue);
            console.log('Valor del select agenda_id:', agendaId);

            if (!nameValue || nameValue.trim() === '') {
                showNotification('Por favor ingresa un nombre para el tema', false);
                return;
            }

            if (!agendaId) {
                showNotification('Por favor selecciona una agenda', false);
                return;
            }

            // Mostrar loading en el botón
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = `
        <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
        Creando...
    `;
            submitBtn.disabled = true;

            axios.post(url, formData)
                .then(response => {
                    if (response.data.success) {
                        closeCreateModal();
                        showNotification('¡Tema creado correctamente!', true);

                        // Agregar el nuevo tema a la tabla sin recargar la página
                        if (response.data.theme) {
                            addThemeToTable(response.data.theme);
                            // Actualizar las cards después de agregar el tema
                            updateCardsWithAnimation();
                        }
                    } else {
                        showNotification('Error al crear el tema: ' + (response.data.message ||
                            'Error desconocido'), false);
                    }
                })
                .catch(error => {
                    console.error('Error completo:', error);
                    let errorMessage = 'Error al crear el tema';

                    if (error.response && error.response.data) {
                        console.error('Respuesta de error del servidor:', error.response.data);
                        if (error.response.data.message) {
                            errorMessage = error.response.data.message;
                        } else if (error.response.data.errors) {
                            // Mostrar todos los errores de validación
                            const errors = error.response.data.errors;
                            const errorMessages = Object.values(errors).flat();
                            errorMessage = 'Errores: ' + errorMessages.join(', ');
                        }
                    }

                    showNotification(errorMessage, false);
                })
                .finally(() => {
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                });
        });

        // Manejar el envío del formulario de edición con Axios

        document.getElementById('editForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);
            const url = this.action;
            const uuid = url.split('/').pop();

            // CORRECCIÓN: Agregar el método PUT al FormData
            formData.append('_method', 'PUT');

            // Mostrar loading en el botón
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = `
        <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
        Guardando...
    `;
            submitBtn.disabled = true;

            // CORRECCIÓN: Usar axios.post con _method en FormData
            axios.post(url, formData)
                .then(response => {
                    if (response.data.success) {
                        closeEditModal();

                        // Actualizar la tabla con los datos que devuelve el servidor
                        if (response.data.data) {
                            updateThemeInTable(uuid, {
                                name: response.data.data.name,
                                start_date: response.data.data.start_date,
                                description: response.data.data.description,
                                agenda_id: response.data.data.agenda_id,
                                agenda_title: response.data.data.agenda_title
                            });

                            // Actualizar las cards por si cambió la fecha
                            updateCardsWithAnimation();
                        }

                        showNotification('¡Tema actualizado correctamente!', true);
                    } else {
                        showNotification('Error al actualizar el tema: ' + (response.data.message ||
                            'Error desconocido'), false);
                    }
                })
                .catch(error => {
                    console.error('Error completo:', error);
                    let errorMessage = 'Error al actualizar el tema';

                    if (error.response && error.response.data) {
                        console.error('Respuesta de error del servidor:', error.response.data);
                        if (error.response.data.message) {
                            errorMessage = error.response.data.message;
                        } else if (error.response.data.errors) {
                            // Mostrar todos los errores de validación
                            const errors = error.response.data.errors;
                            const errorMessages = Object.values(errors).flat();
                            errorMessage = errorMessages.join(', ');
                        }
                    }

                    showNotification(errorMessage, false);
                })
                .finally(() => {
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                });
        });
        // Manejar el envío del formulario de eliminación con Axios
        document.getElementById('deleteForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);
            const url = this.action;
            const uuid = url.split('/').pop();

            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = `
                <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Eliminando...
            `;
            submitBtn.disabled = true;

            axios.post(url, formData)
                .then(response => {
                    if (response.data.success) {
                        closeDeleteModal();
                        const row = document.getElementById(`theme-row-${uuid}`);
                        if (row) {
                            row.remove();
                        }
                        showNotification('¡Tema eliminado correctamente!', true);
                        // Actualizar las cards después de eliminar el tema
                        updateCardsWithAnimation();
                    } else {
                        showNotification('Error al eliminar el tema: ' + (response.data.message ||
                            'Error desconocido'), false);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    let errorMessage = 'Error al eliminar el tema';

                    if (error.response && error.response.data && error.response.data.message) {
                        errorMessage = error.response.data.message;
                    }

                    showNotification(errorMessage, false);
                })
                .finally(() => {
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                });
        });

        // =============================================
        // EVENT LISTENERS GLOBALES
        // =============================================

        // Cerrar modales al hacer click fuera del contenido
        document.addEventListener('click', function(e) {
            if (e.target === descriptionModal) closeDescriptionModal();
            if (e.target === deleteModal) closeDeleteModal();
            if (e.target === editModal) closeEditModal();
            if (e.target === createModal) closeCreateModal();
        });

        // Cerrar modales con tecla ESC
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeDescriptionModal();
                closeDeleteModal();
                closeEditModal();
                closeCreateModal();
            }
        });

        // Función para debug - verificar el estado actual de las cards
        function debugCards() {
            const metrics = calculateThemeMetrics();
            /* console.log('Métricas actuales:', metrics);
            console.log('Total temas en tabla:', document.querySelectorAll('tbody tr[id^="theme-row-"]').length); */
        }
    </script>
@endpush
