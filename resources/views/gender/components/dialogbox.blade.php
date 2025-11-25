<!-- Modal para Crear/Editar -->
<div id="genderModal" @class(['hidden', 'fixed', 'inset-0', 'bg-gray-900', 'bg-opacity-50', 'overflow-y-auto', 'h-full', 'w-full', 'z-50', 'flex', 'items-center', 'justify-center'])>
    <div @class(['relative', 'bg-white', 'rounded-lg', 'shadow-2xl', 'w-full', 'max-w-md', 'mx-4', 'transform', 'transition-all'])>
        <!-- Header del Modal -->
        <div @class(['bg-primary-600', 'text-white', 'px-6', 'py-4', 'rounded-t-lg', 'flex', 'justify-between', 'items-center'])>
            <h3 id="modalTitle" @class(['text-xl', 'font-bold', 'flex', 'items-center'])>
                <i @class(['fas', 'fa-venus-mars', 'mr-2'])></i>
                Crear Género
            </h3>
            <button onclick="closeModal()" @class(['text-white', 'hover:text-gray-200', 'transition-colors'])>
                <i @class(['fas', 'fa-times', 'text-2xl'])></i>
            </button>
        </div>

        <!-- Cuerpo del Modal -->
        <form id="genderForm" @class(['p-6'])>
            <div @class(['space-y-4'])>
                <!-- Campo: Nombre -->
                <div>
                    <label for="name" @class(['block', 'text-sm', 'font-semibold', 'text-gray-700', 'mb-2'])>
                        <i @class(['fas', 'fa-tag', 'text-primary-600', 'mr-1'])></i>
                        Nombre del Género <span @class(['text-red-500'])>*</span>
                    </label>
                    <input type="text"
                        id="name"
                        name="name"
                        required
                        placeholder="Ej: Masculino, Femenino, Otro..."
                        @class(['w-full', 'px-4', 'py-3', 'border', 'border-gray-300', 'rounded-lg', 'focus:ring-2', 'focus:ring-primary-500', 'focus:border-transparent', 'transition-all'])>
                    <p @class(['text-xs', 'text-gray-500', 'mt-1'])>
                        <i @class(['fas', 'fa-info-circle', 'mr-1'])></i>
                        Nombre identificativo del género (debe ser único)
                    </p>
                </div>

                <!-- Campo: Estado -->
                <div>
                    <label @class(['block', 'text-sm', 'font-semibold', 'text-gray-700', 'mb-2'])>
                        <i @class(['fas', 'fa-toggle-on', 'text-primary-600', 'mr-1'])></i>
                        Estado
                    </label>
                    <div @class(['flex', 'items-center', 'space-x-3'])>
                        <label @class(['inline-flex', 'items-center'])>
                            <input type="checkbox"
                                id="is_active"
                                name="is_active"
                                value="1"
                                checked
                                @class(['rounded', 'border-gray-300', 'text-primary-600', 'focus:ring-primary-500'])>
                            <span @class(['ml-2', 'text-sm', 'text-gray-700'])>
                                Género activo
                            </span>
                        </label>
                    </div>
                    <p @class(['text-xs', 'text-gray-500', 'mt-1'])>
                        <i @class(['fas', 'fa-info-circle', 'mr-1'])></i>
                        Los géneros inactivos no estarán disponibles para nuevos registros
                    </p>
                </div>
            </div>

            <!-- Botones de Acción -->
            <div @class(['flex', 'justify-end', 'space-x-3', 'mt-6', 'pt-4', 'border-t', 'border-gray-200'])>
                <button type="button"
                        onclick="closeModal()"
                        @class(['px-6', 'py-2.5', 'bg-gray-500', 'text-white', 'font-semibold', 'rounded-lg', 'hover:bg-gray-600', 'transition-colors', 'duration-300', 'flex', 'items-center'])>
                    <i @class(['fas', 'fa-times', 'mr-2'])></i>
                    Cancelar
                </button>
                <button type="submit"
                        id="btnSubmit"
                        @class(['px-6', 'py-2.5', 'bg-primary-600', 'text-white', 'font-bold', 'rounded-lg', 'hover:bg-primary-700', 'transition-colors', 'duration-300', 'flex', 'items-center', 'shadow-lg'])>
                    <i @class(['fas', 'fa-save', 'mr-2'])></i>
                    Crear
                </button>
            </div>
        </form>
    </div>
</div>