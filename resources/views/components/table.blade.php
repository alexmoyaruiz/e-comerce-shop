<div class="flex flex-col sm:flex-row items-center justify-between mb-4">
    <!-- Controles para mostrar entradas -->
    <div class="flex items-center space-x-2 mb-4 sm:mb-0">
        <span class="text-sm font-medium">{{ __('Mostrar') }}</span>
        <select wire:model.live="cant" class="border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-sm py-1.5 px-2">
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="25">25</option>
            <option value="50">50</option>
            <option value="100">100</option>
        </select>
        <span class="text-sm font-medium">{{ __('Entrada') }}</span>
    </div>

    <!-- Campo de búsqueda -->
    <div class="w-full sm:w-auto">
        <input 
            type="text" 
            wire:model.live="search" 
            class="w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-sm py-1.5 px-2" 
            placeholder="{{ __('Buscar...') }}">
    </div>
</div>

<div class="overflow-x-auto">
    <table class="min-w-full table-auto border-collapse border border-gray-200">
        <thead>
            <tr class="bg-gray-50 text-gray-700 text-sm uppercase tracking-wider">
                {{ $thead }}
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            {{ $slot }}
        </tbody>
    </table>
</div>
