<!-- Modal de Detalles del Evento -->
<div id="eventDetailsModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-2xl mx-4 max-h-[90vh] overflow-y-auto">
        <!-- Cabecera del modal -->
        <div class="bg-primary-600 text-white p-4 rounded-t-lg flex justify-between items-center">
            <h3 class="text-lg font-semibold flex items-center">
                <i class="fas fa-info-circle mr-2"></i>
                Detalles del Evento
            </h3>
            <button onclick="closeEventDetailsModal()"
                    class="text-white hover:text-gray-200 rounded-full w-8 h-8 flex items-center justify-center transition-colors">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>

        <!-- Cuerpo del modal -->
        <div class="p-6">
            <!-- Imagen del Evento -->
            <div class="mb-4 text-center">
                <img id="modalEventImage" src="" alt="Imagen del evento" 
                     class="hidden w-full h-48 object-cover rounded-lg mb-4">
            </div>

            <!-- Información Básica -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                <div>
                    <h4 class="text-sm font-semibold text-gray-700 mb-1">Título</h4>
                    <p id="modalEventTitle" class="text-lg font-bold text-gray-900"></p>
                </div>
                <div>
                    <h4 class="text-sm font-semibold text-gray-700 mb-1">Modalidad</h4>
                    <p id="modalEventModality" class="text-gray-900"></p>
                </div>
                <div>
                    <h4 class="text-sm font-semibold text-gray-700 mb-1">Capacidad</h4>
                    <p id="modalEventCapacity" class="text-gray-900"></p>
                </div>
                <div>
                    <h4 class="text-sm font-semibold text-gray-700 mb-1">Estado</h4>
                    <span id="modalEventStatus" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium"></span>
                </div>
            </div>

            <!-- Descripción -->
            <div class="mb-6">
                <h4 class="text-sm font-semibold text-gray-700 mb-2">Descripción</h4>
                <p id="modalEventDescription" class="text-gray-700 bg-gray-50 p-3 rounded-lg"></p>
            </div>
        </div>

        <!-- Pie del modal -->
        <div class="bg-gray-50 px-6 py-3 rounded-b-lg flex justify-end">
            <button onclick="closeEventDetailsModal()"
                    class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition-colors">
                <i class="fas fa-times mr-2"></i>
                Cerrar
            </button>
        </div>
    </div>
</div>