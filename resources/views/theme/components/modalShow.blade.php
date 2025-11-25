<div id="descriptionModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-md mx-4">
        <div class="bg-red-600 text-white p-4 rounded-t-lg flex justify-between items-center">
            <h3 id="modalTitle" class="text-lg font-semibold"></h3>
            <button onclick="closeDescriptionModal()"
                class="text-white hover:text-gray-200 rounded-full w-6 h-6 flex items-center justify-center">
                <svg viewBox="0 0 24 24" fill="currentColor">
                    <path
                        d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z" />
                </svg>
            </button>
        </div>
        <div class="p-6">
            <p id="modalDescription" class="text-gray-600 whitespace-pre-wrap max-h-96 overflow-y-auto"></p>
            <div class="flex justify-center mt-6">
                <button onclick="closeDescriptionModal()"
                    class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition">
                    Cerrar
                </button>
            </div>
        </div>
    </div>
</div>