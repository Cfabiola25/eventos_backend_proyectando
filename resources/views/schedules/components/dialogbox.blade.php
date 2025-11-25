<!-- Modal -->
<div id="scheduleModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 overflow-y-auto h-full w-full z-50 flex items-center justify-center">
    <div class="relative bg-white rounded-lg shadow-2xl w-full max-w-2xl mx-4 transform transition-all">
        <!-- Header del Modal -->
        <div class="bg-primary-600 text-white px-6 py-4 rounded-t-lg flex justify-between items-center">
            <h3 id="modalTitle" class="text-xl font-bold flex items-center">
                <i class="fas fa-clock mr-2"></i>
                Crear Horario
            </h3>
            <button onclick="closeModal()" class="text-white hover:text-gray-200 transition-colors">
                <i class="fas fa-times text-2xl"></i>
            </button>
        </div>

        <!-- Cuerpo del Modal -->
        <form id="scheduleForm" class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Fecha de Inicio -->
                <div class="col-span-1">
                    <label for="start_date" class="block text-sm font-semibold text-gray-700 mb-2 cursor-pointer">
                        <i class="fas fa-calendar-day text-primary-600 mr-1"></i>
                        Fecha de Inicio <span class="text-red-500">*</span>
                    </label>
                    <input type="date"
                        id="start_date"
                        name="start_date"
                        required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all">
                </div>

                <!-- Fecha de Finalización -->
                <div class="col-span-1">
                    <label for="end_date" class="block text-sm font-semibold text-gray-700 mb-2 cursor-pointer">
                        <i class="fas fa-calendar-check text-primary-600 mr-1"></i>
                        Fecha de Finalización <span class="text-red-500">*</span>
                    </label>
                    <input type="date"
                        id="end_date"
                        name="end_date"
                        required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all">
                </div>

                <!-- Hora de Inicio -->
                <div class="col-span-1">
                    <label for="start_time" class="block text-sm font-semibold text-gray-700 mb-2 cursor-pointer">
                        <i class="fas fa-clock text-primary-600 mr-1"></i>
                        Hora de Inicio <span class="text-red-500">*</span>
                    </label>
                    <input type="time"
                        id="start_time"
                        name="start_time"
                        required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all">
                    <p class="text-xs text-gray-500 mt-1">
                        <i class="fas fa-info-circle mr-1"></i>
                        Formato 24 horas (Ej: 14:30)
                    </p>
                </div>

                <!-- Hora de Finalización -->
                <div class="col-span-1">
                    <label for="end_time" class="block text-sm font-semibold text-gray-700 mb-2 cursor-pointer">
                        <i class="fas fa-hourglass-end text-primary-600 mr-1"></i>
                        Hora de Finalización <span class="text-red-500">*</span>
                    </label>
                    <input type="time"
                        id="end_time"
                        name="end_time"
                        required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all">
                    <p class="text-xs text-gray-500 mt-1">
                        <i class="fas fa-info-circle mr-1"></i>
                        Debe ser posterior a la hora de inicio
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
                            <li>La fecha de finalización debe ser igual o posterior a la fecha de inicio</li>
                            <li>La hora de finalización debe ser posterior a la hora de inicio</li>
                            <li>Los horarios pueden abarcar uno o varios días</li>
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
    document.getElementById('color')?.addEventListener('input', function(e) {
        document.getElementById('colorPreview').style.backgroundColor = e.target.value;
        document.getElementById('colorValue').textContent = e.target.value.toUpperCase();
    });
</script>