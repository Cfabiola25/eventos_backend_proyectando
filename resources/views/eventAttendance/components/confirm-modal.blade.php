<!-- Modal de Confirmación para Cambios -->
<div id="confirm-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-md mx-4">
        <!-- Cabecera del modal -->
        <div class="bg-primary-600 text-white p-4 rounded-t-lg flex justify-between items-center">
            <h3 class="text-lg font-semibold flex items-center">
                <i class="fas fa-exclamation-triangle mr-2"></i>
                Confirmar Asistencia
            </h3>
            <button onclick="closeConfirmModal()"
                    class="text-white hover:text-gray-200 rounded-full w-8 h-8 flex items-center justify-center transition-colors">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>

        <!-- Cuerpo del modal -->
        <div class="p-6">
            <div class="flex items-center mb-4">
                <div class="flex-shrink-0">
                    <i id="confirm-icon" class="fas fa-question-circle text-yellow-500 text-3xl"></i>
                </div>
                <div class="ml-4">
                    <p id="confirm-message" class="text-gray-700 font-medium"></p>
                    <p class="text-sm text-gray-600 mt-1">
                        Usuario: <span id="confirm-user-name" class="font-semibold"></span>
                    </p>
                </div>
            </div>

            <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-info-circle text-yellow-400"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-yellow-700">
                            Esta acción confirmará la asistencia del usuario y registrará la hora de check-in.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Botones -->
            <div class="flex justify-end space-x-3">
                <button type="button"
                        onclick="closeConfirmModal()"
                        class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition-colors">
                    <i class="fas fa-times mr-2"></i>
                    Cancelar
                </button>
                <button type="button"
                        onclick="executeUpdate()"
                        class="px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition-colors flex items-center">
                    <i class="fas fa-user-check mr-2"></i>
                    Confirmar Asistencia
                </button>
            </div>
        </div>
    </div>
</div>