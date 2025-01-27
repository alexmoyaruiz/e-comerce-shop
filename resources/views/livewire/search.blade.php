<div>
    
        <form>
          <div class="input-group">
              <input type="search" class="form-control" placeholder="Buscar Producto..." wire:model.live="search">
              <div class="input-group-append">
                  <button class="btn btn-default" wire:click.prevent >
                      <i class="fa fa-search"></i>
                  </button>
              </div>
          </div>
      </form>

      <ul class="list-group" id="list-search">
        @foreach($products as $product)
        <li class="list-group-item">
            <div>
                <h5>
                   
                <x-image :item="$product" size="50" />
                   
                <a href="{{route('product.show',$product)}}" class="text-white">
                    {{$product->name}}
                </a>
                </h5>
                <div class="d-flex justify-content-between">
                    <div class="mr-1">
                        Precio venta:
                        <span class="badge badge-pill badge-info">
                        {!!$product->precio!!}
                        </span>
                    </div>
                </div>
                <div>
                    Stock:
                    <span class="badge badge-pill badge-danger">
                     {!!$product->stock!!}
                    </span>
                </div>
            </div>
        </li>
        
        @endforeach
    </ul>
    
</div>
