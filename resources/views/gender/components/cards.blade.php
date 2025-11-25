<div @class(['flex', 'flex-wrap', 'sm:flex-nowrap', 'gap-4', 'mb-6'])>
    <!-- Total Géneros -->
    <div @class(['w-full', 'sm:w-1/3', 'bg-white', 'rounded-lg', 'shadow', 'p-6', 'text-center', 'transition-transform', 'transform', 'hover:-translate-y-1', 'duration-300', 'border', 'border-transparent', 'hover:border-primary-600', 'hover:shadow-red-300'])>
        <div @class(['flex', 'justify-center', 'mb-2'])>
            <i @class(['fas', 'fa-venus-mars', 'text-primary-600', 'text-4xl'])></i>
        </div>
        <p @class(['text-sm', 'text-gray-500', 'font-semibold'])>Total Géneros</p>
        <p id="cardTotal" @class(['text-3xl', 'font-bold', 'text-primary-600'])>{{ $total }}</p>
    </div>

    <!-- Activos -->
    <div @class(['w-full', 'sm:w-1/3', 'bg-white', 'rounded-lg', 'shadow', 'p-6', 'text-center', 'transition-transform', 'transform', 'hover:-translate-y-1', 'duration-300', 'border', 'border-transparent', 'hover:border-primary-600', 'hover:shadow-red-300'])>
        <div @class(['flex', 'justify-center', 'mb-2'])>
            <i @class(['fas', 'fa-check-circle', 'text-primary-600', 'text-4xl'])></i>
        </div>
        <p @class(['text-sm', 'text-gray-500', 'font-semibold'])>Activos</p>
        <p id="cardActivos" @class(['text-3xl', 'font-bold', 'text-primary-600'])>{{ $activos }}</p>
    </div>

    <!-- Inactivos -->
    <div @class(['w-full', 'sm:w-1/3', 'bg-white', 'rounded-lg', 'shadow', 'p-6', 'text-center', 'transition-transform', 'transform', 'hover:-translate-y-1', 'duration-300', 'border', 'border-transparent', 'hover:border-red-600', 'hover:shadow-red-300'])>
        <div @class(['flex', 'justify-center', 'mb-2'])>
            <i @class(['fas', 'fa-times-circle', 'text-red-600', 'text-4xl'])></i>
        </div>
        <p @class(['text-sm', 'text-gray-500', 'font-semibold'])>Inactivos</p>
        <p id="cardInactivos" @class(['text-3xl', 'font-bold', 'text-red-600'])>{{ $inactivos }}</p>
    </div>
</div>