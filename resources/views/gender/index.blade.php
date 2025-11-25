@extends('layouts.app')

@section('content')
    <div @class(['w-full', 'px-4', 'py-6', 'mx-auto', 'mt-16'])>
        <!-- Cards de estadísticas - FIJAS -->
        <div id="cardsContainer" class="sticky top-4 z-10 bg-gray-50 rounded-lg p-4 mb-6 transition-all duration-300">
            @include('gender.components.cards', [
                'total' => $total,
                'activos' => $activos,
                'inactivos' => $inactivos,
            ])
        </div>

        <!-- Contenedor principal con tabla -->
        <div @class([
            'w-full',
            'bg-white',
            'rounded-lg',
            'shadow-lg',
            'overflow-hidden',
        ])>
            <div @class(['p-6'])>
                <div @class([
                    'flex',
                    'flex-col',
                    'sm:flex-row',
                    'justify-between',
                    'items-start',
                    'sm:items-center',
                    'mb-6',
                    'gap-4',
                ])>
                    <h2 @class(['text-2xl', 'font-bold', 'text-gray-800'])>
                        <i @class(['fas', 'fa-venus-mars', 'text-primary-600', 'mr-2'])></i>
                        Lista de Géneros
                    </h2>

                    <div @class([
                        'flex',
                        'flex-col',
                        'sm:flex-row',
                        'gap-3',
                        'w-full',
                        'sm:w-auto',
                    ])>
                        <!-- Buscador -->
                        <div @class(['relative', 'flex-1', 'sm:flex-initial', 'sm:w-80'])>
                            <div @class(['relative'])>
                                <input type="text" name="search" id="searchInput" placeholder="Buscar..."
                                    @class([
                                        'w-full',
                                        'pl-10',
                                        'pr-10',
                                        'py-2.5',
                                        'border',
                                        'border-gray-300',
                                        'rounded-lg',
                                        'focus:ring-2',
                                        'focus:ring-primary-500',
                                        'focus:border-transparent',
                                        'transition-all',
                                    ])>
                                <div @class([
                                    'absolute',
                                    'inset-y-0',
                                    'left-0',
                                    'pl-3',
                                    'flex',
                                    'items-center',
                                    'pointer-events-none',
                                ])>
                                    <i @class(['fas', 'fa-search', 'text-gray-400'])></i>
                                </div>
                                <button type="button" id="clearSearchBtn" onclick="clearSearch()"
                                    @class([
                                        'hidden',
                                        'absolute',
                                        'inset-y-0',
                                        'right-0',
                                        'pr-3',
                                        'flex',
                                        'items-center',
                                        'text-gray-400',
                                        'hover:text-gray-600',
                                    ])>
                                    <i @class(['fas', 'fa-times'])></i>
                                </button>
                            </div>
                        </div>

                        <!-- Botón Agregar -->
                        <button id="btnOpenModal" @class([
                            'bg-primary-600',
                            'hover:bg-primary-700',
                            'text-white',
                            'font-bold',
                            'py-2.5',
                            'px-6',
                            'rounded-lg',
                            'shadow-lg',
                            'transition',
                            'duration-300',
                            'flex',
                            'items-center',
                            'justify-center',
                            'whitespace-nowrap',
                        ])>
                            <i @class(['fas', 'fa-plus', 'mr-2'])></i> Agregar Género
                        </button>
                    </div>
                </div>

                <!-- Indicador de búsqueda activa -->
                <div id="searchIndicator" @class([
                    'hidden',
                    'mb-4',
                    'p-3',
                    'bg-blue-50',
                    'border-l-4',
                    'border-blue-500',
                    'rounded',
                    'flex',
                    'items-center',
                    'justify-between',
                ])>
                    <div @class(['flex', 'items-center'])>
                        <i @class(['fas', 'fa-filter', 'text-blue-500', 'mr-2'])></i>
                        <span @class(['text-sm', 'text-blue-700'])>
                            Filtrando por: <strong id="searchTerm"></strong>
                        </span>
                    </div>
                    <button onclick="clearSearch()" @class([
                        'text-blue-600',
                        'hover:text-blue-800',
                        'text-sm',
                        'font-semibold',
                    ])>
                        Limpiar filtro
                    </button>
                </div>

                <!-- Tabla - ÚNICO ELEMENTO QUE SE ACTUALIZA -->
                <div id="tableContainer">
                    @include('gender.components.table', ['genders' => $genders])
                </div>
            </div>
        </div>

        <!-- Modal para crear/editar -->
        @include('gender.components.dialogbox')

        <!-- Modal de confirmación de eliminación -->
        @include('gender.components.delete-confirm-modal')

        <!-- Notificaciones -->
        <div id="notification" @class([
            'hidden',
            'fixed',
            'top-20',
            'right-4',
            'z-50',
            'bg-white',
            'border-l-4',
            'border-green-500',
            'rounded-lg',
            'shadow-xl',
            'p-4',
            'max-w-md',
            'transform',
            'transition-all',
            'duration-300',
        ])>
            <div @class(['flex', 'items-center'])>
                <div @class(['flex-shrink-0'])>
                    <i id="notificationIcon" @class(['fas', 'fa-check-circle', 'text-green-500', 'text-2xl'])></i>
                </div>
                <div @class(['ml-3'])>
                    <p id="notificationMessage" @class(['text-sm', 'font-medium', 'text-gray-900'])></p>
                </div>
                <button onclick="closeNotification()" @class([
                    'ml-auto',
                    '-mx-1.5',
                    '-my-1.5',
                    'text-gray-400',
                    'hover:text-gray-900',
                    'rounded-lg',
                    'p-1.5',
                    'inline-flex',
                    'h-8',
                    'w-8',
                ])>
                    <i @class(['fas', 'fa-times'])></i>
                </button>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        let isEditMode = false;
        let currentUuid = null;
        let deleteUuid = null;
        let deleteGenderName = '';
        let searchTimeout = null;
        let currentSearch = '';

        // Búsqueda con AJAX
        document.getElementById('searchInput').addEventListener('input', function(e) {
            clearTimeout(searchTimeout);
            const searchValue = e.target.value;

            searchTimeout = setTimeout(() => {
                performSearch(searchValue);
            }, 300);
        });

        // Función para la búsqueda - SOLO ACTUALIZA LA TABLA
        function performSearch(searchValue, page = 1) {
            currentSearch = searchValue;

            // Mostrar loading solo en la tabla
            document.getElementById('tableContainer').innerHTML = `
            <div class="flex justify-center items-center py-20">
                <div class="text-center">
                    <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-primary-600 mx-auto mb-4"></div>
                    <span class="text-gray-600 font-medium">Buscando géneros...</span>
                </div>
            </div>
        `;

            // Actualizar indicador de búsqueda
            updateSearchIndicator(searchValue);

            // Usar Axios para la petición
            axios.get('/genders/search', {
                    params: {
                        search: searchValue,
                        page: page
                    }
                })
                .then(response => {
                    const data = response.data;
                    if (data.success) {
                        // Actualizar solo la tabla
                        document.getElementById('tableContainer').innerHTML = data.table_html;

                        // Actualizar las cards SIN redibujar el contenedor
                        updateCards(data.stats);

                        // Reinicializar eventos de paginación
                        initializePaginationEvents();
                    } else {
                        throw new Error(data.message);
                    }
                })
                .catch(error => {
                    console.error('Error en la búsqueda:', error);
                    document.getElementById('tableContainer').innerHTML = `
                <div class="text-center py-20 text-red-600">
                    <i class="fas fa-exclamation-triangle text-4xl mb-3"></i>
                    <p class="font-medium text-lg">Error al cargar los datos</p>
                    <p class="text-sm text-gray-500 mt-1">Por favor, intenta nuevamente</p>
                </div>
            `;
                });
        }

        // Función para actualizar las cards SIN redibujar el contenedor
        function updateCards(stats) {
            if (!stats) return;

            // Actualizar los valores numéricos directamente
            const totalElement = document.getElementById('cardTotal');
            const activosElement = document.getElementById('cardActivos');
            const inactivosElement = document.getElementById('cardInactivos');

            if (totalElement && stats.total !== undefined) {
                animateValue(totalElement, parseInt(totalElement.textContent), stats.total, 500);
            }

            if (activosElement && stats.activos !== undefined) {
                animateValue(activosElement, parseInt(activosElement.textContent), stats.activos, 500);
            }

            if (inactivosElement && stats.inactivos !== undefined) {
                animateValue(inactivosElement, parseInt(inactivosElement.textContent), stats.inactivos, 500);
            }
        }

        // Función para animar el cambio de valores numéricos
        function animateValue(element, start, end, duration) {
            let startTimestamp = null;
            const step = (timestamp) => {
                if (!startTimestamp) startTimestamp = timestamp;
                const progress = Math.min((timestamp - startTimestamp) / duration, 1);
                const value = Math.floor(progress * (end - start) + start);
                element.textContent = value;
                if (progress < 1) {
                    window.requestAnimationFrame(step);
                }
            };
            window.requestAnimationFrame(step);
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
                    const page = this.getAttribute('data-page');
                    if (page) {
                        performSearch(currentSearch, page);
                    }
                });
            });
        }

        // Limpiar búsqueda
        function clearSearch() {
            document.getElementById('searchInput').value = '';
            currentSearch = '';
            performSearch('');
        }

        // Abrir modal para crear
        document.getElementById('btnOpenModal').addEventListener('click', function() {
            isEditMode = false;
            currentUuid = null;
            document.getElementById('modalTitle').textContent = 'Crear Género';
            document.getElementById('btnSubmit').textContent = 'Crear';
            document.getElementById('genderForm').reset();
            document.getElementById('is_active').checked = true;
            document.getElementById('genderModal').classList.remove('hidden');
            document.getElementById('genderModal').classList.add('flex');
        });

        // Cerrar modal
        function closeModal() {
            document.getElementById('genderModal').classList.add('hidden');
            document.getElementById('genderModal').classList.remove('flex');
            document.getElementById('genderForm').reset();
        }

        // Abrir modal para editar
        function editGender(uuid) {
            isEditMode = true;
            currentUuid = uuid;

            axios.get(`/genders/${uuid}/edit`)
                .then(response => {
                    const data = response.data;
                    if (data.success) {
                        document.getElementById('modalTitle').textContent = 'Editar Género';
                        document.getElementById('btnSubmit').textContent = 'Actualizar';
                        document.getElementById('name').value = data.data.name;
                        document.getElementById('is_active').checked = data.data.is_active;

                        document.getElementById('genderModal').classList.remove('hidden');
                        document.getElementById('genderModal').classList.add('flex');
                    }
                })
                .catch(error => {
                    showNotification('Error al cargar los datos', 'error');
                });
        }

        // Enviar formulario
        document.getElementById('genderForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);
            const url = isEditMode ? `/genders/${currentUuid}` : '/genders';
            const method = isEditMode ? 'put' : 'post';

            const data = {
                name: formData.get('name'),
                is_active: document.getElementById('is_active').checked ? 1 : 0
            };

            axios({
                    method: method,
                    url: url,
                    data: data,
                    headers: {
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => {
                    const data = response.data;
                    if (data.success) {
                        showNotification(data.message, 'success');
                        closeModal();
                        // Recargar solo la tabla después de crear/editar
                        setTimeout(() => {
                            performSearch(currentSearch);
                        }, 1500);
                    } else {
                        showNotification(data.message, 'error');
                    }
                })
                .catch(error => {
                    showNotification('Error al procesar la solicitud', 'error');
                });
        });

        // Abrir modal de confirmación de eliminación
        function deleteGender(uuid, name = '') {
            deleteUuid = uuid;
            deleteGenderName = name;

            document.getElementById('genderNameToDelete').textContent = name || 'este género';
            document.getElementById('deleteConfirmModal').classList.remove('hidden');
            document.getElementById('deleteConfirmModal').classList.add('flex');
        }

        // Cerrar modal de eliminación
        function closeDeleteModal() {
            document.getElementById('deleteConfirmModal').classList.add('hidden');
            document.getElementById('deleteConfirmModal').classList.remove('flex');
            deleteUuid = null;
            deleteGenderName = '';
        }

        // Confirmar eliminación
        function confirmDelete() {
            if (!deleteUuid) {
                showNotification('Error: No se especificó el género a eliminar', 'error');
                closeDeleteModal();
                return;
            }

            // Deshabilitar el botón durante la eliminación
            const deleteBtn = document.getElementById('confirmDeleteBtn');
            const originalText = deleteBtn.innerHTML;
            deleteBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Eliminando...';
            deleteBtn.disabled = true;

            axios.delete(`/genders/${deleteUuid}`)
                .then(response => {
                    const data = response.data;
                    if (data.success) {
                        showNotification(data.message, 'success');
                        closeDeleteModal();
                        // Recargar solo la tabla después de eliminar
                        setTimeout(() => {
                            performSearch(currentSearch);
                        }, 1500);
                    } else {
                        showNotification(data.message, 'error');
                        closeDeleteModal();
                    }
                })
                .catch(error => {
                    console.error('Error al eliminar:', error);
                    showNotification('Error al eliminar el género', 'error');
                    closeDeleteModal();
                })
                .finally(() => {
                    // Restaurar el botón
                    deleteBtn.innerHTML = originalText;
                    deleteBtn.disabled = false;
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

        // Cerrar modal con ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeModal();
                closeDeleteModal();
            }
        });

        // Cerrar modal haciendo click fuera
        document.addEventListener('click', function(e) {
            if (e.target.id === 'genderModal') {
                closeModal();
            }
            if (e.target.id === 'deleteConfirmModal') {
                closeDeleteModal();
            }
        });

        // Inicializar eventos de paginación al cargar
        document.addEventListener('DOMContentLoaded', function() {
            initializePaginationEvents();
        });
    </script>
@endpush
