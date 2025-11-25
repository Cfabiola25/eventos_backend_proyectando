@extends('layouts.app')

@section('content')
<div @class(['w-full', 'px-4', 'py-6', 'mx-auto', 'mt-16'])>
    <!-- Cards de estadísticas -->
    @include('tag.components.cards', ['totalTags' => $totalTags])

    <!-- Contenedor principal con tabla -->
    <div @class(['w-full', 'mt-6', 'bg-white', 'rounded-lg', 'shadow-lg', 'overflow-hidden'])>
        <div @class(['p-6'])>
            <div @class(['flex', 'flex-col', 'sm:flex-row', 'justify-between', 'items-start', 'sm:items-center', 'mb-6', 'gap-4'])>
                <h2 @class(['text-2xl', 'font-bold', 'text-gray-800'])>
                    <i @class(['fas', 'fa-tags', 'text-primary-600', 'mr-2'])></i>
                    Lista de Etiquetas
                </h2>

                <div @class(['flex', 'flex-col', 'sm:flex-row', 'gap-3', 'w-full', 'sm:w-auto'])>
                    <!-- Buscador -->
                    <div @class(['relative', 'flex-1', 'sm:flex-initial', 'sm:w-80'])>
                        <div @class(['relative'])>
                            <input type="text"
                                name="search"
                                id="searchInput"
                                placeholder="Buscar..."
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
                    <button id="btnOpenModal"
                            @class(['bg-primary-600', 'hover:bg-primary-700', 'text-white', 'font-bold', 'py-2.5', 'px-6', 'rounded-lg', 'shadow-lg', 'transition', 'duration-300', 'flex', 'items-center', 'justify-center', 'whitespace-nowrap'])>
                        <i @class(['fas', 'fa-plus', 'mr-2'])></i> Agregar Etiqueta
                    </button>
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
                @include('tag.components.table', ['tags' => $tags])
            </div>
        </div>
    </div>

    <!-- Modal para crear/editar -->
    @include('tag.components.dialogbox')

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
    let isEditMode = false;
    let currentUuid = null;
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

    // Función para la búsqueda
    function performSearch(searchValue, page = 1) {
        currentSearch = searchValue;

        // Actualizar indicador de búsqueda
        updateSearchIndicator(searchValue);

        fetch(`/tags/search?search=${encodeURIComponent(searchValue)}&page=${page}`, {
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Actualizar la tabla con los resultados
                document.getElementById('tableContainer').innerHTML = data.html;

                // Reinicializar eventos de paginación
                initializePaginationEvents();
            }
        })
        .catch(error => {
            console.error('Error en la búsqueda:', error);
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

    // Abrir modal para crear
    document.getElementById('btnOpenModal').addEventListener('click', function() {
        isEditMode = false;
        currentUuid = null;
        document.getElementById('modalTitle').textContent = 'Crear Etiqueta';
        document.getElementById('btnSubmit').textContent = 'Crear';
        document.getElementById('tagForm').reset();
        document.getElementById('color').value = '#EF4444';
        updateColorPreview('#EF4444');
        document.getElementById('tagModal').classList.remove('hidden');
        document.getElementById('tagModal').classList.add('flex');
    });

    // Cerrar modal
    function closeModal() {
        document.getElementById('tagModal').classList.add('hidden');
        document.getElementById('tagModal').classList.remove('flex');
        document.getElementById('tagForm').reset();
    }

    // Actualizar previsualización de color
    function updateColorPreview(color) {
        document.getElementById('colorPreview').style.backgroundColor = color;
        document.getElementById('colorValue').textContent = color;
    }

    // Event listener para cambio de color
    document.getElementById('color').addEventListener('input', function(e) {
        updateColorPreview(e.target.value);
    });

    // Abrir modal para editar
    function editTag(uuid) {
        isEditMode = true;
        currentUuid = uuid;

        fetch(`/tags/${uuid}/edit`, {
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('modalTitle').textContent = 'Editar Etiqueta';
                document.getElementById('btnSubmit').textContent = 'Actualizar';
                document.getElementById('name').value = data.data.name;
                document.getElementById('color').value = data.data.color;
                document.getElementById('description').value = data.data.description || '';
                updateColorPreview(data.data.color);

                document.getElementById('tagModal').classList.remove('hidden');
                document.getElementById('tagModal').classList.add('flex');
            }
        })
        .catch(error => {
            showNotification('Error al cargar los datos', 'error');
        });
    }

    // Enviar formulario
    document.getElementById('tagForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const formData = new FormData(this);
        const url = isEditMode ? `/tags/${currentUuid}` : '/tags';
        const method = isEditMode ? 'PUT' : 'POST';

        const data = {
            name: formData.get('name'),
            color: formData.get('color'),
            description: formData.get('description')
        };

        fetch(url, {
            method: method,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showNotification(data.message, 'success');
                closeModal();
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

    // Eliminar etiqueta
    function deleteTag(uuid) {
        if (!confirm('¿Está seguro de eliminar esta etiqueta?')) {
            return;
        }

        fetch(`/tags/${uuid}`, {
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
                showNotification(data.message, 'error');
            }
        })
        .catch(error => {
            showNotification('Error al eliminar', 'error');
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