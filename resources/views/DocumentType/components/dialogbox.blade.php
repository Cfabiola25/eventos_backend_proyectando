<!-- Modal -->
<div id="documentTypeModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 overflow-y-auto h-full w-full z-50 items-center justify-center">
    <div class="relative bg-white rounded-lg shadow-2xl w-full max-w-2xl mx-4 transform transition-all">
        <!-- Header del Modal -->
        <div class="bg-primary-600 text-white px-6 py-4 rounded-t-lg flex justify-between items-center">
            <h3 id="modalTitle" class="text-xl font-bold flex items-center">
                <i class="fas fa-id-card mr-2"></i>
                Crear Tipo de Documento
            </h3>
            <button onclick="closeModal()" class="text-white hover:text-gray-200 transition-colors">
                <i class="fas fa-times text-2xl"></i>
            </button>
        </div>

        <!-- Cuerpo del Modal -->
        <form id="documentTypeForm" class="p-6">
            <div class="space-y-4">
                <!-- Campo: Nombre -->
                <div>
                    <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-file-alt text-primary-600 mr-1"></i>
                        Nombre del Documento <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                           id="name"
                           name="name"
                           required
                           placeholder="Ej: Cédula de Ciudadanía, Pasaporte, Tarjeta de Identidad..."
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all">
                    <p class="text-xs text-gray-500 mt-1">
                        <i class="fas fa-info-circle mr-1"></i>
                        Nombre completo del tipo de documento
                    </p>
                </div>

                <!-- Campo: Código -->
                <div>
                    <label for="code" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-code text-primary-600 mr-1"></i>
                        Código <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                           id="code"
                           name="code"
                           required
                           maxlength="10"
                           placeholder="Ej: CC, PAS, TI, CE..."
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all uppercase">
                    <p class="text-xs text-gray-500 mt-1">
                        <i class="fas fa-info-circle mr-1"></i>
                        Código abreviado del documento (máximo 10 caracteres)
                    </p>
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