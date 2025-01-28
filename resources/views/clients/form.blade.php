<x-modal modalId="modalClient" modalTitle="Clientes">
    <form wire:submit.prevent="{{$Id==0 ? "store" : "update($Id)"}} ">
        <div class="form-row">
        {{--Input para name--}}       
            <div class="form-group col-md-6">
                <label for="name">Nombre:</label>
                <input wire:model='name' type="text" class="form-control" id="name" placeholder="Nombre del cliente">
                @error('name')
                    <div class="alert alert-danger w-100 mt-2">{{$message}}</div>
                @enderror
            </div>
        {{--Input Identificación--}}      
          <div class="form-group col-md-6">
                <label for="name">Identificación:</label>
                <input wire:model='identification' type="text" class="form-control" id="identification" placeholder="Identificación del cliente">
                @error('identification')
                    <div class="alert alert-danger w-100 mt-2">{{$message}}</div>
                @enderror
            </div>      
        {{--Input email--}}        
            <div class="form-group col-md-6">
                <label for="name">Correo electrónico:</label>
                <input wire:model='email' type="email" class="form-control" id="email" placeholder="Correo electrónico del cliente">
                @error('email')
                    <div class="alert alert-danger w-100 mt-2">{{$message}}</div>
                @enderror
            </div>       
        {{--Input teléfono--}}

            <div class="form-group col-md-6">
                <label for="name">Teléfono</label>
                <input wire:model='telefono' type="text" class="form-control" id="telefono" placeholder="Telefono">
                @error('telefono')
                    <div class="alert alert-danger w-100 mt-2">{{$message}}</div>
                @enderror
            </div>

        {{--Input para empresa--}}

            <div class="form-group col-md-6">
                <label for="empresa">Empresa:</label>
                <input wire:model='empresa' type="text" class="form-control" id="empresa" placeholder="MiEmpresa SL">
                @error('empresa')
                    <div class="alert alert-danger w-100 mt-2">{{$message}}</div>
                @enderror
            </div>

        {{--Input para nif--}}
        
            <div class="form-group col-md-6">
                <label for="name">NIF:</label>
                <input wire:model='nif' type="text" class="form-control" id="nif" placeholder="998556933211">
                @error('nif')
                    <div class="alert alert-danger w-100 mt-2">{{$message}}</div>
                @enderror
            </div>
        </div>
        <hr>
        <button class="btn btn-primary float-right">{{$Id==0 ? 'Guardar' : 'Editar'}}</button>
    </form>
</x-modal>