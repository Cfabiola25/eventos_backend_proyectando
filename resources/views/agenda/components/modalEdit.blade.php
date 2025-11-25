<div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-2xl mx-4">
            <div class="bg-red-600 text-white p-4 rounded-t-lg flex justify-between items-center">
                <h3 class="text-lg font-semibold">Editar Agenda</h3>
                <button onclick="closeEditModal()"
                    class="text-white hover:text-gray-200 rounded-full w-6 h-6 flex items-center justify-center">
                    <svg viewBox="0 0 24 24" fill="currentColor">
                        <path
                            d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z" />
                    </svg>
                </button>
            </div>
            <div class="p-6">
                <p class="text-gray-600 mb-4">Editando agenda: <span id="editAgendaTitle" class="font-semibold"></span>
                </p>

                <form id="editForm" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="edit_title" class="block text-sm font-medium text-gray-700 mb-1">Título *</label>
                        <input type="text" name="title" id="edit_title" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-600 focus:border-red-600 hover:border-red-400 transition-colors">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="edit_start_date" class="block text-sm font-medium text-gray-700 mb-1">Fecha Inicio
                                *</label>
                            <input type="date" name="start_date" id="edit_start_date" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-600 focus:border-red-600 hover:border-red-400 transition-colors">
                        </div>
                        <div>
                            <label for="edit_end_date" class="block text-sm font-medium text-gray-700 mb-1">Fecha Fin
                                *</label>
                            <input type="date" name="end_date" id="edit_end_date" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-600 focus:border-red-600 hover:border-red-400 transition-colors">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="edit_start_time" class="block text-sm font-medium text-gray-700 mb-1">Hora Inicio
                                *</label>
                            <input type="time" name="start_time" id="edit_start_time" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-600 focus:border-red-600 hover:border-red-400 transition-colors">
                        </div>
                        <div>
                            <label for="edit_end_time" class="block text-sm font-medium text-gray-700 mb-1">Hora Fin
                                *</label>
                            <input type="time" name="end_time" id="edit_end_time" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-600 focus:border-red-600 hover:border-red-400 transition-colors">
                        </div>
                    </div>

                    <div class="mb-6">
                        <label for="edit_description"
                            class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>
                        <textarea name="description" id="edit_description" rows="4"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-600 focus:border-red-600 hover:border-red-400 transition-colors"></textarea>
                    </div>

                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-4">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-yellow-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="text-sm text-yellow-700">Los campos marcados con * son obligatorios</span>
                        </div>
                    </div>

                    <div class="flex justify-center space-x-3">
                        <button type="button" onclick="closeEditModal()"
                            class="bg-gray-300 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-400 transition font-medium">
                            Cancelar
                        </button>
                        <button type="submit"
                            class="bg-red-600 text-white px-6 py-2 rounded-lg hover:bg-red-700 transition font-medium flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Guardar Cambios
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>