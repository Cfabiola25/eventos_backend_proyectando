<!-- Modal de Confirmación para Acciones Masivas de Diplomas - ESTILOS MEJORADOS -->
<div id="mass-diploma-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-md mx-4">
        <!-- Cabecera del modal -->
        <div class="bg-red-600 text-white p-4 rounded-t-lg flex justify-between items-center">
            <h3 class="text-lg font-semibold flex items-center">
                <i class="fas fa-certificate mr-2"></i>
                Confirmar Acción Masiva
            </h3>
            <button onclick="closeMassDiplomaModal()"
                    class="text-white hover:text-gray-200 rounded-full w-8 h-8 flex items-center justify-center transition-colors">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>

        <!-- Cuerpo del modal -->
        <div class="p-6">
            <div class="flex items-center mb-4">
                <div class="flex-shrink-0">
                    <i id="mass-diploma-icon" class="fas fa-exclamation-triangle text-red-500 text-3xl"></i>
                </div>
                <div class="ml-4">
                    <p id="mass-diploma-message" class="text-gray-700 font-medium"></p>
                    <p class="text-sm text-gray-600 mt-1">
                        Esta acción afectará a <strong class="text-red-600">TODOS</strong> los usuarios del sistema.
                    </p>
                </div>
            </div>

            <div class="bg-red-50 border-l-4 border-red-400 p-4 mb-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-info-circle text-red-500"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-red-700">
                            <strong>Advertencia:</strong> Esta acción no se puede deshacer fácilmente. 
                            Se aplicará a todos los usuarios existentes.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Información adicional -->
            <div class="bg-gray-50 border border-gray-200 rounded-lg p-3 mb-4">
                <div class="flex items-center text-sm text-gray-600">
                    <i class="fas fa-users text-red-600 mr-2"></i>
                    <span>Usuarios afectados: <strong id="affected-users-count" class="text-red-600">Todos</strong></span>
                </div>
            </div>

            <!-- Botones -->
            <div class="flex justify-end space-x-3">
                <button type="button"
                        onclick="closeMassDiplomaModal()"
                        class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition-colors flex items-center">
                    <i class="fas fa-times mr-2"></i>
                    Cancelar
                </button>
                <button type="button"
                        onclick="executeMassDiplomaAction()"
                        class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors flex items-center">
                    <i class="fas fa-play mr-2"></i>
                    Ejecutar Acción
                </button>
            </div>
        </div>
    </div>
</div>