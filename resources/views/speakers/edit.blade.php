@extends('layouts.app')

@section('content')
<div class="w-full px-4 py-6 mx-auto mt-16">
    <!-- Header con título y botón de regreso -->
    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center">
            <a href="{{ route('speakers.index') }}"
                class="mr-4 text-gray-600 hover:text-primary-600 transition-colors">
                <i class="fas fa-arrow-left text-2xl"></i>
            </a>
            <h1 class="text-3xl font-bold text-gray-800">
                <i class="fas fa-edit text-primary-600 mr-2"></i>
                Editar Ponente
            </h1>
        </div>
    </div>

    <!-- Formulario -->
    <form action="{{ route('speakers.update', $speaker->id) }}" method="POST" id="speakerForm">
        @csrf
        @method('PUT')

        <!-- 🆕 CAMPO OCULTO PARA LA IMAGEN BASE64 -->
        <input type="hidden" name="photo_base64" id="photoBase64">

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
                                <i class="fas fa-user text-primary-600 mr-1"></i>
                                Nombre Completo <span class="text-red-500">*</span>
                            </label>
                            <input type="text"
                                   id="name"
                                   name="name"
                                   value="{{ old('name', $speaker->name) }}"
                                   required
                                   placeholder="Ej: Dr. Juan Pérez García"
                                   class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all @error('name') border-red-500 @enderror">
                            @error('name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Profesión -->
                        <div class="md:col-span-2">
                            <label for="profession" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-briefcase text-primary-600 mr-1"></i>
                                Profesión / Cargo
                            </label>
                            <input type="text"
                                   id="profession"
                                   name="profession"
                                   value="{{ old('profession', $speaker->profession) }}"
                                   placeholder="Ej: Ingeniero de Software, Docente, PhD en IA"
                                   class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all @error('profession') border-red-500 @enderror">
                            @error('profession')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Biografía -->
                        <div class="md:col-span-2">
                            <label for="bio" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-align-left text-primary-600 mr-1"></i>
                                Biografía
                            </label>
                            <textarea id="bio"
                                      name="bio"
                                      rows="4"
                                      placeholder="Descripción profesional del ponente, experiencia, logros..."
                                      class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all resize-none @error('bio') border-red-500 @enderror">{{ old('bio', $speaker->bio) }}</textarea>
                            @error('bio')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Habilidades -->
                        <div class="md:col-span-2">
                            <label for="skills" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-code text-primary-600 mr-1"></i>
                                Habilidades / Áreas de Expertise
                            </label>
                            @php
                                $skillsValue = old('skills');
                                if (!$skillsValue && $speaker->skills) {
                                    $skillsArray = is_string($speaker->skills) ? json_decode($speaker->skills, true) : $speaker->skills;
                                    $skillsValue = is_array($skillsArray) ? implode(', ', $skillsArray) : '';
                                }
                            @endphp
                            <input type="text"
                                   id="skills"
                                   name="skills"
                                   value="{{ $skillsValue }}"
                                   placeholder="Ej: Laravel, React, Machine Learning, DevOps"
                                   class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all @error('skills') border-red-500 @enderror">
                            @error('skills')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                            <p class="text-xs text-gray-500 mt-1">
                                <i class="fas fa-info-circle mr-1"></i>
                                Separa las habilidades con comas
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Card: Contacto y Redes -->
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-globe text-primary-600 mr-2"></i>
                        Contacto y Redes Sociales
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Sitio Web -->
                        <div class="md:col-span-2">
                            <label for="website" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-link text-primary-600 mr-1"></i>
                                Sitio Web Personal
                            </label>
                            <input type="url"
                                id="website"
                                name="website"
                                value="{{ old('website', $speaker->website) }}"
                                placeholder="https://www.ejemplo.com"
                                class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all @error('website') border-red-500 @enderror">
                            @error('website')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Redes Sociales -->
                        <div class="md:col-span-2">
                            <label for="social_links" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-share-alt text-primary-600 mr-1"></i>
                                Redes Sociales (JSON)
                            </label>
                            @php
                                $socialLinksValue = old('social_links');
                                if (!$socialLinksValue && $speaker->social_links) {
                                    $socialLinksValue = is_array($speaker->social_links)
                                        ? json_encode($speaker->social_links, JSON_PRETTY_PRINT)
                                        : $speaker->social_links;
                                }
                            @endphp
                            <textarea id="social_links"
                                    name="social_links"
                                    rows="3"
                                    placeholder='{"linkedin": "https://linkedin.com/in/usuario", "twitter": "https://twitter.com/usuario"}'
                                    class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all resize-none font-mono text-sm @error('social_links') border-red-500 @enderror">{{ $socialLinksValue }}</textarea>
                            @error('social_links')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                            <p class="text-xs text-gray-500 mt-1">
                                <i class="fas fa-info-circle mr-1"></i>
                                Formato JSON: {"red": "url", "red2": "url2"}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Columna Derecha - Foto y Estado -->
            <div class="space-y-6 lg:flex lg:flex-col lg:h-full">
                <!-- Card: Foto -->
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-camera text-primary-600 mr-2"></i>
                        Foto del Ponente
                    </h2>

                    <div class="space-y-4">
                        <!-- Foto actual -->
                        @if($speaker->photo)
                        <div id="currentPhoto">
                            <p class="text-sm text-gray-600 mb-2 font-medium">Foto actual:</p>
                            <img src="{{ $speaker->photo }}"
                                alt="{{ $speaker->name }}"
                                class="w-full h-80 lg:h-[28rem] object-cover rounded-lg border-2 border-gray-300">
                            <button type="button"
                                    onclick="removeCurrentPhoto()"
                                    class="mt-2 w-full px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors">
                                <i class="fas fa-trash mr-2"></i>Cambiar Foto
                            </button>
                        </div>
                        @endif

                        <!-- Preview de nueva foto -->
                        <div id="photoPreview" class="hidden">
                            <p class="text-sm text-gray-600 mb-2 font-medium">Nueva foto:</p>
                            <img id="previewImg"
                                src=""
                                alt="Preview"
                                class="w-full h-80 lg:h-[28rem] object-cover rounded-lg border-2 border-gray-300">
                            <button type="button"
                                    onclick="removePhoto()"
                                    class="mt-2 w-full px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors">
                                <i class="fas fa-trash mr-2"></i>Eliminar Nueva Foto
                            </button>
                        </div>

                        <!-- Input de archivo -->
                        <div id="uploadArea"
                            class="{{ $speaker->photo ? 'hidden' : '' }} h-72 lg:h-[22rem] border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-primary-500 transition-colors cursor-pointer flex items-center justify-center">
                            <input type="file"
                                id="photo"
                                name="photo"
                                accept="image/*"
                                class="hidden"
                                onchange="previewPhoto(event)">
                            <label for="photo" class="cursor-pointer">
                                <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-2"></i>
                                <p class="text-sm text-gray-600 font-semibold">
                                    {{ $speaker->photo ? 'Subir nueva foto' : 'Click para subir foto' }}
                                </p>
                                <p class="text-xs text-gray-400 mt-1">PNG, JPG, WEBP (MAX. 2MB)</p>
                            </label>
                        </div>
                        @error('photo_base64')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Card: Estado -->
                <div class="bg-white rounded-lg shadow-lg p-4">
                    <h2 class="text-xl font-bold text-gray-800 mb-2 flex items-center">
                        <i class="fas fa-toggle-on text-primary-600 mr-1"></i>
                        Estado
                    </h2>

                    <div class="bg-gray-50 border-2 border-gray-200 rounded-lg p-4">
                        <label for="is_active" class="flex items-center cursor-pointer">
                            <input type="checkbox"
                                id="is_active"
                                name="is_active"
                                value="1"
                                {{ old('is_active', $speaker->is_active) ? 'checked' : '' }}
                                class="w-5 h-5 text-primary-600 border-gray-300 rounded focus:ring-primary-500 cursor-pointer">
                            <div class="ml-3 flex-1">
                                <div class="text-sm font-semibold text-gray-700">Ponente Activo</div>
                                <p class="text-xs text-gray-500 mt-1">
                                    <i class="fas fa-info-circle mr-1"></i>
                                    Los ponentes activos estarán disponibles para eventos
                                </p>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Información adicional -->
                <div class="bg-red-50 rounded-lg border-l-4 border-primary-600 p-3">
                    <div class="flex items-start">
                        <i class="fas fa-info-circle text-primary-600 mt-1 mr-3 text-lg"></i>
                        <div class="text-sm text-gray-700 flex-1">
                            <p class="font-semibold text-primary-700 mb-2">Información</p>
                            <div class="space-y-1">
                                <p class="text-xs flex items-center">
                                    <i class="fas fa-calendar-plus text-primary-600 mr-2 w-4"></i>
                                    <span class="font-medium mr-1">Creado:</span> {{ $speaker->created_at->format('d/m/Y H:i') }}
                                </p>
                                <p class="text-xs flex items-center">
                                    <i class="fas fa-calendar-check text-primary-600 mr-2 w-4"></i>
                                    <span class="font-medium mr-1">Actualizado:</span> {{ $speaker->updated_at->format('d/m/Y H:i') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Botones de Acción (anclados al final) -->
                <div class="bg-white rounded-lg shadow-lg p-6 lg:mt-auto">
                    <div class="space-y-3">
                        <button type="submit"
                                class="w-full px-6 py-3 bg-primary-600 text-white font-bold rounded-lg hover:bg-primary-700 transition-colors shadow-lg flex items-center justify-center">
                            <i class="fas fa-save mr-2"></i>
                            Actualizar Ponente
                        </button>

                        <a href="{{ route('speakers.index') }}"
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
    // 🆕 VARIABLE GLOBAL PARA BASE64
    let currentBase64Image = null;

    // 🆕 FUNCIÓN MEJORADA DE PREVIEW QUE CONVIERTE A BASE64
    function previewPhoto(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                // Mostrar preview
                document.getElementById('previewImg').src = e.target.result;
                document.getElementById('photoPreview').classList.remove('hidden');
                document.getElementById('uploadArea').classList.add('hidden');
                
                // Ocultar foto actual si existe
                const currentPhoto = document.getElementById('currentPhoto');
                if (currentPhoto) {
                    currentPhoto.classList.add('hidden');
                }
                
                // 🆕 GUARDAR COMO BASE64
                currentBase64Image = e.target.result;
            }
            
            reader.onerror = function(error) {
                alert('Error al procesar la imagen. Intenta con otra.');
            }
            
            reader.readAsDataURL(file);
        }
    }

    // 🆕 ELIMINAR NUEVA FOTO (PREVIEW)
    function removePhoto() {
        document.getElementById('photo').value = '';
        document.getElementById('photoPreview').classList.add('hidden');
        
        // Mostrar foto actual nuevamente si existe
        const currentPhoto = document.getElementById('currentPhoto');
        if (currentPhoto) {
            currentPhoto.classList.remove('hidden');
        } else {
            document.getElementById('uploadArea').classList.remove('hidden');
        }
        
        currentBase64Image = null;
    }

    // 🆕 CAMBIAR FOTO ACTUAL
    function removeCurrentPhoto() {
        document.getElementById('currentPhoto').classList.add('hidden');
        document.getElementById('uploadArea').classList.remove('hidden');
    }

    // 🆕 MANEJADOR DE ENVÍO DEL FORMULARIO
    document.addEventListener('DOMContentLoaded', function() {
        const speakerForm = document.getElementById('speakerForm');
        
        if (speakerForm) {
            speakerForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                // 🆕 ASIGNAR BASE64 AL CAMPO OCULTO
                if (currentBase64Image) {
                    document.getElementById('photoBase64').value = currentBase64Image;
                } else {
                    document.getElementById('photoBase64').value = '';
                }
                
                // 🆕 ENVIAR FORMULARIO
                speakerForm.submit();
            });
        }
    });
</script>
@endsection