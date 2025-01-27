<div class="d-flex">
    <!-- Controles para mostrar entradas -->
    <div class="mb-4"> 
        <span>{{ __('Mostrar') }}</span>
        <select wire:model.live='cant' class="mr-4">
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="25">25</option>
            <option value="50">50</option>
            <option value="100">100</option>
        </select>
        <span>{{__('Entrada')}}</span>
    </div>

    <!-- Campo de búsqueda -->
    <div class="ml-2">
        <input type="text" wire:model.live='search' class="form-control" placeholder="Buscar...">
    </div>
</div>

<div class="table-responsive">
    <table class="table table-striped table-hover text-center">
        <thead>
            <tr>
                {{ $thead }}
            </tr>
        </thead>
        <tbody>
            {{ $slot }}
        </tbody>
    </table>
</div>
