<div @class(['flex', 'flex-wrap', 'sm:flex-nowrap', 'gap-4', 'mb-6'])>
    <!-- Total de Categorías -->
    <div @class(['w-full', 'sm:w-1/3', 'bg-white', 'rounded-lg', 'shadow', 'p-6', 'text-center', 'transition-transform', 'transform', 'hover:-translate-y-1', 'duration-300', 'border', 'border-transparent', 'hover:border-red-600', 'hover:shadow-red-300'])>
        <div @class(['flex', 'justify-center', 'mb-2'])>
            <i @class(['fas', 'fa-layer-group', 'text-red-600', 'text-3xl'])></i>
        </div>
        <p @class(['text-sm', 'text-gray-500', 'font-semibold'])>Total Categorías</p>
        <p @class(['text-3xl', 'font-bold', 'text-red-600']) id="totalCategories">{{ $totalCategories }}</p>
    </div>

    <!-- Categorías Activas -->
    <div @class(['w-full', 'sm:w-1/3', 'bg-white', 'rounded-lg', 'shadow', 'p-6', 'text-center', 'transition-transform', 'transform', 'hover:-translate-y-1', 'duration-300', 'border', 'border-transparent', 'hover:border-green-600', 'hover:shadow-green-300'])>
        <div @class(['flex', 'justify-center', 'mb-2'])>
            <i @class(['fas', 'fa-check-circle', 'text-red-600', 'text-3xl'])></i>
        </div>
        <p @class(['text-sm', 'text-gray-500', 'font-semibold'])>Activas</p>
        <p @class(['text-3xl', 'font-bold', 'text-green-600']) id="activeCategories">{{ $activeCategories }}</p>
    </div>

    <!-- Categorías Inactivas -->
    <div @class(['w-full', 'sm:w-1/3', 'bg-white', 'rounded-lg', 'shadow', 'p-6', 'text-center', 'transition-transform', 'transform', 'hover:-translate-y-1', 'duration-300', 'border', 'border-transparent', 'hover:border-gray-600', 'hover:shadow-gray-300'])>
        <div @class(['flex', 'justify-center', 'mb-2'])>
            <i @class(['fas', 'fa-times-circle', 'text-red-600', 'text-3xl'])></i>
        </div>
        <p @class(['text-sm', 'text-gray-500', 'font-semibold'])>Inactivas</p>
        <p @class(['text-3xl', 'font-bold', 'text-gray-600']) id="inactiveCategories">{{ $inactiveCategories }}</p>
    </div>
</div>