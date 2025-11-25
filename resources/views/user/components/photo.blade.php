<!-- Columna izquierda - Foto e información básica -->
<div class="flex flex-col lg:flex-row gap-6" style="border: 1px solid red">
    <div class="lg:w-1/3">
        <div class="bg-gray-100 p-4 rounded-lg shadow-inner flex flex-col items-center justify-center mb-6">
            <div class="relative mb-4">
                <div id="photoContainer"
                    class="w-48 h-48 border-2 border-dashed border-gray-300 rounded-lg flex items-center justify-center photo-upload cursor-pointer">
                    <i class="fas fa-camera text-gray-400 text-4xl" id="cameraIcon"></i>
                    <img id="previewImage" class="w-full h-full object-cover rounded-lg hidden" src=""
                        alt="Preview">
                </div>
                <input type="file" id="photoUpload" class="hidden" accept="image/*">
            </div>
            <button type="button" onclick="document.getElementById('photoUpload').click()"
                class="bg-primary-500 text-white px-4 py-2 rounded-lg hover:bg-primary-600 transition-colors">
                <i class="fas fa-upload mr-2"></i> Subir Foto
            </button>
            <p class="text-xs text-gray-500 mt-2 text-center">Formatos: JPG, PNG. Tamaño máximo: 2MB</p>
        </div>
    </div>
</div>