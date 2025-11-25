@extends('layouts.app')

@section('content')
<div class="w-full px-4 py-6 mx-auto mt-16">
    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center">
            <a href="{{ route('users.index') }}" class="mr-4 text-gray-600 hover:text-primary-600 transition-colors">
                <i class="fas fa-arrow-left text-2xl"></i>
            </a>
            <h1 class="text-3xl font-bold text-gray-800">
                <i class="fas fa-user-edit text-primary-600 mr-2"></i>
                Editar Usuario
            </h1>
        </div>
    </div>

    <!-- Formulario -->
    <form action="{{ route('users.update', $user->uuid) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Columna Izquierda -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Información Personal -->
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-user text-primary-600 mr-2"></i>
                        Información Personal
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Nombres -->
                        <div>
                            <label for="first_name" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-user text-primary-600 mr-1"></i>
                                Nombres <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="first_name" name="first_name" value="{{ old('first_name', $user->first_name) }}" required
                                   placeholder="Ej: Juan Carlos"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all @error('first_name') border-red-500 @enderror">
                            @error('first_name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Apellidos -->
                        <div>
                            <label for="last_name" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-user text-primary-600 mr-1"></i>
                                Apellidos <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="last_name" name="last_name" value="{{ old('last_name', $user->last_name) }}" required
                                   placeholder="Ej: Pérez García"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all @error('last_name') border-red-500 @enderror">
                            @error('last_name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-envelope text-primary-600 mr-1"></i>
                                Correo Electrónico <span class="text-red-500">*</span>
                            </label>
                            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required
                                   placeholder="correo@ejemplo.com"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all @error('email') border-red-500 @enderror">
                            @error('email')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Teléfono -->
                        <div>
                            <label for="phone" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-phone text-primary-600 mr-1"></i>
                                Teléfono
                            </label>
                            <input type="text" id="phone" name="phone" value="{{ old('phone', $user->phone) }}"
                                   placeholder="Ej: 3001234567"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all @error('phone') border-red-500 @enderror">
                            @error('phone')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Fecha de Nacimiento -->
                        <div class="md:col-span-2">
                            <label for="birthdate" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-calendar text-primary-600 mr-1"></i>
                                Fecha de Nacimiento
                            </label>
                            <input type="date" id="birthdate" name="birthdate" value="{{ old('birthdate', $user->birthdate) }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all @error('birthdate') border-red-500 @enderror">
                            @error('birthdate')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Información de Identificación -->
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-id-card text-primary-600 mr-2"></i>
                        Información de Identificación
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <!-- Género -->
                        <div>
                            <label for="gender_id" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-venus-mars text-primary-600 mr-1"></i>
                                Género <span class="text-red-500">*</span>
                            </label>
                            <select id="gender_id" name="gender_id" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all @error('gender_id') border-red-500 @enderror">
                                <option value="">Seleccione...</option>
                                @foreach($genders as $gender)
                                    <option value="{{ $gender->id }}" {{ old('gender_id', $user->gender_id) == $gender->id ? 'selected' : '' }}>
                                        {{ $gender->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('gender_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tipo de Documento -->
                        <div>
                            <label for="document_type_id" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-id-card text-primary-600 mr-1"></i>
                                Tipo Documento <span class="text-red-500">*</span>
                            </label>
                            <select id="document_type_id" name="document_type_id" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all @error('document_type_id') border-red-500 @enderror">
                                <option value="">Seleccione...</option>
                                @foreach($documentTypes as $docType)
                                    <option value="{{ $docType->id }}" {{ old('document_type_id', $user->document_type_id) == $docType->id ? 'selected' : '' }}>
                                        {{ $docType->name }} ({{ $docType->code }})
                                    </option>
                                @endforeach
                            </select>
                            @error('document_type_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Número de Documento -->
                        <div>
                            <label for="document_number" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-hashtag text-primary-600 mr-1"></i>
                                N° Documento <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="document_number" name="document_number" value="{{ old('document_number', $user->document_number) }}" required
                                   placeholder="Ej: 1002773001"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all @error('document_number') border-red-500 @enderror">
                            @error('document_number')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Ubicación -->
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-map-marker-alt text-primary-600 mr-2"></i>
                        Ubicación
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- País -->
                        <div>
                            <label for="country" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-flag text-primary-600 mr-1"></i>
                                País
                            </label>
                            <input type="text" id="country" name="country" value="{{ old('country', $user->country) }}"
                                   placeholder="Ej: Colombia"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all @error('country') border-red-500 @enderror">
                            @error('country')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Ciudad -->
                        <div>
                            <label for="city" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-city text-primary-600 mr-1"></i>
                                Ciudad
                            </label>
                            <input type="text" id="city" name="city" value="{{ old('city', $user->city) }}"
                                   placeholder="Ej: Cúcuta"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all @error('city') border-red-500 @enderror">
                            @error('city')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Tipo de Usuario y Rol -->
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-user-tag text-primary-600 mr-2"></i>
                        Tipo de Usuario y Permisos
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Tipo de Usuario -->
                        <div>
                            <label for="user_type_id" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-users text-primary-600 mr-1"></i>
                                Tipo de Usuario <span class="text-red-500">*</span>
                            </label>
                            <select id="user_type_id" name="user_type_id" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all @error('user_type_id') border-red-500 @enderror">
                                <option value="">Seleccione...</option>
                                @foreach($userTypes as $userType)
                                    <option value="{{ $userType->id }}" {{ old('user_type_id', $user->user_type_id) == $userType->id ? 'selected' : '' }}>
                                        {{ $userType->type }}
                                    </option>
                                @endforeach
                            </select>
                            @error('user_type_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Rol -->
                        <div>
                            <label for="role" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-shield-alt text-primary-600 mr-1"></i>
                                Rol del Sistema
                            </label>
                            <select id="role" name="role"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all @error('role') border-red-500 @enderror">
                                <option value="">Sin rol asignado</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->name }}" {{ old('role', $user->roles->first()?->name) == $role->name ? 'selected' : '' }}>
                                        {{ ucfirst($role->name) }}
                                    </option>
                                @endforeach
                            </select>
                            @error('role')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- NUEVO: Modalidad - CORREGIDO COMO REQUERIDO -->
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-laptop-house text-primary-600 mr-2"></i>
                        Modalidad
                    </h2>

                    <div class="grid grid-cols-1 gap-4">
                        <!-- Modalidad -->
                        <div>
                            <label for="modality_id" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-desktop text-primary-600 mr-1"></i>
                                Modalidad del Usuario <span class="text-red-500">*</span> <!-- AGREGADO ASTERISCO ROJO -->
                            </label>
                            <select id="modality_id" name="modality_id" required <!-- AGREGADO REQUIRED -->
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all @error('modality_id') border-red-500 @enderror">
                                <option value="">Seleccione una modalidad</option> <!-- CAMBIADO TEXTO -->
                                @foreach($modalities as $modality)
                                    <option value="{{ $modality->id }}" {{ old('modality_id', $user->modality_id) == $modality->id ? 'selected' : '' }}>
                                        {{ $modality->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('modality_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                            <p class="text-xs text-gray-500 mt-1">
                                <i class="fas fa-info-circle mr-1"></i>
                                La modalidad determina qué eventos podrá ver el usuario
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Cambiar Contraseña -->
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-lock text-primary-600 mr-2"></i>
                        Cambiar Contraseña
                    </h2>

                    <div class="bg-yellow-50 border-l-4 border-yellow-500 p-4 mb-4">
                        <div class="flex">
                            <i class="fas fa-info-circle text-yellow-600 mt-0.5 mr-2"></i>
                            <p class="text-sm text-yellow-700">
                                Deja estos campos vacíos si no deseas cambiar la contraseña del usuario.
                            </p>
                        </div>
                    </div>

                    <button type="button" id="togglePasswordForm" class="w-full px-4 py-3 bg-gray-100 text-gray-700 font-semibold rounded-lg hover:bg-gray-200 transition-colors flex items-center justify-center">
                        <i class="fas fa-key mr-2"></i>
                        Cambiar Contraseña
                    </button>

                    <div id="passwordForm" class="hidden mt-4 space-y-4">
                        <div>
                            <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-lock text-primary-600 mr-1"></i>
                                Nueva Contraseña
                            </label>
                            <input type="password" id="password" name="password" minlength="8"
                                   placeholder="Mínimo 8 caracteres"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all">
                        </div>

                        <div>
                            <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-lock text-primary-600 mr-1"></i>
                                Confirmar Contraseña
                            </label>
                            <input type="password" id="password_confirmation" name="password_confirmation" minlength="8"
                                   placeholder="Repite la contraseña"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Columna Derecha -->
            <div class="space-y-6">
                <!-- Foto -->
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-camera text-primary-600 mr-2"></i>
                        Foto de Perfil
                    </h2>

                    <div class="space-y-4">
                        <div id="photoPreview" class="{{ $user->photo ? '' : 'hidden' }}">
                            <img id="previewImg" src="{{ $user->photo ? $user->photo : '' }}" alt="Preview"
                                 class="w-full h-64 object-cover rounded-lg border-2 border-gray-300">
                            <button type="button" onclick="removePhoto()"
                                    class="mt-2 w-full px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors">
                                <i class="fas fa-trash mr-2"></i>Eliminar Foto
                            </button>
                        </div>

                        <div id="uploadArea" class="{{ $user->photo ? 'hidden' : '' }} border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-primary-500 transition-colors cursor-pointer">
                            <input type="file" id="photo" name="photo" accept="image/*" class="hidden" onchange="previewPhoto(event)">
                            <label for="photo" class="cursor-pointer">
                                <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-2"></i>
                                <p class="text-sm text-gray-600 font-semibold">Click para subir foto</p>
                                <p class="text-xs text-gray-400 mt-1">PNG, JPG, WEBP (MAX. 2MB)</p>
                            </label>
                        </div>
                        @error('photo')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Estado -->
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-toggle-on text-primary-600 mr-2"></i>
                        Estado
                    </h2>

                    <div class="bg-gray-50 border-2 border-gray-200 rounded-lg p-4">
                        <label for="status" class="flex items-center cursor-pointer">
                            <input type="checkbox" id="status" name="status" value="1" {{ old('status', $user->status) ? 'checked' : '' }}
                                   class="w-5 h-5 text-primary-600 border-gray-300 rounded focus:ring-primary-500 cursor-pointer">
                            <div class="ml-3 flex-1">
                                <div class="text-sm font-semibold text-gray-700">Usuario Activo</div>
                                <p class="text-xs text-gray-500 mt-1">
                                    <i class="fas fa-info-circle mr-1"></i>
                                    Los usuarios activos pueden acceder al sistema
                                </p>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Información del Usuario -->
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-info-circle text-primary-600 mr-2"></i>
                        Información
                    </h2>

                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between items-center py-2 border-b border-gray-200">
                            <span class="text-gray-600 font-medium">UUID:</span>
                            <span class="text-gray-800 font-mono text-xs">{{ $user->uuid }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-200">
                            <span class="text-gray-600 font-medium">Creado:</span>
                            <span class="text-gray-800">{{ $user->created_at->format('d/m/Y H:i') }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2">
                            <span class="text-gray-600 font-medium">Última Actualización:</span>
                            <span class="text-gray-800">{{ $user->updated_at->format('d/m/Y H:i') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Botones -->
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <div class="space-y-3">
                        <button type="submit"
                                class="w-full px-6 py-3 bg-primary-600 text-white font-bold rounded-lg hover:bg-primary-700 transition-colors shadow-lg flex items-center justify-center">
                            <i class="fas fa-save mr-2"></i>
                            Guardar Cambios
                        </button>

                        <a href="{{ route('users.index') }}"
                           class="w-full px-6 py-3 bg-gray-500 text-white font-bold rounded-lg hover:bg-gray-600 transition-colors flex items-center justify-center">
                            <i class="fas fa-times mr-2"></i>
                            Cancelar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    // Toggle password form
    document.getElementById('togglePasswordForm')?.addEventListener('click', function() {
        const passwordForm = document.getElementById('passwordForm');
        passwordForm.classList.toggle('hidden');

        if (!passwordForm.classList.contains('hidden')) {
            this.innerHTML = '<i class="fas fa-times mr-2"></i>Cancelar Cambio de Contraseña';
            this.classList.remove('bg-gray-100', 'text-gray-700', 'hover:bg-gray-200');
            this.classList.add('bg-red-100', 'text-red-700', 'hover:bg-red-200');
        } else {
            this.innerHTML = '<i class="fas fa-key mr-2"></i>Cambiar Contraseña';
            this.classList.remove('bg-red-100', 'text-red-700', 'hover:bg-red-200');
            this.classList.add('bg-gray-100', 'text-gray-700', 'hover:bg-gray-200');

            // Clear password fields
            document.getElementById('password').value = '';
            document.getElementById('password_confirmation').value = '';
        }
    });

    // Preview photo
    function previewPhoto(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('previewImg').src = e.target.result;
                document.getElementById('photoPreview').classList.remove('hidden');
                document.getElementById('uploadArea').classList.add('hidden');
            }
            reader.readAsDataURL(file);
        }
    }

    // Remove photo
    function removePhoto() {
        document.getElementById('photo').value = '';
        document.getElementById('photoPreview').classList.add('hidden');
        document.getElementById('uploadArea').classList.remove('hidden');
    }
</script>
@endsection