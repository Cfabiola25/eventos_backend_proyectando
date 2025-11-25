<div id="password-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-md mx-4">
        <!-- Cabecera del modal -->
        <div class="bg-primary-600 text-white p-4 rounded-t-lg flex justify-between items-center">
            <h3 class="text-lg font-semibold flex items-center">
                <i class="fas fa-key mr-2"></i>
                Cambiar Contraseña
            </h3>
            <button onclick="closePasswordModal()"
                    class="text-white hover:text-gray-200 rounded-full w-8 h-8 flex items-center justify-center transition-colors">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>

        <!-- Cuerpo del modal -->
        <div class="p-6">
            <p class="text-gray-600 mb-4">
                Actualizando contraseña para:
                <span id="modal-user-name" class="font-semibold text-primary-700"></span>
            </p>

            <form id="password-form">
                <!-- Nueva Contraseña -->
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                        <i class="fas fa-lock text-primary-600 mr-1"></i>
                        Nueva Contraseña <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="password"
                            id="password"
                            name="password"
                            required
                            minlength="8"
                            placeholder="Mínimo 8 caracteres"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-600 focus:border-primary-600 pr-10">
                        <button type="button"
                                class="absolute inset-y-0 right-0 pr-3 flex items-center"
                                onclick="togglePasswordVisibility('password', 'eyeIconNew')">
                            <i id="eyeIconNew" class="fas fa-eye text-gray-400 hover:text-gray-600"></i>
                        </button>
                    </div>
                    <p class="text-xs text-gray-500 mt-1">
                        <i class="fas fa-info-circle mr-1"></i>
                        Debe tener al menos 8 caracteres
                    </p>
                </div>

                <!-- Confirmar Contraseña -->
                <div class="mb-6">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">
                        <i class="fas fa-lock text-primary-600 mr-1"></i>
                        Confirmar Contraseña <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="password"
                            id="password_confirmation"
                            name="password_confirmation"
                            required
                            minlength="8"
                            placeholder="Repite la contraseña"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-600 focus:border-primary-600 pr-10">
                        <button type="button"
                                class="absolute inset-y-0 right-0 pr-3 flex items-center"
                                onclick="togglePasswordVisibility('password_confirmation', 'eyeIconConfirm')">
                            <i id="eyeIconConfirm" class="fas fa-eye text-gray-400 hover:text-gray-600"></i>
                        </button>
                    </div>
                    <p id="password-match-error" class="text-red-500 text-xs mt-1 hidden">
                        <i class="fas fa-exclamation-triangle mr-1"></i>
                        Las contraseñas no coinciden
                    </p>
                </div>

                <!-- Botones -->
                <div class="flex justify-end space-x-3">
                    <button type="button"
                            onclick="closePasswordModal()"
                            class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition-colors ">
                        <i class="fas fa-times mr-2"></i>
                        Cancelar
                    </button>
                    <button type="submit"
                            class="px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition-colors flex items-center">
                        <i class="fas fa-save mr-2"></i>
                        Actualizar Contraseña
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Toggle visibilidad de contraseña
function togglePasswordVisibility(inputId, iconId) {
    const input = document.getElementById(inputId);
    const icon = document.getElementById(iconId);

    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}

// Validar que las contraseñas coincidan
document.addEventListener('DOMContentLoaded', function() {
    const passwordInput = document.getElementById('password');
    const confirmInput = document.getElementById('password_confirmation');
    const errorMsg = document.getElementById('password-match-error');

    if (confirmInput) {
        confirmInput.addEventListener('input', function() {
            if (confirmInput.value && passwordInput.value !== confirmInput.value) {
                errorMsg.classList.remove('hidden');
                confirmInput.classList.add('border-red-500');
            } else {
                errorMsg.classList.add('hidden');
                confirmInput.classList.remove('border-red-500');
            }
        });
    }
});
</script>