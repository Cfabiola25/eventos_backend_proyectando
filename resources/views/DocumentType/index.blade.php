@extends('layouts.app')

@section('content')
<div class="w-full px-4 py-6 mx-auto mt-16">
    <!-- Cards de estadísticas -->
    @include('DocumentType.components.cards', [
        'totalDocumentTypes' => $totalDocumentTypes
    ])

    <!-- Contenedor principal con tabla -->
    <div class="w-full mt-6 bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-800">
                    <i class="fas fa-id-card text-primary-600 mr-2"></i>
                    Lista de Tipos de Documento
                </h2>
                <button id="btnOpenModal" class="bg-primary-600 hover:bg-primary-700 text-white font-bold py-2 px-6 rounded-lg shadow-lg transition duration-300 flex items-center">
                    <i class="fas fa-plus mr-2"></i> Agregar Tipo de Documento
                </button>
            </div>

            <!-- Tabla -->
            @include('DocumentType.components.table', ['documentTypes' => $documentTypes])
        </div>
    </div>

    <!-- Modal para crear/editar -->
    @include('DocumentType.components.dialogbox')

    <!-- Notificaciones -->
    <div id="notification" class="hidden fixed top-20 right-4 z-50 bg-white border-l-4 border-green-500 rounded-lg shadow-xl p-4 max-w-md transform transition-all duration-300">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <i id="notificationIcon" class="fas fa-check-circle text-green-500 text-2xl"></i>
            </div>
            <div class="ml-3">
                <p id="notificationMessage" class="text-sm font-medium text-gray-900"></p>
            </div>
            <button onclick="closeNotification()" class="ml-auto -mx-1.5 -my-1.5 text-gray-400 hover:text-gray-900 rounded-lg p-1.5 inline-flex h-8 w-8">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    let isEditMode = false;
    let currentUuid = null;

    // Abrir modal para crear
    document.getElementById('btnOpenModal').addEventListener('click', function() {
        isEditMode = false;
        currentUuid = null;
        document.getElementById('modalTitle').textContent = 'Crear Tipo de Documento';
        document.getElementById('btnSubmit').textContent = 'Crear';
        document.getElementById('documentTypeForm').reset();
        document.getElementById('documentTypeModal').classList.remove('hidden');
        document.getElementById('documentTypeModal').classList.add('flex');
    });

    // Cerrar modal
    function closeModal() {
        document.getElementById('documentTypeModal').classList.add('hidden');
        document.getElementById('documentTypeModal').classList.remove('flex');
        document.getElementById('documentTypeForm').reset();
    }

    // Abrir modal para editar
    function editDocumentType(uuid) {
        isEditMode = true;
        currentUuid = uuid;

        fetch(`/documenttypes/${uuid}/edit`, {
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('modalTitle').textContent = 'Editar Tipo de Documento';
                document.getElementById('btnSubmit').textContent = 'Actualizar';
                document.getElementById('name').value = data.data.name;
                document.getElementById('code').value = data.data.code;

                document.getElementById('documentTypeModal').classList.remove('hidden');
                document.getElementById('documentTypeModal').classList.add('flex');
            }
        })
        .catch(error => {
            showNotification('Error al cargar los datos', 'error');
        });
    }

    // Enviar formulario
    document.getElementById('documentTypeForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const formData = new FormData(this);
        const url = isEditMode ? `/documenttypes/${currentUuid}` : '/documenttypes';
        const method = isEditMode ? 'PUT' : 'POST';

        const data = {
            name: formData.get('name'),
            code: formData.get('code'),
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
                    window.location.reload();
                }, 1500);
            } else {
                showNotification(data.message, 'error');
            }
        })
        .catch(error => {
            showNotification('Error al procesar la solicitud', 'error');
        });
    });

    // Eliminar tipo de documento
    function deleteDocumentType(uuid) {
        if (!confirm('¿Está seguro de eliminar este tipo de documento?')) {
            return;
        }

        fetch(`/documenttypes/${uuid}`, {
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
                    window.location.reload();
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
</script>
@endpush