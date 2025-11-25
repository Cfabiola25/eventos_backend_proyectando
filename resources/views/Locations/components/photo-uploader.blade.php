<div class="photo-uploader-container">
    <label class="block text-sm font-semibold text-gray-700 mb-2">
        <i class="fas fa-image text-primary-600 mr-1"></i>
        Imagen de la Ubicación
    </label>

    <div class="flex flex-col items-center justify-center w-full">
        <!-- Vista previa de la imagen -->
        <div id="imagePreviewContainer" class="mb-4 {{ isset($currentImage) && $currentImage ? '' : 'hidden' }}">
            <div class="relative group">
                <img id="imagePreview"
                    src="{{ isset($currentImage) && $currentImage ? asset('storage/' . $currentImage) : '' }}"
                    alt="Vista previa"
                    class="w-full max-w-md h-64 object-cover rounded-lg shadow-md border-2 border-gray-200">
                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-40 transition-all duration-300 rounded-lg flex items-center justify-center">
                    <button type="button"
                            id="removeImageBtn"
                            class="opacity-0 group-hover:opacity-100 transition-opacity duration-300 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                        <i class="fas fa-trash mr-2"></i>
                        Eliminar
                    </button>
                </div>
            </div>
            <p class="text-sm text-gray-500 text-center mt-2">
                <i class="fas fa-info-circle mr-1"></i>
                Pasa el mouse sobre la imagen para cambiarla o eliminarla
            </p>
        </div>

        <!-- Área de carga -->
        <label for="imageInput"
                id="dropZone"
                class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition-colors {{ isset($currentImage) && $currentImage ? 'hidden' : '' }}">
            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                <i class="fas fa-cloud-upload-alt text-6xl text-gray-400 mb-4"></i>
                <p class="mb-2 text-sm text-gray-500">
                    <span class="font-semibold">Click para cargar</span> o arrastra y suelta
                </p>
                <p class="text-xs text-gray-500">PNG, JPG, JPEG o WEBP (MAX. 2MB)</p>
            </div>
            <input id="imageInput"
                type="file"
                name="image"
                class="hidden"
                accept="image/png,image/jpeg,image/jpg,image/webp">
        </label>
    </div>

    @error('image')
        <span class="text-red-500 text-sm mt-2 block">{{ $message }}</span>
    @enderror
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const imageInput = document.getElementById('imageInput');
    const imagePreview = document.getElementById('imagePreview');
    const imagePreviewContainer = document.getElementById('imagePreviewContainer');
    const dropZone = document.getElementById('dropZone');
    const removeImageBtn = document.getElementById('removeImageBtn');

    // Manejar selección de archivo
    imageInput.addEventListener('change', function(e) {
        handleImageUpload(e.target.files[0]);
    });

    // Drag and Drop
    dropZone.addEventListener('dragover', function(e) {
        e.preventDefault();
        dropZone.classList.add('border-primary-500', 'bg-primary-50');
    });

    dropZone.addEventListener('dragleave', function(e) {
        e.preventDefault();
        dropZone.classList.remove('border-primary-500', 'bg-primary-50');
    });

    dropZone.addEventListener('drop', function(e) {
        e.preventDefault();
        dropZone.classList.remove('border-primary-500', 'bg-primary-50');

        const file = e.dataTransfer.files[0];
        if (file && file.type.startsWith('image/')) {
            handleImageUpload(file);
            // Asignar el archivo al input
            const dataTransfer = new DataTransfer();
            dataTransfer.items.add(file);
            imageInput.files = dataTransfer.files;
        }
    });

    // Función para manejar la carga de imagen
    function handleImageUpload(file) {
        if (!file) return;

        // Validar tipo de archivo
        const validTypes = ['image/png', 'image/jpeg', 'image/jpg', 'image/webp'];
        if (!validTypes.includes(file.type)) {
            alert('Por favor selecciona una imagen válida (PNG, JPG, JPEG o WEBP)');
            return;
        }

        // Validar tamaño (2MB)
        if (file.size > 2 * 1024 * 1024) {
            alert('La imagen no debe superar los 2MB');
            return;
        }

        // Mostrar vista previa
        const reader = new FileReader();
        reader.onload = function(e) {
            imagePreview.src = e.target.result;
            imagePreviewContainer.classList.remove('hidden');
            dropZone.classList.add('hidden');
        };
        reader.readAsDataURL(file);
    }

    // Eliminar imagen
    removeImageBtn.addEventListener('click', function(e) {
        e.preventDefault();
        imagePreview.src = '';
        imageInput.value = '';
        imagePreviewContainer.classList.add('hidden');
        dropZone.classList.remove('hidden');
    });
});
</script>
@endpush