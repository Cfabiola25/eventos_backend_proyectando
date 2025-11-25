<!-- Modal -->
<div id="programModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 overflow-y-auto h-full w-full z-50 flex items-center justify-center">
    <div class="relative bg-white rounded-lg shadow-2xl w-full max-w-2xl mx-4 transform transition-all">
        <!-- Header del Modal -->
        <div class="bg-primary-600 text-white px-6 py-4 rounded-t-lg flex justify-between items-center">
            <h3 id="modalTitle" class="text-xl font-bold flex items-center">
                <i class="fas fa-list-alt mr-2"></i>
                Crear Programa
            </h3>
            <button onclick="closeModal()" class="text-white hover:text-gray-200 transition-colors">
                <i class="fas fa-times text-2xl"></i>
            </button>
        </div>

        <!-- Cuerpo del Modal -->
        <form id="programForm" class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Nombre -->
                <div class="col-span-1">
                    <label for="name" class="block text-sm font-semibold text-gray-700 mb-2 cursor-pointer">
                        <i class="fas fa-tag text-primary-600 mr-1"></i>
                        Nombre del Programa <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                        id="name"
                        name="name"
                        required
                        maxlength="255"
                        placeholder="Ingrese el nombre del programa"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all">
                </div>

                <!-- Color -->
                <div class="col-span-1">
                    <label for="color" class="block text-sm font-semibold text-gray-700 mb-2 cursor-pointer">
                        <i class="fas fa-palette text-primary-600 mr-1"></i>
                        Color <span class="text-red-500">*</span>
                    </label>
                    <div class="flex items-center space-x-3">
                        <input type="color"
                            id="color"
                            name="color"
                            required
                            value="#3b82f6"
                            class="w-16 h-10 border border-gray-300 rounded-lg cursor-pointer">
                        <div class="flex-1">
                            <input type="text"
                                id="colorText"
                                value="#3b82f6"
                                readonly
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-50 text-sm font-mono">
                        </div>
                    </div>
                    <div class="mt-2 flex items-center space-x-3">
                        <div class="flex items-center space-x-2">
                            <div id="colorPreview" class="w-6 h-6 rounded border border-gray-300" style="background-color: #3b82f6"></div>
                            <span id="colorValue" class="text-xs font-mono text-gray-600">#3B82F6</span>
                        </div>
                    </div>
                </div>

                <!-- Descripción -->
                <div class="col-span-2">
                    <label for="description" class="block text-sm font-semibold text-gray-700 mb-2 cursor-pointer">
                        <i class="fas fa-align-left text-primary-600 mr-1"></i>
                        Descripción
                    </label>
                    <textarea
                        id="description"
                        name="description"
                        rows="3"
                        maxlength="500"
                        placeholder="Ingrese una descripción del programa (opcional)"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all resize-none"></textarea>
                    <p class="text-xs text-gray-500 mt-1">
                        <i class="fas fa-info-circle mr-1"></i>
                        Máximo 500 caracteres
                    </p>
                </div>

                <!-- Estado -->
                <div class="col-span-2">
                    <label class="flex items-center space-x-3 cursor-pointer">
                        <input type="checkbox"
                            id="is_active"
                            name="is_active"
                            class="w-4 h-4 text-primary-600 bg-gray-100 border-gray-300 rounded focus:ring-primary-500 focus:ring-2">
                        <span class="text-sm font-semibold text-gray-700">
                            <i class="fas fa-toggle-on text-primary-600 mr-1"></i>
                            Programa Activo
                        </span>
                    </label>
                    <p class="text-xs text-gray-500 mt-1 ml-7">
                        <i class="fas fa-info-circle mr-1"></i>
                        Si está activo, el programa estará disponible para su uso
                    </p>
                </div>
            </div>

            <!-- Información adicional -->
            <div class="mt-6 p-4 bg-blue-50 rounded-lg border border-blue-200">
                <div class="flex items-start">
                    <i class="fas fa-info-circle text-blue-600 mt-1 mr-2"></i>
                    <div class="text-sm text-blue-800">
                        <p class="font-semibold mb-1">Información importante:</p>
                        <ul class="list-disc list-inside space-y-1 text-xs">
                            <li>El nombre debe ser único</li>
                            <li>El color se utilizará para identificar visualmente el programa</li>
                            <li>Los programas inactivos no estarán disponibles para nuevos eventos</li>
                            <li>Puedes cambiar el estado en cualquier momento</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Botones de Acción -->
            <div class="flex justify-end space-x-3 mt-6 pt-4 border-t border-gray-200">
                <button type="button"
                        onclick="closeModal()"
                        class="px-6 py-2.5 bg-gray-500 text-white font-semibold rounded-lg hover:bg-gray-600 transition-colors duration-300 flex items-center">
                    <i class="fas fa-times mr-2"></i>
                    Cancelar
                </button>
                <button type="submit"
                        id="btnSubmit"
                        class="px-6 py-2.5 bg-primary-600 text-white font-semibold rounded-lg hover:bg-primary-700 transition-colors duration-300 flex items-center shadow-lg">
                    <i class="fas fa-save mr-2"></i>
                    Crear
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Actualizar previsualización de color
    document.getElementById('color').addEventListener('input', function(e) {
        const color = e.target.value;
        document.getElementById('colorPreview').style.backgroundColor = color;
        document.getElementById('colorValue').textContent = color.toUpperCase();
        document.getElementById('colorText').value = color.toUpperCase();
    });

    // Sincronizar input de texto con input de color
    document.getElementById('colorText').addEventListener('input', function(e) {
        const color = e.target.value;
        if (/^#[0-9A-F]{6}$/i.test(color)) {
            document.getElementById('color').value = color;
            document.getElementById('colorPreview').style.backgroundColor = color;
            document.getElementById('colorValue').textContent = color.toUpperCase();
        }
    });
</script>