<!-- Modal de Confirmación Diploma Admin -->
<div id="admin-diploma-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-md mx-4">
        <!-- Cabecera del modal -->
        <div class="bg-red-600 text-white p-4 rounded-t-lg">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <i id="admin-modal-header-icon" class="fas fa-user-shield text-white text-xl mr-3"></i>
                    <h3 id="admin-modal-title" class="text-lg font-semibold text-white">
                        Modo Administrador
                    </h3>
                </div>
                <button onclick="closeAdminDiplomaModal()"
                    class="text-white hover:text-gray-200 rounded-lg w-8 h-8 flex items-center justify-center transition-colors">
                    <i class="fas fa-times text-lg"></i>
                </button>
            </div>
        </div>

        <!-- Cuerpo del modal -->
        <div class="p-6">
            <!-- Contenido principal -->
            <div class="flex items-start mb-5">
                <div class="flex-shrink-0 mr-4">
                    <i id="admin-modal-icon" class="fas fa-user-shield text-red-600 text-2xl mt-1"></i>
                </div>
                <div class="flex-1">
                    <div id="admin-modal-message" class="text-gray-800 font-medium text-base leading-relaxed">
                        <!-- Contenido dinámico se insertará aquí -->
                    </div>
                </div>
            </div>

            <!-- Contenedor para información adicional dinámica -->
            <div id="admin-modal-info" class="mb-4">
                <!-- La información adicional se insertará aquí dinámicamente -->
            </div>

            <!-- Información adicional fija -->
            <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-4">
                <div class="flex items-start">
                    <i class="fas fa-info-circle text-red-500 text-lg mt-0.5 mr-3"></i>
                    <div>
                        <p class="text-sm text-red-700 font-medium">
                            Acción inmediata
                        </p>
                        <p class="text-xs text-red-600 mt-1">
                            Esta acción cambiará el estado inmediatamente y no se puede deshacer fácilmente.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Botones -->
            <div class="flex justify-center space-x-3 pt-2">
                <button type="button" onclick="closeAdminDiplomaModal()"
                    class="px-5 py-2.5 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition-colors duration-200 font-medium flex items-center">
                    <i class="fas fa-times mr-2"></i>
                    Cancelar
                </button>
                <button type="button" onclick="executeAdminDiplomaToggle()"
                    class="px-5 py-2.5 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors duration-200 font-medium flex items-center">
                    <i class="fas fa-user-shield mr-2"></i>
                    Confirmar Admin
                </button>
            </div>
        </div>
    </div>
</div>