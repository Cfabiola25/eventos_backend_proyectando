@extends('layouts.app')

@section('content')
<div class="w-full px-4 py-6 mx-auto mt-16">
    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center">
            <a href="{{ route('events.index') }}" class="mr-4 text-gray-600 hover:text-primary-600 transition-colors">
                <i class="fas fa-arrow-left text-2xl"></i>
            </a>
            <h1 class="text-3xl font-bold text-gray-800">
                <i class="fas fa-edit text-primary-600 mr-2"></i>
                Editar Evento
            </h1>
        </div>
    </div>

    <!-- Formulario -->
    <form action="{{ route('events.update', $event->uuid) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Columna Izquierda -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Información Básica -->
                <div class="bg-white rounded-lg shadow-lg p-6 border border-gray-200">
                    <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-info-circle text-primary-600 mr-2"></i>
                        Información Básica
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Título -->
                        <div class="md:col-span-2">
                            <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-heading text-primary-600 mr-1"></i>
                                Título del Evento <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="title" name="title" value="{{ old('title', $event->title) }}" required
                                   placeholder="Ej: Conferencia de Inteligencia Artificial"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all @error('title') border-red-500 @enderror">
                            @error('title')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Descripción -->
                        <div class="md:col-span-2">
                            <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-align-left text-primary-600 mr-1"></i>
                                Descripción
                            </label>
                            <textarea id="description" name="description" rows="4"
                                      placeholder="Descripción detallada del evento..."
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all @error('description') border-red-500 @enderror">{{ old('description', $event->description) }}</textarea>
                            @error('description')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Modalidad -->
                        <div>
                            <label for="modality_id" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-laptop-house text-primary-600 mr-1"></i>
                                Modalidad <span class="text-red-500">*</span>
                            </label>
                            <select id="modality_id" name="modality_id" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all @error('modality_id') border-red-500 @enderror">
                                <option value="">Seleccione una modalidad...</option>
                                @foreach($modalities as $modality)
                                    <option value="{{ $modality->id }}" {{ old('modality_id', $event->modality_id) == $modality->id ? 'selected' : '' }}>
                                        {{ $modality->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('modality_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Capacidad Máxima -->
                        <div>
                            <label for="max_capacity" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-users text-primary-600 mr-1"></i>
                                Capacidad Máxima
                            </label>
                            <input type="number" id="max_capacity" name="max_capacity" value="{{ old('max_capacity', $event->max_capacity) }}"
                                   placeholder="Ej: 100"
                                   min="1"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all @error('max_capacity') border-red-500 @enderror">
                            @error('max_capacity')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Enlace Virtual -->
                        <div class="md:col-span-2">
                            <label for="virtual_link" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-link text-primary-600 mr-1"></i>
                                Enlace Virtual (para eventos virtuales)
                            </label>
                            <input type="url" id="virtual_link" name="virtual_link" value="{{ old('virtual_link', $event->virtual_link) }}"
                                   placeholder="https://meet.google.com/xxx-xxxx-xxx"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all @error('virtual_link') border-red-500 @enderror">
                            @error('virtual_link')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Color -->
                        <div>
                            <label for="color" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-palette text-primary-600 mr-1"></i>
                                Color del Evento
                            </label>
                            <div class="flex items-center space-x-3">
                                <input type="color" id="color" name="color" value="{{ old('color', $event->color ?: '#3B82F6') }}"
                                       class="w-16 h-12 border border-gray-300 rounded-lg cursor-pointer">
                                <input type="text" id="color_text" value="{{ old('color', $event->color ?: '#3B82F6') }}"
                                       class="flex-1 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                                       placeholder="#3B82F6" readonly>
                            </div>
                            @error('color')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Categorías y Etiquetas -->
                <div class="bg-white rounded-lg shadow-lg p-6 border border-gray-200">
                    <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-tags text-primary-600 mr-2"></i>
                        Clasificación
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Categorías -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-3">
                                <i class="fas fa-folder text-red-600 mr-1"></i>
                                Categorías
                            </label>
                            <div class="max-h-48 overflow-y-auto border border-gray-300 rounded-lg p-3 bg-gray-50">
                                @foreach($categories as $category)
                                    <label class="flex items-center mb-2 p-2 hover:bg-white rounded transition-colors">
                                        <input type="checkbox" name="categories[]" value="{{ $category->id }}"
                                               {{ in_array($category->id, old('categories', $event->categories->pluck('id')->toArray())) ? 'checked' : '' }}
                                               class="w-4 h-4 text-red-600 border-gray-300 rounded focus:ring-red-500">
                                        <span class="ml-3 text-sm text-gray-700 font-medium">{{ $category->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                            @error('categories')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Etiquetas -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-3">
                                <i class="fas fa-hashtag text-red-600 mr-1"></i>
                                Etiquetas
                            </label>
                            <div class="max-h-48 overflow-y-auto border border-gray-300 rounded-lg p-3 bg-gray-50">
                                @foreach($tags as $tag)
                                    <label class="flex items-center mb-2 p-2 hover:bg-white rounded transition-colors">
                                        <input type="checkbox" name="tags[]" value="{{ $tag->id }}"
                                               {{ in_array($tag->id, old('tags', $event->tags->pluck('id')->toArray())) ? 'checked' : '' }}
                                               class="w-4 h-4 text-red-600 border-gray-300 rounded focus:ring-red-500">
                                        <span class="ml-3 text-sm text-gray-700 font-medium">{{ $tag->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                            @error('tags')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- INICIO CAMBIOS: Sección de Programación y Ubicación MEJORADA -->
                <div class="bg-white rounded-lg shadow-lg p-6 border border-gray-200">
                    <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-calendar-alt text-red-600 mr-2"></i>
                        Programación y Ubicación
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Temas -->
                        <div class="md:col-span-3">
                            <label class="block text-sm font-semibold text-gray-700 mb-3">
                                <i class="fas fa-bookmark text-red-600 mr-1"></i>
                                Temas del Evento
                            </label>
                            <div class="max-h-48 overflow-y-auto border border-gray-300 rounded-lg p-3 bg-gray-50">
                                @foreach($themes as $theme)
                                    <label class="flex items-center mb-2 p-2 hover:bg-white rounded transition-colors">
                                        <input type="checkbox" name="themes[]" value="{{ $theme->id }}"
                                               {{ in_array($theme->id, old('themes', $event->themes->pluck('id')->toArray())) ? 'checked' : '' }}
                                               class="w-4 h-4 text-red-600 border-gray-300 rounded focus:ring-red-500">
                                        <span class="ml-3 text-sm text-gray-700 font-medium">{{ $theme->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                            @error('themes')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Horarios - FORMATEO MEJORADO -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-3">
                                <i class="fas fa-clock text-red-600 mr-1"></i>
                                Horarios Disponibles
                            </label>
                            <div class="max-h-48 cursor-pointer overflow-y-auto border border-gray-300 rounded-lg p-3 bg-gray-50">
                                @foreach($schedules as $schedule)
                                    @php
                                        // INICIO CAMBIOS: Formateo mejorado de fechas y horas
                                        $startDate = $schedule->start_date->format('d/m/Y');
                                        $endDate = $schedule->end_date->format('d/m/Y');
                                        $startTime = \Carbon\Carbon::parse($schedule->start_time)->format('g:i A');
                                        $endTime = \Carbon\Carbon::parse($schedule->end_time)->format('g:i A');
                                        
                                        // Determinar si es el mismo día
                                        $isSameDay = $schedule->start_date->eq($schedule->end_date);
                                        
                                        if ($isSameDay) {
                                            $dateDisplay = $startDate;
                                            $timeDisplay = "{$startTime} - {$endTime}";
                                        } else {
                                            $dateDisplay = "{$startDate} al {$endDate}";
                                            $timeDisplay = "{$startTime} - {$endTime}";
                                        }
                                        // FIN CAMBIOS: Formateo mejorado de fechas y horas
                                    @endphp
                                    <label class="flex items-center cursor-pointer mb-3 p-3 hover:bg-white rounded-lg transition-colors border border-red-200 bg-red-50">
                                        <input type="checkbox" name="schedules[]" value="{{ $schedule->id }}"
                                               {{ in_array($schedule->id, old('schedules', $event->schedules->pluck('id')->toArray())) ? 'checked' : '' }}
                                               class="w-4 h-4 text-red-600 border-gray-300 rounded focus:ring-red-500">
                                        <div class="ml-3 flex-1">
                                            <!-- Fecha -->
                                            <div class="flex items-center mb-1">
                                                <i class="fas fa-calendar-day text-red-500 text-xs mr-2"></i>
                                                <span class="text-sm font-semibold text-gray-800">{{ $dateDisplay }}</span>
                                            </div>
                                            <!-- Hora -->
                                            <div class="flex items-center">
                                                <i class="fas fa-clock text-red-400 text-xs mr-2"></i>
                                                <span class="text-xs text-gray-600 font-medium">{{ $timeDisplay }}</span>
                                            </div>
                                            <!-- Duración -->
                                            <div class="flex items-center mt-1">
                                                <i class="fas fa-hourglass-half text-red-300 text-xs mr-2"></i>
                                                <span class="text-xs text-gray-500">
                                                    @php
                                                        $duration = \Carbon\Carbon::parse($schedule->end_time)->diffInMinutes(\Carbon\Carbon::parse($schedule->start_time));
                                                        $hours = floor($duration / 60);
                                                        $minutes = $duration % 60;
                                                        
                                                        if ($hours > 0 && $minutes > 0) {
                                                            echo "{$hours}h {$minutes}min";
                                                        } elseif ($hours > 0) {
                                                            echo "{$hours} hora" . ($hours > 1 ? 's' : '');
                                                        } else {
                                                            echo "{$minutes} minuto" . ($minutes > 1 ? 's' : '');
                                                        }
                                                    @endphp
                                                </span>
                                            </div>
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                            @error('schedules')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Ubicaciones -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-gray-700 mb-3">
                                <i class="fas fa-map-marker-alt text-red-600 mr-1"></i>
                                Ubicaciones Disponibles
                            </label>
                            <div class="max-h-48 overflow-y-auto border border-gray-300 rounded-lg p-3 bg-gray-50">
                                @foreach($locations as $location)
                                    <label class="flex items-center cursor-pointer mb-3 p-3 hover:bg-white rounded-lg transition-colors border border-red-200 bg-red-50">
                                        <input type="checkbox" name="locations[]" value="{{ $location->id }}"
                                               {{ in_array($location->id, old('locations', $event->locations->pluck('id')->toArray())) ? 'checked' : '' }}
                                               class="w-4 h-4 text-red-600 border-gray-300 rounded focus:ring-red-500">
                                        <div class="ml-3 flex-1">
                                            <div class="flex items-center mb-1">
                                                <i class="fas fa-building text-red-500 text-xs mr-2"></i>
                                                <span class="text-sm font-semibold text-gray-800">{{ $location->name }}</span>
                                            </div>
                                            <div class="flex items-center mb-1">
                                                <i class="fas fa-map-pin text-red-400 text-xs mr-2"></i>
                                                <span class="text-xs text-gray-600">{{ $location->address }}</span>
                                            </div>
                                            @if($location->room)
                                            <div class="flex items-center">
                                                <i class="fas fa-door-open text-red-300 text-xs mr-2"></i>
                                                <span class="text-xs text-gray-500">Sala: {{ $location->room }}</span>
                                            </div>
                                            @endif
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                            @error('locations')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Nota informativa mejorada -->
                    <div class="mt-4 p-4 bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200 rounded-lg">
                        <div class="flex items-start">
                            <i class="fas fa-info-circle text-blue-500 mt-1 mr-2"></i>
                            <div class="text-sm text-blue-700">
                                <p class="font-medium">Nota:</p>
                                <p>Los horarios y ubicaciones se relacionan automáticamente. Selecciona al menos un horario y una ubicación para configurar el evento.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- FIN CAMBIOS: Sección de Programación y Ubicación MEJORADA -->

            </div>

            <!-- Columna Derecha -->
            <div class="space-y-6">
                <!-- Imagen del Evento -->
                <div class="bg-white rounded-lg shadow-lg p-6 border border-gray-200">
                    <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-image text-primary-600 mr-2"></i>
                        Imagen del Evento
                    </h2>

                    <div class="space-y-4">
                        @if($event->image)
                        <div class="mb-4">
                            <img src="{{ $event->image }}" alt="Imagen actual del evento" 
                                 class="w-full h-48 object-cover rounded-lg border-2 border-gray-300 shadow-sm">
                        </div>
                        @endif

                        <div id="photoPreview" class="hidden">
                            <img id="previewImg" src="" alt="Vista previa" 
                                 class="w-full h-48 object-cover rounded-lg border-2 border-primary-300 shadow-sm mb-3">
                            <button type="button" onclick="removePhoto()"
                                    class="w-full px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors flex items-center justify-center">
                                <i class="fas fa-trash mr-2"></i>Eliminar Nueva Imagen
                            </button>
                        </div>

                        <div id="uploadArea" class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-primary-400 transition-colors cursor-pointer bg-gray-50">
                            <input type="file" id="image" name="image" accept="image/*" class="hidden" onchange="previewPhoto(event)">
                            <label for="image" class="cursor-pointer">
                                <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-3"></i>
                                <p class="text-sm text-gray-600 font-semibold">Click para cambiar imagen</p>
                                <p class="text-xs text-gray-400 mt-1">PNG, JPG, WEBP (MAX. 2MB)</p>
                            </label>
                        </div>
                        @error('image')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- INICIO CAMBIOS: Expositores Mejorados -->
                <div class="bg-white rounded-lg shadow-lg p-6 border border-gray-200">
                    <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-microphone text-red-600 mr-2"></i>
                        Expositores
                    </h2>

                    <!-- Buscador de Expositores -->
                    <div class="mb-4">
                        <div class="relative">
                            <input type="text" id="speakerSearch" 
                                   placeholder="Buscar expositor..."
                                   class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-search text-gray-400"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Contador de seleccionados -->
                    <div class="mb-3">
                        <span class="text-sm text-gray-600">
                            <span id="selectedCount">0</span> de {{ $speakers->count() }} seleccionados
                        </span>
                    </div>

                    <!-- Lista de Expositores Compacta -->
                    <div class="max-h-64 overflow-y-auto border border-gray-300 rounded-lg bg-gray-50">
                        <div id="speakersList" class="p-2">
                            @foreach($speakers as $speaker)
                                @php
                                    $isSelected = in_array($speaker->id, old('speakers', $event->speakers->pluck('id')->toArray()));
                                @endphp
                                <label class="speaker-item flex items-center p-2 mb-1 rounded hover:bg-white transition-colors {{ $isSelected ? 'bg-green-50 border border-green-200' : '' }}"
                                       data-name="{{ strtolower($speaker->name) }}"
                                       data-profession="{{ strtolower($speaker->profession ?? '') }}">
                                    <input type="checkbox" name="speakers[]" value="{{ $speaker->id }}"
                                           {{ $isSelected ? 'checked' : '' }}
                                           class="speaker-checkbox w-4 h-4 text-red-600 border-gray-300 rounded focus:ring-red-500">
                                    <div class="ml-3 flex items-center flex-1 min-w-0">
                                        @if($speaker->photo)
                                            <img src="{{ $speaker->photo }}" alt="{{ $speaker->name }}" 
                                                 class="w-8 h-8 rounded-full mr-3 flex-shrink-0 object-cover border border-gray-300">
                                        @else
                                            <div class="w-8 h-8 bg-gradient-to-br from-red-400 to-red-600 rounded-full flex items-center justify-center mr-3 flex-shrink-0">
                                                <i class="fas fa-user text-white text-sm"></i>
                                            </div>
                                        @endif
                                        <div class="min-w-0 flex-1">
                                            <p class="text-sm font-medium text-gray-800 truncate">{{ $speaker->name }}</p>
                                            @if($speaker->profession)
                                                <p class="text-xs text-gray-500 truncate">{{ $speaker->profession }}</p>
                                            @endif
                                        </div>
                                        @if($isSelected)
                                            <i class="fas fa-check-circle text-green-500 ml-2 flex-shrink-0"></i>
                                        @endif
                                    </div>
                                </label>
                            @endforeach
                        </div>
                    </div>
                    @error('speakers')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <!-- FIN CAMBIOS: Expositores Mejorados -->

                <!-- Programas Académicos -->
                <div class="bg-white rounded-lg shadow-lg p-6 border border-gray-200">
                    <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-graduation-cap text-red-600 mr-2"></i>
                        Programas
                    </h2>

                    <div class="max-h-40 overflow-y-auto border border-gray-300 rounded-lg p-3 bg-gray-50">
                        @foreach($programs as $program)
                            <label class="flex items-center mb-2 p-2 hover:bg-white rounded transition-colors">
                                <input type="checkbox" name="programs[]" value="{{ $program->id }}"
                                       {{ in_array($program->id, old('programs', $event->programs->pluck('id')->toArray())) ? 'checked' : '' }}
                                       class="w-4 h-4 text-red-600 border-gray-300 rounded focus:ring-red-500">
                                <span class="ml-3 text-sm text-gray-700 font-medium">{{ $program->name }}</span>
                            </label>
                        @endforeach
                    </div>
                    @error('programs')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Estado del Evento -->
                <div class="bg-white rounded-lg shadow-lg p-6 border border-gray-200">
                    <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-toggle-on text-orange-600 mr-2"></i>
                        Estado del Evento
                    </h2>

                    <div class="bg-gradient-to-r from-orange-50 to-orange-100 border-2 border-orange-200 rounded-lg p-4">
                        <label for="is_active" class="flex items-center cursor-pointer">
                            <div class="relative">
                                <input type="checkbox" id="is_active" name="is_active" value="1" 
                                       {{ old('is_active', $event->is_active) ? 'checked' : '' }}
                                       class="sr-only">
                                <div class="block bg-gray-600 w-14 h-8 rounded-full"></div>
                                <div class="dot absolute left-1 top-1 bg-white w-6 h-6 rounded-full transition transform {{ old('is_active', $event->is_active) ? 'translate-x-6 bg-green-500' : '' }}"></div>
                            </div>
                            <div class="ml-4 flex-1">
                                <div class="text-sm font-semibold text-gray-700">
                                    {{ $event->is_active ? 'Evento Activo' : 'Evento Inactivo' }}
                                </div>
                                <p class="text-xs text-gray-600 mt-1">
                                    <i class="fas fa-info-circle mr-1"></i>
                                    {{ $event->is_active ? 'Visible para los usuarios' : 'No visible para los usuarios' }}
                                </p>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Información del Evento -->
                <div class="bg-white rounded-lg shadow-lg p-6 border border-gray-200">
                    <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-info-circle text-blue-600 mr-2"></i>
                        Información del Evento
                    </h2>

                    <div class="space-y-3 text-sm bg-blue-50 rounded-lg p-4">
                        <div class="flex justify-between items-center py-2 border-b border-blue-200">
                            <span class="text-blue-700 font-medium">UUID:</span>
                            <span class="text-blue-800 font-mono text-xs bg-blue-100 px-2 py-1 rounded">{{ $event->uuid }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-blue-200">
                            <span class="text-blue-700 font-medium">Creado:</span>
                            <span class="text-blue-800">{{ $event?->created_at?->format('d/m/Y H:i') ?? 'Fecha no disponible' }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2">
                            <span class="text-blue-700 font-medium">Actualizado:</span>
                            <span class="text-blue-800">{{ $event->updated_at?->format('d/m/Y H:i') ?? 'Fecha no disponible' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Botones de Acción -->
                <div class="bg-white rounded-lg shadow-lg p-6 border border-gray-200">
                    <div class="space-y-3">
                        <button type="submit"
                                class="w-full px-6 py-3 bg-gradient-to-r from-primary-600 to-primary-700 text-white font-bold rounded-lg hover:from-primary-700 hover:to-primary-800 transition-all shadow-lg flex items-center justify-center transform hover:-translate-y-0.5">
                            <i class="fas fa-save mr-2"></i>
                            Actualizar Evento
                        </button>

                        <a href="{{ route('events.index') }}"
                           class="w-full px-6 py-3 bg-gradient-to-r from-gray-500 to-gray-600 text-white font-bold rounded-lg hover:from-gray-600 hover:to-gray-700 transition-all flex items-center justify-center">
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

    function removePhoto() {
        document.getElementById('image').value = '';
        document.getElementById('photoPreview').classList.add('hidden');
        document.getElementById('uploadArea').classList.remove('hidden');
    }

    // Sincronizar color picker con input de texto
    document.addEventListener('DOMContentLoaded', function() {
        const colorPicker = document.getElementById('color');
        const colorText = document.getElementById('color_text');
        
        if (colorPicker && colorText) {
            colorPicker.addEventListener('input', function() {
                colorText.value = this.value;
            });
            
            colorText.addEventListener('input', function() {
                colorPicker.value = this.value;
            });
        }

        // INICIO CAMBIOS: Funcionalidad para expositores mejorados
        // Contador de expositores seleccionados
        function updateSelectedCount() {
            const selected = document.querySelectorAll('.speaker-checkbox:checked').length;
            document.getElementById('selectedCount').textContent = selected;
        }

        // Inicializar contador
        updateSelectedCount();

        // Actualizar contador cuando cambien los checkboxes
        document.querySelectorAll('.speaker-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', updateSelectedCount);
        });

        // Buscador de expositores
        const speakerSearch = document.getElementById('speakerSearch');
        if (speakerSearch) {
            speakerSearch.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                const speakerItems = document.querySelectorAll('.speaker-item');
                
                speakerItems.forEach(item => {
                    const name = item.getAttribute('data-name');
                    const profession = item.getAttribute('data-profession');
                    
                    if (name.includes(searchTerm) || profession.includes(searchTerm)) {
                        item.style.display = 'flex';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        }

        // Toggle del estado activo
        const statusToggle = document.getElementById('is_active');
        const statusDot = document.querySelector('.dot');
        const statusText = document.querySelector('.text-sm.font-semibold.text-gray-700');
        const statusDescription = document.querySelector('.text-xs.text-gray-600.mt-1');

        if (statusToggle) {
            statusToggle.addEventListener('change', function() {
                if (this.checked) {
                    statusDot.classList.add('translate-x-6', 'bg-green-500');
                    statusText.textContent = 'Evento Activo';
                    statusDescription.textContent = 'Visible para los usuarios';
                } else {
                    statusDot.classList.remove('translate-x-6', 'bg-green-500');
                    statusText.textContent = 'Evento Inactivo';
                    statusDescription.textContent = 'No visible para los usuarios';
                }
            });
        }

        // Validación para horarios y ubicaciones
        const scheduleCheckboxes = document.querySelectorAll('input[name="schedules[]"]');
        const locationCheckboxes = document.querySelectorAll('input[name="locations[]"]');
        
        function validateSchedulesAndLocations() {
            const selectedSchedules = document.querySelectorAll('input[name="schedules[]"]:checked').length;
            const selectedLocations = document.querySelectorAll('input[name="locations[]"]:checked').length;
            
            if (selectedSchedules > 0 && selectedLocations === 0) {
                alert('Por favor, selecciona al menos una ubicación para los horarios elegidos.');
                return false;
            }
            
            if (selectedLocations > 0 && selectedSchedules === 0) {
                alert('Por favor, selecciona al menos un horario para las ubicaciones elegidas.');
                return false;
            }
            
            return true;
        }

        // Agregar validación al enviar el formulario
        const form = document.querySelector('form');
        form.addEventListener('submit', function(e) {
            if (!validateSchedulesAndLocations()) {
                e.preventDefault();
            }
        });
        // FIN CAMBIOS: Funcionalidad para expositores mejorados
    });
</script>

<style>
    /* Estilos para el toggle switch */
    .dot {
        transition: all 0.3s ease-in-out;
    }
    
    /* Scrollbar personalizado */
    .overflow-y-auto::-webkit-scrollbar {
        width: 6px;
    }
    
    .overflow-y-auto::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 3px;
    }
    
    .overflow-y-auto::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 3px;
    }
    
    .overflow-y-auto::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }
</style>
@endsection