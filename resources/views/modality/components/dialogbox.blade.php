<!-- Modal -->
<div id="modalityModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 overflow-y-auto h-full w-full z-50 flex items-center justify-center">
    <div class="relative bg-white rounded-lg shadow-2xl w-full max-w-md mx-4 transform transition-all">
        <!-- Header del Modal -->
        <div class="bg-primary-600 text-white px-6 py-4 rounded-t-lg flex justify-between items-center">
            <h3 id="modalTitle" class="text-xl font-bold flex items-center">
                <i class="fas fa-layer-group mr-2"></i>
                Crear Modalidad
            </h3>
            <button onclick="closeModal()" class="text-white hover:text-gray-200 transition-colors">
                <i class="fas fa-times text-2xl"></i>
            </button>
        </div>

        <!-- Cuerpo del Modal -->
        <form id="modalityForm" class="p-6">
            <div class="space-y-6">
                <!-- Nombre -->
                <div>
                    <label for="name" class="block text-sm font-semibold text-gray-700 mb-2 cursor-pointer">
                        <i class="fas fa-tag text-primary-600 mr-1"></i>
                        Nombre de la Modalidad <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                        id="name"
                        name="name"
                        required
                        maxlength="255"
                        placeholder="Ingrese el nombre de la modalidad"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all">
                </div>

                <!-- Estado -->
                <div>
                    <label class="flex items-center space-x-3 cursor-pointer">
                        <input type="checkbox"
                            id="is_active"
                            name="is_active"
                            class="w-4 h-4 text-primary-600 bg-gray-100 border-gray-300 rounded focus:ring-primary-500 focus:ring-2">
                        <span class="text-sm font-semibold text-gray-700">
                            <i class="fas fa-toggle-on text-primary-600 mr-1"></i>
                            Modalidad Activa
                        </span>
                    </label>
                    <p class="text-xs text-gray-500 mt-1 ml-7">
                        <i class="fas fa-info-circle mr-1"></i>
                        Si está activa, la modalidad estará disponible para su uso
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
                            <li>Las modalidades inactivas no estarán disponibles para nuevos eventos</li>
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