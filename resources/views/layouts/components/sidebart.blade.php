 <!-- Sidebar -->
    <aside id="sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-16 transition-transform -translate-x-full bg-white border-r border-gray-200 shadow-lg min-h-screen" aria-label="Sidebar">
        <div class="h-full px-3 py-4 overflow-y-auto sidebar-scroll">
            <h2 class="text-xl font-bold mb-6 text-primary-600 text-center mt-4">Menú Principal</h2>
            
            <ul class="space-y-2">
                @if(Auth::user()->is_admin)
                <!-- Dashboard -->
                <li>
                    <a href="{{ route('dashboard') }}" class="sidebar-item active flex items-center p-3 text-base font-normal text-gray-900 rounded-lg">
                        <i class="fas fa-home sidebar-icon text-primary-600"></i>
                        <span class="ml-3">Dashboard</span>
                    </a>
                </li>
                
                <!-- Agenda -->
                <li>
                    <a href="{{ route('agenda.index') }}" class="sidebar-item flex items-center p-3 text-base font-normal text-gray-900 rounded-lg">
                        <i class="fas fa-calendar-alt sidebar-icon text-primary-600"></i>
                        <span class="ml-3">Agenda</span>
                    </a>
                </li>

                <!-- Temas -->
                <li>
                    <a href="{{ route('theme.index') }}" class="sidebar-item flex items-center p-3 text-base font-normal text-gray-900 rounded-lg">
                        <i class="fas fa-palette sidebar-icon text-primary-600"></i>
                        <span class="ml-3">Temas</span>
                    </a>
                </li>
                
                <!-- Categorías -->
                <li>
                    <a href="{{ route('categories.index') }}" class="sidebar-item flex items-center p-3 text-base font-normal text-gray-900 rounded-lg">
                        <i class="fas fa-folder sidebar-icon text-primary-600"></i>
                        <span class="ml-3">Categorías</span>
                    </a>
                </li>
                
                <!-- City Tours -->
                <li>
                    <button type="button" class="collapsible-btn sidebar-item flex items-center justify-between w-full p-3 text-base font-normal text-gray-900 rounded-lg hover:bg-gray-100">
                        <div class="flex items-center">
                            <i class="fas fa-map-marked-alt sidebar-icon text-primary-600"></i>
                            <span class="ml-3">City Tours</span>
                        </div>
                        <i class="fas fa-chevron-down text-xs transition-transform"></i>
                    </button>
                    <div class="collapsible-content">
                        <ul class="py-2 space-y-1">
                            <li><a href="#" class="flex items-center p-2 pl-11 w-full text-sm font-normal text-gray-900 rounded-lg hover:bg-gray-100"><i class="fas fa-map-marker-alt mr-2 text-primary-600"></i> Tours</a></li>
                            <li><a href="#" class="flex items-center p-2 pl-11 w-full text-sm font-normal text-gray-900 rounded-lg hover:bg-gray-100"><i class="fas fa-map-pin mr-2 text-primary-600"></i> Paradas</a></li>
                            <li><a href="#" class="flex items-center p-2 pl-11 w-full text-sm font-normal text-gray-900 rounded-lg hover:bg-gray-100"><i class="fas fa-tag mr-2 text-primary-600"></i> Precios</a></li>
                        </ul>
                    </div>
                </li>
                
                <!-- Tipos de Documento -->
                <li>
                    <a href="{{ route('documenttypes.index') }}" class="sidebar-item flex items-center p-3 text-base font-normal text-gray-900 rounded-lg">
                        <i class="fas fa-id-card sidebar-icon text-primary-600"></i>
                        <span class="ml-3">Tipos de Documento</span>
                    </a>
                </li>
                @endif
                <!-- Eventos ojo aqui se eve quitar cuando este listo asistencia-->
                {{-- @if(Auth::user()->is_admin) --}}
                <li>
                    <button type="button" class="collapsible-btn sidebar-item flex items-center justify-between w-full p-3 text-base font-normal text-gray-900 rounded-lg hover:bg-gray-100">
                        <div class="flex items-center">
                            <i class="fas fa-calendar-day sidebar-icon text-primary-600"></i>
                            <span class="ml-3">Eventos</span>
                        </div>
                        <i class="fas fa-chevron-down text-xs transition-transform"></i>
                    </button>
                    <div class="collapsible-content">
                        <ul class="py-2 space-y-1">
                            @if(Auth::user()->is_admin)
                            <li><a href="{{ route('events.index') }}" class="flex items-center p-2 pl-11 w-full text-sm font-normal text-gray-900 rounded-lg hover:bg-gray-100"><i class="fas fa-tasks mr-2 text-primary-600"></i> Gestión de Eventos</a></li>
                            @endif
                            <li><a href="{{ route('event-attendances.index') }}" class="flex items-center p-2 pl-11 w-full text-sm font-normal text-gray-900 rounded-lg hover:bg-gray-100"><i class="fas fa-user-check mr-2 text-primary-600"></i>Asistencias</a></li>

                            @if(Auth::user()->is_admin)
                            <li><a href="#" class="flex items-center p-2 pl-11 w-full text-sm font-normal text-gray-900 rounded-lg hover:bg-gray-100"><i class="fas fa-star mr-2 text-primary-600"></i> Reseñas</a></li>
                            @endif
                        </ul>
                    </div>
                </li>
                {{-- @endif  --}}<!--hasta aqui va lo que se debe qutar-->
                
                @if(Auth::user()->is_admin)
                <!-- Géneros -->
                <li>
                    <a href="{{ route('genders.index') }}" class="sidebar-item flex items-center p-3 text-base font-normal text-gray-900 rounded-lg">
                        <i class="fas fa-venus-mars sidebar-icon text-primary-600"></i>
                        <span class="ml-3">Géneros</span>
                    </a>
                </li>
                
                <!-- Ubicaciones/Locations -->
                <li>
                    <a href="{{ route('locations.index')  }}" class="sidebar-item flex items-center p-3 text-base font-normal text-gray-900 rounded-lg">
                        <i class="fas fa-map-marker-alt sidebar-icon text-primary-600"></i>
                        <span class="ml-3">Ubicaciones</span>
                    </a>
                </li>
                
                <!-- Modalidades -->
                <li>
                    <a href="{{ route('modalities.index') }}" class="sidebar-item flex items-center p-3 text-base font-normal text-gray-900 rounded-lg">
                        <i class="fas fa-laptop-house sidebar-icon text-primary-600"></i>
                        <span class="ml-3">Modalidades</span>
                    </a>
                </li>
                
                <!-- Noticias -->
                <li>
                    <a href="#" class="sidebar-item flex items-center p-3 text-base font-normal text-gray-900 rounded-lg">
                        <i class="fas fa-newspaper sidebar-icon text-primary-600"></i>
                        <span class="ml-3">Noticias</span>
                    </a>
                </li>
                
                <!-- Planes -->
                <li>
                    <button type="button" class="collapsible-btn sidebar-item flex items-center justify-between w-full p-3 text-base font-normal text-gray-900 rounded-lg hover:bg-gray-100">
                        <div class="flex items-center">
                            <i class="fas fa-crown sidebar-icon text-primary-600"></i>
                            <span class="ml-3">Planes</span>
                        </div>
                        <i class="fas fa-chevron-down text-xs transition-transform"></i>
                    </button>
                    <div class="collapsible-content">
                        <ul class="py-2 space-y-1">
                            <li><a href="#" class="flex items-center p-2 pl-11 w-full text-sm font-normal text-gray-900 rounded-lg hover:bg-gray-100"><i class="fas fa-money-bill-wave mr-2 text-primary-600"></i> Suscripciones</a></li>
                            <li><a href="#" class="flex items-center p-2 pl-11 w-full text-sm font-normal text-gray-900 rounded-lg hover:bg-gray-100"><i class="fas fa-tags mr-2 text-primary-600"></i> Precios</a></li>
                            <li><a href="#" class="flex items-center p-2 pl-11 w-full text-sm font-normal text-gray-900 rounded-lg hover:bg-gray-100"><i class="fas fa-ticket-alt mr-2 text-primary-600"></i> Accesos</a></li>
                        </ul>
                    </div>
                </li>
                
                <!-- Programas -->
                <li>
                    <a href="{{ route('programs.index') }}" class="sidebar-item flex items-center p-3 text-base font-normal text-gray-900 rounded-lg">
                        <i class="fas fa-project-diagram sidebar-icon text-primary-600"></i>
                        <span class="ml-3">Programas</span>
                    </a>
                </li>
                 @endif
                <!-- Inscripciones -->
                <li>
                    <button type="button" class="collapsible-btn sidebar-item flex items-center justify-between w-full p-3 text-base font-normal text-gray-900 rounded-lg hover:bg-gray-100">
                        <div class="flex items-center">
                            <i class="fas fa-clipboard-list sidebar-icon text-primary-600"></i>
                            <span class="ml-3">Inscripciones</span>
                        </div>
                        <i class="fas fa-chevron-down text-xs transition-transform"></i>
                    </button>
                    <div class="collapsible-content">
                        <ul class="py-2 space-y-1">
                            @if(Auth::user()->is_admin)
                            <li><a href="#" class="flex items-center p-2 pl-11 w-full text-sm font-normal text-gray-900 rounded-lg hover:bg-gray-100"><i class="fas fa-file-signature mr-2 text-primary-600"></i> Registros</a></li>
                            <li><a href="#" class="flex items-center p-2 pl-11 w-full text-sm font-normal text-gray-900 rounded-lg hover:bg-gray-100"><i class="fas fa-route mr-2 text-primary-600"></i> Tours</a></li>
                            <li><a href="#" class="flex items-center p-2 pl-11 w-full text-sm font-normal text-gray-900 rounded-lg hover:bg-gray-100"><i class="fas fa-calendar-check mr-2 text-primary-600"></i> Eventos</a></li>
                            @endif
                            <li><a href="{{ route('user-event-management.index') }}" class="flex items-center p-2 pl-11 w-full text-sm font-normal text-gray-900 rounded-lg hover:bg-gray-100"><i class="fas fa-user-edit mr-2 text-primary-600"></i>Gestión de Registros</a></li>
                        </ul>
                    </div>
                </li>
                
                @if(Auth::user()->is_admin)
                <!-- Horarios -->
                <li>
                    <a href="{{ route('schedules.index') }}" class="sidebar-item flex items-center p-3 text-base font-normal text-gray-900 rounded-lg">
                        <i class="fas fa-clock sidebar-icon text-primary-600"></i>
                        <span class="ml-3">Horarios</span>
                    </a>
                </li>
                
                <!-- Configuración -->
                <li>
                    <a href="#" class="sidebar-item flex items-center p-3 text-base font-normal text-gray-900 rounded-lg">
                        <i class="fas fa-cog sidebar-icon text-primary-600"></i>
                        <span class="ml-3">Configuración</span>
                    </a>
                </li>
                
                <!-- Ponentes -->
                <li>
                    <a href="{{ route('speakers.index') }}" class="sidebar-item flex items-center p-3 text-base font-normal text-gray-900 rounded-lg">
                        <i class="fas fa-chalkboard-teacher sidebar-icon text-primary-600"></i>
                        <span class="ml-3">Ponentes</span>
                    </a>
                </li>
                
                <!-- Etiquetas -->
                <li>
                    <a href="{{ route('tags.index') }}" class="sidebar-item flex items-center p-3 text-base font-normal text-gray-900 rounded-lg">
                        <i class="fas fa-tags sidebar-icon text-primary-600"></i>
                        <span class="ml-3">Etiquetas</span>
                    </a>
                </li>
                @endif
                <!-- Usuarios -->
                <li>
                    <a href="{{ route('users.index') }}" class="sidebar-item flex items-center p-3 text-base font-normal text-gray-900 rounded-lg">
                        <i class="fas fa-users sidebar-icon text-primary-600"></i>
                        <span class="ml-3">Usuarios</span>
                    </a>
                </li>
                
                @if(Auth::user()->is_admin)
                <!-- Tipos de Usuario -->
                <li>
                    <a href="{{ route('usertypes.index') }}" class="sidebar-item flex items-center p-3 text-base font-normal text-gray-900 rounded-lg">
                        <i class="fas fa-user-tag sidebar-icon text-primary-600"></i>
                        <span class="ml-3">Tipos de Usuario</span>
                    </a>
                </li>
            </ul>

            <div class="mt-10 pt-6 border-t border-gray-200">
                <h3 class="text-sm font-semibold text-gray-500 uppercase mb-4">Accesos Rápidos</h3>
                <div class="space-y-3">
                    <div class="flex items-center p-2 text-sm text-gray-700 rounded-lg hover:bg-primary-50 transition-colors cursor-pointer">
                        <div class="w-2 h-2 bg-primary-600 rounded-full mr-2"></div>
                        <span>Agenda del día</span>
                    </div>
                    <div class="flex items-center p-2 text-sm text-gray-700 rounded-lg hover:bg-primary-50 transition-colors cursor-pointer">
                        <div class="w-2 h-2 bg-primary-600 rounded-full mr-2"></div>
                        <span>Noticias Recientes</span>
                    </div>
                    <div class="flex items-center p-2 text-sm text-gray-700 rounded-lg hover:bg-primary-50 transition-colors cursor-pointer">
                        <div class="w-2 h-2 bg-primary-600 rounded-full mr-2"></div>
                        <span>Ponentes</span>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </aside>

    <!-- Overlay para móviles -->
    <div id="sidebar-backdrop" class="hidden fixed inset-0 z-30 bg-gray-900 bg-opacity-50"></div>
