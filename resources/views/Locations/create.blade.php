@extends('layouts.app')

@section('content')
<div class="w-full px-4 py-6 mx-auto mt-16">
    <!-- Header con título y botón de regreso -->
    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center">
            <a href="{{ route('locations.index') }}"
                class="mr-4 text-gray-600 hover:text-primary-600 transition-colors">
                <i class="fas fa-arrow-left text-2xl"></i>
            </a>
            <h1 class="text-3xl font-bold text-gray-800">
                <i class="fas fa-map-marker-alt text-primary-600 mr-2"></i>
                Nueva Ubicación
            </h1>
        </div>
    </div>

    <!-- Formulario -->
    <form action="{{ route('locations.store') }}" method="POST" enctype="multipart/form-data" id="locationForm">
        @csrf

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Columna Izquierda - Información Básica -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Card: Información General -->
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-info-circle text-primary-600 mr-2"></i>
                        Información General
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Nombre -->
                        <div class="md:col-span-2">
                            <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-building text-primary-600 mr-1"></i>
                                Nombre de la Ubicación <span class="text-red-500">*</span>
                            </label>
                            <input type="text"
                                id="name"
                                name="name"
                                value="{{ old('name') }}"
                                required
                                placeholder="Ej: Auditorio Principal, Salón 301"
                                class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all @error('name') border-red-500 @enderror">
                            @error('name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Dirección -->
                        <div class="md:col-span-2">
                            <label for="address" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-map-marked-alt text-primary-600 mr-1"></i>
                                Dirección <span class="text-red-500">*</span>
                            </label>
                            <input type="text"
                                id="address"
                                name="address"
                                value="{{ old('address') }}"
                                required
                                placeholder="Ej: Calle 10 # 5-20, Barrio Centro"
                                class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all @error('address') border-red-500 @enderror">
                            @error('address')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Salón/Sala -->
                        <div>
                            <label for="room" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-door-open text-primary-600 mr-1"></i>
                                Salón/Sala
                            </label>
                            <input type="text"
                                id="room"
                                name="room"
                                value="{{ old('room') }}"
                                placeholder="Ej: Sala 301, Auditorio A"
                                class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all @error('room') border-red-500 @enderror">
                            @error('room')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Punto de Referencia -->
                        <div>
                            <label for="reference_point" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-landmark text-primary-600 mr-1"></i>
                                Punto de Referencia
                            </label>
                            <input type="text"
                                id="reference_point"
                                name="reference_point"
                                value="{{ old('reference_point') }}"
                                placeholder="Ej: Frente al parque central"
                                class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all @error('reference_point') border-red-500 @enderror">
                            @error('reference_point')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Card: Ubicación Geográfica -->
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-globe text-primary-600 mr-2"></i>
                        Ubicación Geográfica
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- País -->
                        <div>
                            <label for="country" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-flag text-primary-600 mr-1"></i>
                                País
                            </label>
                            <input type="text"
                                id="country"
                                name="country"
                                value="{{ old('country', 'Colombia') }}"
                                placeholder="Ej: Colombia"
                                class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all @error('country') border-red-500 @enderror">
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
                            <input type="text"
                                id="city"
                                name="city"
                                value="{{ old('city') }}"
                                placeholder="Ej: Cúcuta"
                                class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all @error('city') border-red-500 @enderror">
                            @error('city')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Latitud -->
                        <div>
                            <label for="latitude" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-compass text-primary-600 mr-1"></i>
                                Latitud
                            </label>
                            <input type="text"
                                id="latitude"
                                name="latitude"
                                value="{{ old('latitude') }}"
                                placeholder="Ej: 7.889391"
                                class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all @error('latitude') border-red-500 @enderror">
                            @error('latitude')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Longitud -->
                        <div>
                            <label for="longitude" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-compass text-primary-600 mr-1"></i>
                                Longitud
                            </label>
                            <input type="text"
                                id="longitude"
                                name="longitude"
                                value="{{ old('longitude') }}"
                                placeholder="Ej: -72.496928"
                                class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all @error('longitude') border-red-500 @enderror">
                            @error('longitude')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Google Maps Link -->
                        <div class="md:col-span-2">
                            <label for="google_maps_link" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-link text-primary-600 mr-1"></i>
                                Enlace de Google Maps
                            </label>
                            <input type="url"
                                id="google_maps_link"
                                name="google_maps_link"
                                value="{{ old('google_maps_link') }}"
                                placeholder="https://goo.gl/maps/..."
                                class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all @error('google_maps_link') border-red-500 @enderror">
                            @error('google_maps_link')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                            <p class="text-xs text-gray-500 mt-1">
                                <i class="fas fa-info-circle mr-1"></i>
                                Pega el enlace de Google Maps de la ubicación
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Columna Derecha - Imagen y Estado -->
            <div class="space-y-6">
                <!-- Card: Imagen -->
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-image text-primary-600 mr-2"></i>
                        Imagen de la Ubicación
                    </h2>

                    <div class="space-y-4">
                        <!-- Preview de imagen -->
                        <div id="imagePreview" class="hidden">
                            <img id="previewImg"
                                src=""
                                alt="Preview"
                                class="w-full h-48 object-cover rounded-lg border-2 border-gray-300">
                            <button type="button"
                                    onclick="removeImage()"
                                    class="mt-2 w-full px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors">
                                <i class="fas fa-trash mr-2"></i>Eliminar Imagen
                            </button>
                        </div>

                        <!-- Input de archivo -->
                        <div id="uploadArea" class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-primary-500 transition-colors cursor-pointer">
                            <input type="file"
                                id="image"
                                name="image"
                                accept="image/*"
                                class="hidden"
                                onchange="previewImage(event)">
                            <label for="image" class="cursor-pointer">
                                <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-2"></i>
                                <p class="text-sm text-gray-600 font-semibold">Click para subir imagen</p>
                                <p class="text-xs text-gray-400 mt-1">PNG, JPG, WEBP (MAX. 2MB)</p>
                            </label>
                        </div>
                        @error('image')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Card: Estado -->
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-toggle-on text-primary-600 mr-2"></i>
                        Estado
                    </h2>

                    <div class="bg-gray-50 border-2 border-gray-200 rounded-lg p-4">
                        <label for="is_active" class="flex items-center cursor-pointer">
                            <input type="checkbox"
                                id="is_active"
                                name="is_active"
                                value="1"
                                {{ old('is_active', 1) ? 'checked' : '' }}
                                class="w-5 h-5 text-primary-600 border-gray-300 rounded focus:ring-primary-500 cursor-pointer">
                            <div class="ml-3 flex-1">
                                <div class="text-sm font-semibold text-gray-700">Ubicación Activa</div>
                                <p class="text-xs text-gray-500 mt-1">
                                    <i class="fas fa-info-circle mr-1"></i>
                                    Las ubicaciones activas estarán disponibles para eventos
                                </p>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Botones de Acción -->
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <div class="space-y-3">
                        <button type="submit"
                                class="w-full px-6 py-3 bg-primary-600 text-white font-bold rounded-lg hover:bg-primary-700 transition-colors shadow-lg flex items-center justify-center">
                            <i class="fas fa-save mr-2"></i>
                            Guardar Ubicación
                        </button>

                        <a href="{{ route('locations.index') }}"
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
    // Preview de imagen
    function previewImage(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('previewImg').src = e.target.result;
                document.getElementById('imagePreview').classList.remove('hidden');
                document.getElementById('uploadArea').classList.add('hidden');
            }
            reader.readAsDataURL(file);
        }
    }

    // Eliminar imagen
    function removeImage() {
        document.getElementById('image').value = '';
        document.getElementById('imagePreview').classList.add('hidden');
        document.getElementById('uploadArea').classList.remove('hidden');
    }
</script>
@endsection