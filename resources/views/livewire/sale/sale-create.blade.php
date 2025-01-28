<div>
    <x-card cardTitle="">
       <x-slot:cardTools>
          <a href="#" class="btn btn-primary" wire:click='create'>
            <i class="fas fa-plus-circle"></i> Ir a ventas 
          </a>
          <a href="#" class="btn btn-danger" wire:click=''>
            <i class="fas fa-trash"></i> Cancelar ventas 
          </a>
       </x-slot>
       {{--Contenido--}}
       <div class="row">
        <div class="col-md-6">
            COLUMNA DETALLES VENTA
        </div>
        <div class="col-md-6">
            COLUMNA PRODUCTOS
        </div>
       </div>
 
       <x-slot:cardFooter>
            
       </x-slot>
    </x-card>

</div>
