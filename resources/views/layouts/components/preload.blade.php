    <!-- Preload de pantalla completa -->
    <div id="preload" class="fixed inset-0 z-[9999] flex items-center justify-center bg-white">
        <div class="text-center">
            <!-- Logo SVG -->
            <div class="mx-auto mb-6">
                <svg class="w-20 h-20 mx-auto text-red-600" viewBox="0 0 100 100" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <circle cx="50" cy="50" r="40" stroke="currentColor" stroke-width="8"
                        stroke-dasharray="251.2" stroke-dashoffset="251.2">
                        <animate attributeName="stroke-dashoffset" from="251.2" to="0" dur="1.5s"
                            fill="freeze" />
                    </circle>
                    <path d="M30 50L45 65L70 35" stroke="currentColor" stroke-width="8" stroke-linecap="round"
                        stroke-linejoin="round" stroke-dasharray="60" stroke-dashoffset="60">
                        <animate attributeName="stroke-dashoffset" from="60" to="0" dur="0.5s"
                            begin="1.5s" fill="freeze" />
                    </path>
                </svg>
            </div>

            <!-- Texto -->
            <h2 class="text-2xl font-bold text-gray-800 mb-2">Cargando</h2>

            <!-- Barra de progreso -->
            <div class="w-64 h-2 mx-auto bg-gray-200 rounded-full overflow-hidden">
                <div id="progressBar" class="progress-bar h-full bg-red-600"></div>
            </div>
        </div>
    </div>
   
