@extends('layouts.app')

@section('title', $event->title)

@section('content')
<div class="w-full px-4 py-6 mx-auto mt-16">
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <!-- Header -->
        <div class="bg-primary-600 text-white p-6">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center">
                <div>
                    <h1 class="text-2xl font-bold">{{ $event->title }}</h1>
                    <p class="text-primary-100 mt-2">
                        <i class="fas fa-calendar-alt mr-2"></i>
                        Creado: {{ $event->created_at->format('d/m/Y H:i') }}
                    </p>
                </div>
                <div class="mt-4 sm:mt-0 flex space-x-3">
                    <a href="{{ route('events.edit', $event->uuid) }}"
                       class="bg-white text-primary-600 hover:bg-gray-100 px-4 py-2 rounded-lg font-semibold transition-colors">
                        <i class="fas fa-edit mr-2"></i>Editar
                    </a>
                    <a href="{{ route('events.index') }}"
                       class="bg-primary-700 hover:bg-primary-800 text-white px-4 py-2 rounded-lg font-semibold transition-colors">
                        <i class="fas fa-arrow-left mr-2"></i>Volver
                    </a>
                </div>
            </div>
        </div>

        <div class="p-6">
            <!-- Información Principal -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                <!-- Columna Izquierda -->
                <div class="lg:col-span-2">
                    <!-- Imagen -->
                    @if($event->image)
                    <div class="mb-6">
                        <img src="{{ $event->image }}" alt="{{ $event->title }}" 
                             class="w-full h-64 object-cover rounded-lg shadow-md">
                    </div>
                    @endif

                    <!-- Descripción -->
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-3">
                            <i class="fas fa-align-left text-primary-600 mr-2"></i>
                            Descripción
                        </h3>
                        <p class="text-gray-700 leading-relaxed">
                            {{ $event->description ?? 'Sin descripción' }}
                        </p>
                    </div>

                    <!-- Detalles -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h4 class="font-semibold text-gray-700 mb-2">
                                <i class="fas fa-info-circle text-primary-600 mr-2"></i>
                                Información General
                            </h4>
                            <div class="space-y-2 text-sm">
                                <p><strong>Modalidad:</strong> {{ $event->modality->name ?? 'N/A' }}</p>
                                <p><strong>Capacidad:</strong> {{ $event->max_capacity ?? 'Ilimitada' }}</p>
                                <p><strong>Estado:</strong> 
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium {{ $event->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $event->is_active ? 'Activo' : 'Inactivo' }}
                                    </span>
                                </p>
                            </div>
                        </div>

                        @if($event->virtual_link)
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h4 class="font-semibold text-gray-700 mb-2">
                                <i class="fas fa-link text-primary-600 mr-2"></i>
                                Enlace Virtual
                            </h4>
                            <a href="{{ $event->virtual_link }}" target="_blank" 
                               class="text-primary-600 hover:text-primary-800 break-all">
                                {{ $event->virtual_link }}
                            </a>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Columna Derecha -->
                <div class="space-y-6">
                    <!-- Categorías -->
                    @if($event->categories->count() > 0)
                    <div class="bg-white border border-gray-200 rounded-lg p-4">
                        <h3 class="font-semibold text-gray-800 mb-3">
                            <i class="fas fa-tags text-primary-600 mr-2"></i>
                            Categorías
                        </h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach($event->categories as $category)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                {{ $category->name }}
                            </span>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Programas -->
                    @if($event->programs->count() > 0)
                    <div class="bg-white border border-gray-200 rounded-lg p-4">
                        <h3 class="font-semibold text-gray-800 mb-3">
                            <i class="fas fa-graduation-cap text-primary-600 mr-2"></i>
                            Programas
                        </h3>
                        <div class="space-y-2">
                            @foreach($event->programs as $program)
                            <div class="text-sm text-gray-700">{{ $program->name }}</div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Temas -->
                    @if($event->themes->count() > 0)
                    <div class="bg-white border border-gray-200 rounded-lg p-4">
                        <h3 class="font-semibold text-gray-800 mb-3">
                            <i class="fas fa-palette text-primary-600 mr-2"></i>
                            Temas
                        </h3>
                        <div class="space-y-2">
                            @foreach($event->themes as $theme)
                            <div class="text-sm text-gray-700">{{ $theme->name }}</div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Speakers -->
            @if($event->speakers->count() > 0)
            <div class="mb-8">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">
                    <i class="fas fa-users text-primary-600 mr-2"></i>
                    Expositores
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($event->speakers as $speaker)
                    <div class="bg-white border border-gray-200 rounded-lg p-4 flex items-center space-x-3">
                        @if($speaker->photo)
                        <img src="{{ $speaker->photo }}" alt="{{ $speaker->name }}" 
                             class="h-12 w-12 rounded-full object-cover">
                        @else
                        <div class="h-12 w-12 rounded-full bg-gray-200 flex items-center justify-center">
                            <i class="fas fa-user text-gray-400"></i>
                        </div>
                        @endif
                        <div>
                            <p class="font-semibold text-gray-800">{{ $speaker->name }}</p>
                            @if($speaker->profession)
                            <p class="text-sm text-gray-600">{{ $speaker->profession }}</p>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Horarios y Ubicaciones -->
            @if($event->schedules->count() > 0)
            <div class="mb-8">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">
                    <i class="fas fa-clock text-primary-600 mr-2"></i>
                    Horarios y Ubicaciones
                </h3>
                <div class="bg-gray-50 rounded-lg p-4">
                    <div class="space-y-3">
                        @foreach($event->schedules as $schedule)
                        <div class="flex justify-between items-center py-2 border-b border-gray-200 last:border-b-0">
                            <div>
                                <p class="font-semibold text-gray-800">
                                    {{ $schedule->start_date }} 
                                    {{ $schedule->start_time }} - {{ $schedule->end_time }}
                                </p>
                                @if($schedule->pivot->location_id && $location = $event->locations->firstWhere('id', $schedule->pivot->location_id))
                                <p class="text-sm text-gray-600">
                                    <i class="fas fa-map-marker-alt mr-1"></i>
                                    {{ $location->name }}
                                </p>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

            <!-- Tags -->
            @if($event->tags->count() > 0)
            <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-3">
                    <i class="fas fa-hashtag text-primary-600 mr-2"></i>
                    Etiquetas
                </h3>
                <div class="flex flex-wrap gap-2">
                    @foreach($event->tags as $tag)
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium text-white" 
                          style="background-color: {{ $tag->color }}">
                        {{ $tag->name }}
                    </span>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection