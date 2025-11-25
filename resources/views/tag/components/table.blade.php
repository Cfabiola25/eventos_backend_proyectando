<div @class(['overflow-x-auto', 'rounded-lg', 'border-2', 'border-gray-300'])>
    <table @class(['min-w-full', 'divide-y-2', 'divide-gray-300', 'border-collapse'])>
        <thead @class(['bg-primary-600'])>
            <tr @class(['divide-x-2', 'divide-primary-700'])>
                <th scope="col" @class(['px-6', 'py-4', 'text-left', 'text-xs', 'font-bold', 'text-white', 'uppercase', 'tracking-wider', 'border-r-2', 'border-primary-700'])>
                    Etiqueta
                </th>
                <th scope="col" @class(['px-6', 'py-4', 'text-center', 'text-xs', 'font-bold', 'text-white', 'uppercase', 'tracking-wider', 'border-r-2', 'border-primary-700'])>
                    Color
                </th>
                <th scope="col" @class(['px-6', 'py-4', 'text-left', 'text-xs', 'font-bold', 'text-white', 'uppercase', 'tracking-wider', 'border-r-2', 'border-primary-700'])>
                    Descripción
                </th>
                <th scope="col" @class(['px-6', 'py-4', 'text-center', 'text-xs', 'font-bold', 'text-white', 'uppercase', 'tracking-wider', 'border-r-2', 'border-primary-700'])>
                    Fecha Creación
                </th>
                <th scope="col" @class(['px-6', 'py-4', 'text-center', 'text-xs', 'font-bold', 'text-white', 'uppercase', 'tracking-wider'])>
                    Acciones
                </th>
            </tr>
        </thead>
        <tbody @class(['bg-white', 'divide-y-2', 'divide-gray-300'])>
            @forelse($tags as $tag)
                <tr @class(['hover:bg-gray-50', 'transition-colors', 'duration-200', 'divide-x-2', 'divide-gray-300'])>
                    <td @class(['px-6', 'py-4', 'whitespace-nowrap', 'border-r-2', 'border-gray-300'])>
                        <div @class(['flex', 'items-center'])>
                            <div @class(['flex-shrink-0', 'h-10', 'w-10', 'rounded-full', 'flex', 'items-center', 'justify-center']) style="background-color: {{ $tag->color }}20;">
                                <i @class(['fas', 'fa-tag']) style="color: {{ $tag->color }};"></i>
                            </div>
                            <div @class(['ml-4'])>
                                <div @class(['text-sm', 'font-bold', 'text-gray-900', 'cursor-help'])
                                    title="{{ $tag->name }}"
                                    data-tooltip="true">
                                    {{ Str::limit($tag->name, 20) }}
                                </div>
                            </div>
                        </div>
                    </td>
                    <td @class(['px-6', 'py-4', 'whitespace-nowrap', 'text-center', 'border-r-2', 'border-gray-300'])>
                        <div @class(['flex', 'items-center', 'justify-center'])>
                            <div @class(['flex', 'items-center', 'px-3', 'py-1', 'rounded-lg', 'cursor-help'])
                                    style="background-color: {{ $tag->color }}20;"
                                    title="Color: {{ $tag->color }}"
                                    data-tooltip="true">
                                <div @class(['w-6', 'h-6', 'rounded-full', 'border-2', 'border-gray-300', 'mr-2']) style="background-color: {{ $tag->color }};"></div>
                                <span @class(['text-sm', 'font-bold']) style="color: {{ $tag->color }};">{{ $tag->color }}</span>
                            </div>
                        </div>
                    </td>
                    <td @class(['px-6', 'py-4', 'border-r-2', 'border-gray-300'])>
                        <div @class(['text-sm', 'text-gray-700', 'cursor-help'])
                                title="{{ $tag->description ?: 'Sin descripción' }}"
                                data-tooltip="true">
                            {{ $tag->description ? Str::limit($tag->description, 50) : 'Sin descripción' }}
                        </div>
                    </td>
                    <td @class(['px-6', 'py-4', 'whitespace-nowrap', 'text-center', 'text-sm', 'text-gray-500', 'border-r-2', 'border-gray-300'])>
                        <div @class(['cursor-help'])
                                title="Creado el {{ $tag->created_at->format('d/m/Y H:i:s') }}"
                                data-tooltip="true">
                            <i @class(['fas', 'fa-calendar-alt', 'mr-1'])></i>
                            {{ $tag->created_at->format('d/m/Y') }}
                        </div>
                    </td>
                    <td @class(['px-6', 'py-4', 'whitespace-nowrap', 'text-center', 'text-sm', 'font-medium'])>
                        <div @class(['flex', 'justify-center', 'space-x-3'])>
                            <button onclick="editTag('{{ $tag->uuid }}')"
                                    @class(['text-blue-600', 'hover:text-blue-900', 'transition-colors'])
                                    title="Editar etiqueta">
                                <i @class(['fas', 'fa-edit', 'text-lg'])></i>
                            </button>
                            <button onclick="deleteTag('{{ $tag->uuid }}')"
                                    @class(['text-red-600', 'hover:text-red-900', 'transition-colors'])
                                    title="Eliminar etiqueta">
                                <i @class(['fas', 'fa-trash-alt', 'text-lg'])></i>
                            </button>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" @class(['px-6', 'py-8', 'text-center'])>
                        <div @class(['flex', 'flex-col', 'items-center', 'justify-center'])>
                            <i @class(['fas', 'fa-inbox', 'text-gray-400', 'text-5xl', 'mb-3'])></i>
                            <p @class(['text-gray-500', 'text-lg', 'font-semibold'])>No hay etiquetas registradas</p>
                            <p @class(['text-gray-400', 'text-sm', 'mt-1'])>Haz clic en "Agregar Etiqueta" para comenzar</p>
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Paginación -->
<div @class(['mt-6', 'flex', 'flex-col', 'sm:flex-row', 'justify-between', 'items-center', 'gap-4'])>
    <div @class(['text-sm', 'text-gray-700'])>
        Mostrando
        <span @class(['font-semibold'])>{{ $tags->firstItem() ?? 0 }}</span>
        -
        <span @class(['font-semibold'])>{{ $tags->lastItem() ?? 0 }}</span>
        de
        <span @class(['font-semibold'])>{{ $tags->total() }}</span>
        resultado(s)
    </div>

    @if($tags->hasPages())
        <div @class(['flex', 'items-center', 'space-x-2'])>
            {{-- Previous --}}
            @if ($tags->onFirstPage())
                <span @class(['px-3', 'py-2', 'text-sm', 'font-medium', 'text-gray-400', 'bg-gray-100', 'border', 'border-gray-300', 'rounded-lg', 'cursor-not-allowed'])>
                    <i @class(['fas', 'fa-chevron-left'])></i>
                </span>
            @else
                <a href="{{ $tags->previousPageUrl() }}"
                    @class(['px-3', 'py-2', 'text-sm', 'font-medium', 'text-gray-700', 'bg-white', 'border', 'border-gray-300', 'rounded-lg', 'hover:bg-gray-50', 'hover:text-primary-600', 'transition-colors'])>
                    <i @class(['fas', 'fa-chevron-left'])></i>
                </a>
            @endif

            {{-- Números --}}
            @foreach ($tags->getUrlRange(1, $tags->lastPage()) as $page => $url)
                @if ($page == $tags->currentPage())
                    <span @class(['px-3', 'py-2', 'text-sm', 'font-medium', 'text-white', 'bg-primary-600', 'border', 'border-primary-600', 'rounded-lg'])>
                        {{ $page }}
                    </span>
                @else
                    <a href="{{ $url }}"
                        @class(['px-3', 'py-2', 'text-sm', 'font-medium', 'text-gray-700', 'bg-white', 'border', 'border-gray-300', 'rounded-lg', 'hover:bg-gray-50', 'hover:text-primary-600', 'transition-colors'])>
                        {{ $page }}
                    </a>
                @endif
            @endforeach

            {{-- Next --}}
            @if ($tags->hasMorePages())
                <a href="{{ $tags->nextPageUrl() }}"
                    @class(['px-3', 'py-2', 'text-sm', 'font-medium', 'text-gray-700', 'bg-white', 'border', 'border-gray-300', 'rounded-lg', 'hover:bg-gray-50', 'hover:text-primary-600', 'transition-colors'])>
                    <i @class(['fas', 'fa-chevron-right'])></i>
                </a>
            @else
                <span @class(['px-3', 'py-2', 'text-sm', 'font-medium', 'text-gray-400', 'bg-gray-100', 'border', 'border-gray-300', 'rounded-lg', 'cursor-not-allowed'])>
                    <i @class(['fas', 'fa-chevron-right'])></i>
                </span>
            @endif
        </div>
    @endif
</div>

<style>
/* Tooltips mejorados */
[data-tooltip="true"] { position: relative; }
[data-tooltip="true"]:hover::after {
    content: attr(title);
    position: absolute;
    bottom: 100%;
    left: 50%;
    transform: translateX(-50%);
    background-color: #1f2937;
    color: white;
    padding: 8px 12px;
    border-radius: 6px;
    font-size: 12px;
    white-space: normal;
    max-width: 300px;
    width: max-content;
    z-index: 1000;
    box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1), 0 2px 4px -1px rgba(0,0,0,0.06);
    animation: fadeIn 0.2s ease-in;
}
[data-tooltip="true"]:hover::before {
    content: '';
    position: absolute;
    bottom: 100%;
    left: 50%;
    transform: translateX(-50%) translateY(6px);
    border: 6px solid transparent;
    border-top-color: #1f2937;
    z-index: 1000;
    animation: fadeIn 0.2s ease-in;
}

/* Evitar conflicto Blade con at-rules */
@@keyframes fadeIn {
    from { opacity: 0; }
    to   { opacity: 1; }
}

/* Grid visible en la tabla */
table { border-collapse: separate; border-spacing: 0; }
</style>