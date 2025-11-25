@extends('layouts.app')

@section('content')
<div class="w-full px-4 py-6 mx-auto mt-16">
    <!-- Cards de estadísticas -->
    @include('programs.components.cards', [
        'totalPrograms' => $totalPrograms,
        'activePrograms' => $activePrograms,
        'inactivePrograms' => $inactivePrograms
    ])

    <!-- Contenedor principal con tabla -->
    <div class="w-full mt-6 bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="p-6">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                <h2 class="text-2xl font-bold text-gray-800">
                    <i class="fas fa-list-alt text-primary-600 mr-2"></i>
                    Lista de Programas
                </h2>

                <div class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
                    <!-- Buscador -->
                    <div class="relative flex-1 sm:flex-initial sm:w-80">
                        <div class="relative">
                            <input type="text"
                                   name="search"
                                   id="searchInput"
                                   placeholder="Buscar por nombre, descripción o UUID..."
                                   class="w-full pl-10 pr-10 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-search text-gray-400"></i>
                            </div>
                            <button type="button"
                                    id="clearSearchBtn"
                                    onclick="clearSearch()"
                                    class="hidden absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Botón Agregar -->
                    <button onclick="openModal()"
                            class="bg-primary-600 hover:bg-primary-700 text-white font-bold py-2.5 px-6 rounded-lg shadow-lg transition duration-300 flex items-center justify-center whitespace-nowrap">
                        <i class="fas fa-plus mr-2"></i> Agregar Programa
                    </button>
                </div>
            </div>

            <!-- Indicador de búsqueda activa -->
            <div id="searchIndicator" class="hidden mb-4 p-3 bg-blue-50 border-l-4 border-blue-500 rounded flex items-center justify-between">
                <div class="flex items-center">
                    <i class="fas fa-filter text-blue-500 mr-2"></i>
                    <span class="text-sm text-blue-700">
                        Filtrando por: <strong id="searchTerm"></strong>
                    </span>
                </div>
                <button onclick="clearSearch()"
                        class="text-blue-600 hover:text-blue-800 text-sm font-semibold">
                    Limpiar filtro
                </button>
            </div>

            <!-- Tabla -->
            <div id="tableContainer">
                @include('programs.components.table', ['programs' => $programs])
            </div>
        </div>
    </div>

    <!-- Componente de Notificaciones -->
    @include('programs.components.notification')

</div>

<!-- Modal -->
@include('programs.components.dialogbox')

<!-- Modal de Eliminación -->
@include('programs.components.modalDelete')

@endsection

@push('scripts')
<script>
    let isEditMode = false;
    let editingUuid = null;
    let searchTimeout = null;
    let currentSearch = '';
    let currentDeleteUuid = null;

    // NOTIFICACIONES DE SESIÓN
    @if(session('success'))
        showNotification('{{ session('success') }}', 'success');
    @endif

    @if(session('error'))
        showNotification('{{ session('error') }}', 'error');
    @endif

    // BÚSQUEDA CON AXIOS
    document.getElementById('searchInput').addEventListener('input', function(e) {
        clearTimeout(searchTimeout);
        const searchValue = e.target.value;

        searchTimeout = setTimeout(() => {
            performSearch(searchValue);
        }, 300);
    });

    function performSearch(searchValue, page = 1) {
        currentSearch = searchValue;
        updateSearchIndicator(searchValue);

        axios.get(`/programs/search`, {
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

    function updateStatsCards(stats) {
        const totalCard = document.getElementById('totalProgramsCount');
        const activeCard = document.getElementById('activeProgramsCount');
        const inactiveCard = document.getElementById('inactiveProgramsCount');

        if (totalCard) {
            const currentValue = parseInt(totalCard.textContent) || 0;
            animateValue(totalCard, currentValue, stats.total, 500);
        }

        if (activeCard) {
            const currentValue = parseInt(activeCard.textContent) || 0;
            animateValue(activeCard, currentValue, stats.active, 500);
        }

        if (inactiveCard) {
            const currentValue = parseInt(inactiveCard.textContent) || 0;
            animateValue(inactiveCard, currentValue, stats.inactive, 500);
        }
    }

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

    function initializePaginationEvents() {
        document.querySelectorAll('.pagination-link').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const page = this.dataset.page;
                performSearch(currentSearch, page);
            });
        });
    }

    function clearSearch() {
        document.getElementById('searchInput').value = '';
        currentSearch = '';
        performSearch('');
    }

    // MODAL FUNCTIONS
    function openModal() {
        isEditMode = false;
        editingUuid = null;
        document.getElementById('programModal').classList.remove('hidden');
        document.getElementById('modalTitle').innerHTML = '<i class="fas fa-list-alt mr-2"></i>Crear Programa';
        document.getElementById('btnSubmit').innerHTML = '<i class="fas fa-save mr-2"></i>Crear';
        document.getElementById('programForm').reset();
        document.getElementById('is_active').checked = true;
        document.getElementById('color').value = '#3b82f6'; // Color por defecto
        updateColorPreview('#3b82f6');
    }

    function closeModal() {
        document.getElementById('programModal').classList.add('hidden');
        document.getElementById('programForm').reset();
        isEditMode = false;
        editingUuid = null;
    }

    // ACTUALIZAR PREVISUALIZACIÓN DE COLOR
    function updateColorPreview(color) {
        const preview = document.getElementById('colorPreview');
        const valueDisplay = document.getElementById('colorValue');
        const colorText = document.getElementById('colorText');
        
        if (preview) {
            preview.style.backgroundColor = color;
        }
        if (valueDisplay) {
            valueDisplay.textContent = color.toUpperCase();
        }
        if (colorText) {
            colorText.value = color.toUpperCase();
        }
    }

    // EDITAR PROGRAMA
    async function editProgram(uuid) {
        try {
            const editButtons = document.querySelectorAll(`button[onclick="editProgram('${uuid}')"]`);
            const editButton = editButtons[0];
            const originalContent = editButton.innerHTML;
            editButton.disabled = true;
            editButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';

            const response = await axios.get(`/programs/${uuid}/edit`);
            const data = response.data;

            if (data.success) {
                isEditMode = true;
                editingUuid = uuid;

                const program = data.program;
                document.getElementById('name').value = program.name;
                document.getElementById('color').value = program.color;
                document.getElementById('description').value = program.description || '';
                document.getElementById('is_active').checked = program.is_active;

                document.getElementById('modalTitle').innerHTML = '<i class="fas fa-edit mr-2"></i>Editar Programa';
                document.getElementById('btnSubmit').innerHTML = '<i class="fas fa-save mr-2"></i>Actualizar';
                document.getElementById('programModal').classList.remove('hidden');
                
                updateColorPreview(program.color);
            } else {
                showNotification('Error al cargar el programa', 'error');
            }

            editButton.disabled = false;
            editButton.innerHTML = originalContent;

        } catch (error) {
            console.error('Error:', error);
            showNotification('Error al cargar el programa: ' + error.message, 'error');
        }
    }

    // ELIMINAR PROGRAMA
    function confirmDeleteProgram(uuid, name) {
        currentDeleteUuid = uuid;
        document.getElementById('delete-program-name').textContent = name;
        document.getElementById('delete-modal').classList.remove('hidden');
    }

    async function executeDelete() {
        if (!currentDeleteUuid) return;

        const deleteButton = document.querySelector('#delete-modal button[onclick="executeDelete()"]');
        const originalText = deleteButton.innerHTML;
        deleteButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Eliminando...';
        deleteButton.disabled = true;

        try {
            const response = await axios.delete(`/programs/${currentDeleteUuid}`);
            const data = response.data;

            if (data.success) {
                showNotification(data.message, 'success');
                closeDeleteModal();
                performSearch(currentSearch);
            } else {
                showNotification(data.message || 'Error al eliminar', 'error');
                deleteButton.innerHTML = originalText;
                deleteButton.disabled = false;
            }
        } catch (error) {
            console.error('Error:', error);
            showNotification('Error al eliminar el programa: ' + error.message, 'error');
            deleteButton.innerHTML = originalText;
            deleteButton.disabled = false;
        }
    }

    function closeDeleteModal() {
        document.getElementById('delete-modal').classList.add('hidden');
        currentDeleteUuid = null;
        
        const deleteButton = document.querySelector('#delete-modal button[onclick="executeDelete()"]');
        if (deleteButton) {
            deleteButton.innerHTML = '<i class="fas fa-trash-alt mr-2"></i> Eliminar Programa';
            deleteButton.disabled = false;
        }
    }

    // TOGGLE DE ESTADO - CORREGIDO
    function toggleProgramStatus(uuid) {
        console.log('Cambiando estado del programa:', uuid);
        
        axios.post(`/programs/${uuid}/toggle-status`)
            .then(response => {
                const data = response.data;
                if (data.success) {
                    showNotification(data.message, 'success');
                    // Forzar actualización de la tabla
                    performSearch(currentSearch);
                } else {
                    showNotification(data.message || 'Error al cambiar el estado', 'error');
                }
            })
            .catch(error => {
                console.error('Error en toggle:', error);
                if (error.response) {
                    console.error('Respuesta de error:', error.response.data);
                    showNotification(error.response.data.message || 'Error al cambiar el estado', 'error');
                } else {
                    showNotification('Error de conexión al cambiar el estado', 'error');
                }
            });
    }

    // SUBMIT DEL FORMULARIO
    document.getElementById('programForm').addEventListener('submit', async function(e) {
        e.preventDefault();

        const submitBtn = document.getElementById('btnSubmit');
        const originalBtnContent = submitBtn.innerHTML;

        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Procesando...';

        const formData = new FormData(this);
        const data = {
            name: document.getElementById('name').value,
            color: document.getElementById('color').value,
            description: document.getElementById('description').value,
            is_active: document.getElementById('is_active').checked ? 1 : 0
        };

        try {
            let url = '/programs';
            let method = 'post';

            if (isEditMode) {
                url = `/programs/${editingUuid}`;
                method = 'put';
            }

            const response = await axios({
                method: method,
                url: url,
                data: data
            });

            const result = response.data;

            if (result.success) {
                showNotification(result.message, 'success');
                closeModal();
                performSearch(currentSearch);
                isEditMode = false;
                editingUuid = null;
            } else {
                if (result.errors) {
                    const errorMessages = Object.values(result.errors).flat();
                    showNotification(errorMessages.join('\n'), 'error');
                } else {
                    showNotification(result.message || 'Error al procesar la solicitud', 'error');
                }
            }
        } catch (error) {
            console.error('Error:', error);
            if (error.response && error.response.data.errors) {
                const errorMessages = Object.values(error.response.data.errors).flat();
                showNotification(errorMessages.join('\n'), 'error');
            } else {
                showNotification('Error al procesar la solicitud: ' + error.message, 'error');
            }
        } finally {
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalBtnContent;
        }
    });

    // SISTEMA DE NOTIFICACIONES
    function showNotification(message, type) {
        const notification = document.getElementById('notification');
        const icon = document.getElementById('notificationIcon');
        const messageEl = document.getElementById('notificationMessage');

        if (!notification || !icon || !messageEl) {
            console.error('Elementos de notificación no encontrados');
            return;
        }

        messageEl.textContent = message;

        // Limpiar clases anteriores
        notification.classList.remove('border-green-500', 'border-red-500', 'border-blue-500', 'hidden');
        icon.classList.remove('fa-check-circle', 'fa-exclamation-circle', 'fa-info-circle', 'text-green-500', 'text-red-500', 'text-blue-500');

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

    function closeNotification() {
        const notification = document.getElementById('notification');
        if (notification) {
            notification.classList.add('hidden');
        }
    }

    // EVENT LISTENERS GLOBALES
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            const modal = document.getElementById('programModal');
            if (!modal.classList.contains('hidden')) {
                closeModal();
            }

            const deleteModal = document.getElementById('delete-modal');
            if (!deleteModal.classList.contains('hidden')) {
                closeDeleteModal();
            }
        }

        if ((e.ctrlKey || e.metaKey) && e.key === 's') {
            const modal = document.getElementById('programModal');
            if (!modal.classList.contains('hidden')) {
                e.preventDefault();
                document.getElementById('programForm').dispatchEvent(new Event('submit'));
            }
        }
    });

    // Actualizar previsualización de color en tiempo real
    document.getElementById('color')?.addEventListener('input', function(e) {
        updateColorPreview(e.target.value);
    });

    document.getElementById('programModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeModal();
        }
    });

    document.getElementById('delete-modal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeDeleteModal();
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
        initializePaginationEvents();
        
        // Inicializar el color por defecto
        updateColorPreview('#3b82f6');
    });
</script>
@endpush