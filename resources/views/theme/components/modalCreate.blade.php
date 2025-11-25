<div id="createModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-2xl mx-4">
        <div class="bg-red-600 text-white p-4 rounded-t-lg flex justify-between items-center">
            <h3 class="text-lg font-semibold">Crear Nuevo Tema</h3>
            <button onclick="closeCreateModal()"
                class="text-white hover:text-gray-200 rounded-full w-6 h-6 flex items-center justify-center">
                <svg viewBox="0 0 24 24" fill="currentColor">
                    <path
                        d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z" />
                </svg>
            </button>
        </div>
        <div class="p-6">
            <form id="createForm" method="POST" action="{{ route('theme.store') }}">
                @csrf

                <div class="mb-4">
                    <label for="create_name" class="block text-sm font-medium text-gray-700 mb-1">Nombre del Tema *</label>
                    <input type="text" name="name" id="create_name" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-600 focus:border-red-600 hover:border-red-400 transition-colors"
                        placeholder="Ingresa el nombre del tema"
                        maxlength="255">
                    <p class="text-xs text-gray-500 mt-1">Máximo 255 caracteres</p>
                </div>

                <!-- Select de Agenda - CORRECCIÓN: Hacerlo obligatorio -->
                <div class="mb-4">
                    <label for="create_agenda_id" class="block text-sm font-medium text-gray-700 mb-1">Agenda Asociada *</label>
                    <select name="agenda_id" id="create_agenda_id" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-600 focus:border-red-600 hover:border-red-400 transition-colors">
                        <option value="">Selecciona una agenda</option> <!-- CORRECCIÓN: Quitar "opcional" -->
                        @foreach($agendas as $agenda)
                            <option value="{{ $agenda->id }}">
                                {{ $agenda->title }} - {{ \Carbon\Carbon::parse($agenda->start_date)->format('d/m/Y') }}
                            </option>
                        @endforeach
                    </select>
                    <p class="text-xs text-gray-500 mt-1">Selecciona una agenda para asociar con este tema</p>
                </div>

                <div class="mb-4">
                    <label for="create_start_date" class="block text-sm font-medium text-gray-700 mb-1">Fecha de Inicio *</label>
                    <input type="date" name="start_date" id="create_start_date" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-600 focus:border-red-600 hover:border-red-400 transition-colors"
                        min="{{ now()->format('Y-m-d') }}"
                        value="{{ now()->format('Y-m-d') }}">
                    <p class="text-xs text-gray-500 mt-1">Selecciona la fecha de inicio del tema</p>
                </div>

                <div class="mb-6">
                    <label for="create_description" class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>
                    <textarea name="description" id="create_description" rows="4"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-600 focus:border-red-600 hover:border-red-400 transition-colors"
                        placeholder="Describe el tema (opcional)"></textarea>
                    <p class="text-xs text-gray-500 mt-1">Esta descripción es opcional</p>
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
                    <button type="button" onclick="closeCreateModal()"
                        class="bg-gray-300 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-400 transition font-medium">
                        Cancelar
                    </button>
                    <button type="submit"
                        class="bg-red-600 text-white px-6 py-2 rounded-lg hover:bg-red-700 transition font-medium flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 13l4 4L19 7" />
                        </svg>
                        Crear Tema
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>