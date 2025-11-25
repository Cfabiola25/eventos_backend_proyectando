@extends('layouts.app')

@section('title', 'Gestión de Agenda')

@section('content')
    <div class="mt-4 min-h-screen w-full mx-auto">
        <h1 class="text-2xl font-bold mb-6 text-gray-800">Gestión de Agenda</h1>

        <!-- Tarjetas de métricas de Agenda -->
        @include('agenda.components.cards')

        <!-- Tabla de agendas -->
        @include('agenda.components.table')
    </div>

    <!-- Modal para ver descripción completa -->
    @include('agenda.components.modalShow')

    <!-- Modal para eliminar -->
    @include('agenda.components.modalDelete')

    <!-- Modal para editar -->
    @include('agenda.components.modalEdit')

    <!-- Notificación -->
    @include('agenda.components.notification')
@endsection

@push('scripts')
    <script>
        // Variables para los modales
        let descriptionModal = document.getElementById('descriptionModal');
        let deleteModal = document.getElementById('deleteModal');
        let editModal = document.getElementById('editModal');
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

        // Función para actualizar los datos en la tabla sin recargar
        function updateAgendaInTable(uuid, data) {
            console.log('Actualizando tabla con:', data);

            // Actualizar cada campo en la tabla
            if (document.getElementById(`title-${uuid}`)) {
                document.getElementById(`title-${uuid}`).textContent = data.title;
            }
            if (document.getElementById(`start-date-${uuid}`)) {
                document.getElementById(`start-date-${uuid}`).textContent = formatDate(data.start_date);
            }
            if (document.getElementById(`end-date-${uuid}`)) {
                document.getElementById(`end-date-${uuid}`).textContent = formatDate(data.end_date);
            }
            if (document.getElementById(`start-time-${uuid}`)) {
                document.getElementById(`start-time-${uuid}`).textContent = data.start_time;
            }
            if (document.getElementById(`end-time-${uuid}`)) {
                document.getElementById(`end-time-${uuid}`).textContent = data.end_time;
            }
            if (document.getElementById(`description-${uuid}`)) {
                const shortDescription = data.description ?
                    (data.description.length > 50 ? data.description.substring(0, 50) + '...' : data.description) :
                    'Sin descripción';
                document.getElementById(`description-${uuid}`).textContent = shortDescription;
                document.getElementById(`description-${uuid}`).title = data.description || 'Sin descripción';
            }
        }

        // Función para formatear fecha
        function formatDate(dateString) {
            const date = new Date(dateString);
            return date.toLocaleDateString('es-ES', {
                day: '2-digit',
                month: '2-digit',
                year: 'numeric'
            }).replace(/\//g, '/');
        }

        // Funciones para el modal de descripción
        function openDescriptionModal(title, description) {
            document.getElementById('modalTitle').textContent = title;
            document.getElementById('modalDescription').textContent = description || 'Sin descripción';
            descriptionModal.classList.remove('hidden');
        }

        function closeDescriptionModal() {
            descriptionModal.classList.add('hidden');
        }

        // Funciones para el modal de eliminar
        function openDeleteModal(uuid, title) {
            document.getElementById('deleteMessage').textContent =
                `¿Estás seguro de que deseas eliminar la agenda "${title}"? Esta acción no se puede deshacer.`;
            document.getElementById('deleteForm').action = `/agenda/${uuid}`;
            deleteModal.classList.remove('hidden');
        }

        function closeDeleteModal() {
            deleteModal.classList.add('hidden');
        }

        // Funciones para el modal de editar - MODIFICADA
        function openEditModal(uuid) {
            // Mostrar loading en el modal
            document.getElementById('editAgendaTitle').textContent = 'Cargando...';
            document.getElementById('edit_title').value = '';
            document.getElementById('edit_description').value = '';
            document.getElementById('edit_start_date').value = '';
            document.getElementById('edit_end_date').value = '';
            document.getElementById('edit_start_time').value = '';
            document.getElementById('edit_end_time').value = '';

            // Mostrar el modal primero
            editModal.classList.remove('hidden');

            // Hacer petición al servidor para obtener los datos actualizados
            axios.get(`/agenda/${uuid}/edit`)
                .then(response => {
                    console.log('Respuesta del servidor:', response.data); // DEBUG
                    if (response.data.success) {
                        const agenda = response.data.data;

                        // Llenar el formulario con los datos actualizados del servidor
                        document.getElementById('editAgendaTitle').textContent = agenda.title;
                        document.getElementById('edit_title').value = agenda.title;
                        document.getElementById('edit_description').value = agenda.description || '';
                        document.getElementById('edit_start_date').value = agenda.start_date;
                        document.getElementById('edit_end_date').value = agenda.end_date;

                        // DEBUG: Verificar valores de las horas
                        console.log('start_time:', agenda.start_time, 'end_time:', agenda.end_time);

                        // Asignar las horas - asegurarse de que estén en formato HH:MM
                        document.getElementById('edit_start_time').value = agenda.start_time;
                        document.getElementById('edit_end_time').value = agenda.end_time;

                        // DEBUG: Verificar valores asignados
                        console.log('start_time input:', document.getElementById('edit_start_time').value);
                        console.log('end_time input:', document.getElementById('edit_end_time').value);

                        // Actualizar el action del formulario
                        document.getElementById('editForm').action = `/agenda/${uuid}`;
                    } else {
                        showNotification('Error al cargar los datos de la agenda', false);
                        closeEditModal();
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showNotification('Error al cargar los datos de la agenda', false);
                    closeEditModal();
                });
        }

        function closeEditModal() {
            editModal.classList.add('hidden');
        }

        // Manejar el envío del formulario de edición con Axios
        document.getElementById('editForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);
            const url = this.action;
            const uuid = url.split('/').pop();

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

            axios.post(url, formData)
                .then(response => {
                    if (response.data.success) {
                        closeEditModal();

                        // Actualizar la tabla con los datos que devuelve el servidor
                        if (response.data.data) {
                            updateAgendaInTable(uuid, {
                                title: response.data.data.title,
                                start_date: response.data.data.start_date,
                                end_date: response.data.data.end_date,
                                start_time: response.data.data.start_time,
                                end_time: response.data.data.end_time,
                                description: response.data.data.description
                            });
                        }

                        showNotification('¡Agenda actualizada correctamente!', true);
                    } else {
                        showNotification('Error al actualizar la agenda: ' + (response.data.message ||
                            'Error desconocido'), false);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    let errorMessage = 'Error al actualizar la agenda';

                    if (error.response && error.response.data) {
                        if (error.response.data.message) {
                            errorMessage = error.response.data.message;
                        } else if (error.response.data.errors) {
                            const firstError = Object.values(error.response.data.errors)[0][0];
                            errorMessage = firstError;
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
                        const row = document.getElementById(`agenda-row-${uuid}`);
                        if (row) {
                            row.remove();
                        }
                        showNotification('¡Agenda eliminada correctamente!', true);
                    } else {
                        showNotification('Error al eliminar la agenda: ' + (response.data.message ||
                            'Error desconocido'), false);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    let errorMessage = 'Error al eliminar la agenda';

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

        // Cerrar modales al hacer click fuera del contenido
        document.addEventListener('click', function(e) {
            if (e.target === descriptionModal) closeDescriptionModal();
            if (e.target === deleteModal) closeDeleteModal();
            if (e.target === editModal) closeEditModal();
        });

        // Cerrar modales con tecla ESC
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeDescriptionModal();
                closeDeleteModal();
                closeEditModal();
            }
        });
    </script>
@endpush
