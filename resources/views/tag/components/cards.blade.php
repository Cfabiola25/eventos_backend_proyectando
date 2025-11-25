<div @class(['flex', 'flex-wrap', 'sm:flex-nowrap', 'gap-4', 'mb-6'])>
    <!-- Total de Etiquetas -->
    <div @class(['w-full', 'bg-white', 'rounded-lg', 'shadow', 'p-6', 'text-center', 'transition-transform', 'transform', 'hover:-translate-y-1', 'duration-300', 'border', 'border-transparent', 'hover:border-primary-600', 'hover:shadow-red-300'])>
        <div @class(['flex', 'justify-center', 'mb-2'])>
            <i @class(['fas', 'fa-tags', 'text-primary-600', 'text-4xl'])></i>
        </div>
        <p @class(['text-sm', 'text-gray-500', 'font-semibold'])>Total de Etiquetas</p>
        <p @class(['text-3xl', 'font-bold', 'text-primary-600'])>{{ $totalTags }}</p>
    </div>
</div>