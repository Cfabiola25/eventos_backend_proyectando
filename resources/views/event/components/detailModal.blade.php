<!-- Modal de Detalles del Evento -->
<div id="detail-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-4xl mx-4 max-h-[90vh] overflow-hidden">
        <!-- Cabecera del modal -->
        <div class="bg-primary-600 text-white p-4 flex justify-between items-center">
            <h3 class="text-lg font-semibold flex items-center">
                <i class="fas fa-info-circle mr-2"></i>
                Detalles del Evento
            </h3>
            <button onclick="closeDetailModal()"
                    class="text-white hover:text-gray-200 rounded-full w-8 h-8 flex items-center justify-center transition-colors">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>

        <!-- Contenido del modal -->
        <div class="p-6 overflow-y-auto max-h-[calc(90vh-120px)]">
            <div id="detail-content">
                <!-- El contenido se cargará dinámicamente aquí -->
            </div>
        </div>

        <!-- Pie del modal -->
        <div class="bg-gray-50 px-6 py-3 border-t border-gray-200 flex justify-end">
            <button type="button"
                    onclick="closeDetailModal()"
                    class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition-colors">
                <i class="fas fa-times mr-2"></i>
                Cerrar
            </button>
        </div>
    </div>
</div>