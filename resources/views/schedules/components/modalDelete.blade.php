<!-- Modal de Confirmación para Eliminar Horario -->
<div id="delete-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-md mx-4">
        <!-- Cabecera del modal -->
        <div class="bg-red-600 text-white p-4 rounded-t-lg flex justify-between items-center">
            <h3 class="text-lg font-semibold flex items-center">
                <i class="fas fa-exclamation-triangle mr-2"></i>
                Confirmar Eliminación
            </h3>
            <button onclick="closeDeleteModal()"
                    class="text-white hover:text-gray-200 rounded-full w-8 h-8 flex items-center justify-center transition-colors">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>

        <!-- Cuerpo del modal -->
        <div class="p-6">
            <div class="flex items-center mb-4">
                <div class="flex-shrink-0">
                    <i class="fas fa-clock text-red-500 text-3xl"></i>
                </div>
                <div class="ml-4">
                    <p id="delete-message" class="text-gray-700 font-medium">
                        ¿Está seguro que desea eliminar este horario?
                    </p>
                    <p class="text-sm text-gray-600 mt-1">
                        Horario seleccionado: <span id="delete-schedule-info" class="font-semibold"></span>
                    </p>
                </div>
            </div>

            <div class="bg-red-50 border-l-4 border-red-400 p-4 mb-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-exclamation-triangle text-red-400"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-red-700">
                            <strong>Advertencia:</strong> Esta acción no se puede deshacer. 
                            El horario será eliminado permanentemente del sistema.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Botones -->
            <div class="flex justify-end space-x-3">
                <button type="button"
                        onclick="closeDeleteModal()"
                        class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition-colors flex items-center">
                    <i class="fas fa-times mr-2"></i>
                    Cancelar
                </button>
                <button type="button"
                        onclick="executeDelete()"
                        class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors flex items-center">
                    <i class="fas fa-trash-alt mr-2"></i>
                    Eliminar Horario
                </button>
            </div>
        </div>
    </div>
</div>