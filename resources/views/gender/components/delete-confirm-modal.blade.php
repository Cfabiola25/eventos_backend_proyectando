<!-- Modal de Confirmación de Eliminación -->
<div id="deleteConfirmModal" @class(['hidden', 'fixed', 'inset-0', 'bg-gray-900', 'bg-opacity-50', 'overflow-y-auto', 'h-full', 'w-full', 'z-50', 'flex', 'items-center', 'justify-center'])>
    <div @class(['relative', 'bg-white', 'rounded-lg', 'shadow-2xl', 'w-full', 'max-w-md', 'mx-4', 'transform', 'transition-all'])>
        <!-- Header del Modal -->
        <div @class(['bg-red-600', 'text-white', 'px-6', 'py-4', 'rounded-t-lg', 'flex', 'justify-between', 'items-center'])>
            <h3 @class(['text-xl', 'font-bold', 'flex', 'items-center'])>
                <i @class(['fas', 'fa-exclamation-triangle', 'mr-2'])></i>
                Confirmar Eliminación
            </h3>
            <button onclick="closeDeleteModal()" @class(['text-white', 'hover:text-gray-200', 'transition-colors'])>
                <i @class(['fas', 'fa-times', 'text-2xl'])></i>
            </button>
        </div>

        <!-- Cuerpo del Modal -->
        <div @class(['p-6'])>
            <div @class(['flex', 'items-center', 'mb-4'])>
                <div @class(['flex-shrink-0', 'mr-4'])>
                    <i @class(['fas', 'fa-trash-alt', 'text-red-500', 'text-3xl'])></i>
                </div>
                <div>
                    <h4 @class(['text-lg', 'font-semibold', 'text-gray-900'])>¿Está seguro de eliminar este género?</h4>
                    <p @class(['text-sm', 'text-gray-600', 'mt-1'])>
                        El género <span id="genderNameToDelete" @class(['font-bold'])></span> será eliminado permanentemente.
                    </p>
                    <p @class(['text-xs', 'text-red-600', 'mt-2', 'font-medium'])>
                        <i @class(['fas', 'fa-exclamation-circle', 'mr-1'])></i>
                        Esta acción no se puede deshacer.
                    </p>
                </div>
            </div>

            <!-- Información adicional -->
            <div @class(['bg-yellow-50', 'border-l-4', 'border-yellow-400', 'p-4', 'rounded'])>
                <div @class(['flex', 'items-start'])>
                    <i @class(['fas', 'fa-info-circle', 'text-yellow-600', 'mt-0.5', 'mr-3'])></i>
                    <div>
                        <p @class(['text-sm', 'text-yellow-700'])>
                            Si este género está siendo utilizado por usuarios o eventos, podría afectar la integridad de los datos.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Botones de Acción -->
        <div @class(['flex', 'justify-end', 'space-x-3', 'p-6', 'pt-4', 'border-t', 'border-gray-200'])>
            <button type="button"
                    onclick="closeDeleteModal()"
                    @class(['px-6', 'py-2.5', 'bg-gray-500', 'text-white', 'font-semibold', 'rounded-lg', 'hover:bg-gray-600', 'transition-colors', 'duration-300', 'flex', 'items-center'])>
                <i @class(['fas', 'fa-times', 'mr-2'])></i>
                Cancelar
            </button>
            <button type="button"
                    id="confirmDeleteBtn"
                    onclick="confirmDelete()"
                    @class(['px-6', 'py-2.5', 'bg-red-600', 'text-white', 'font-semibold', 'rounded-lg', 'hover:bg-red-700', 'transition-colors', 'duration-300', 'flex', 'items-center', 'shadow-lg'])>
                <i @class(['fas', 'fa-trash-alt', 'mr-2'])></i>
                Sí, Eliminar
            </button>
        </div>
    </div>
</div>