<x-card cardTitle="Detalles del cliente">
    <x-slot:cardTools>
        <a href="{{ route('client')}}" class="btn btn-primary">
           <i class="fas fa-arrow-circle-left"></i> {{__('Regresar')}}
        </a>
    </x-slot>

    <div class="row">
        <div class="col-md-4">
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">

                    <h2 class="profile-username text-center">{{$client->name}}</h2>
                    <ul class="list-group  mb-3">
                        <li class="list-group-item">
                            <b>{{__('Identificación')}}</b> <a class="float-right">{{$client->identification}}</a>
                        </li>
                        <li class="list-group-item">
                            <b>{{__('Email')}}</b> <a class="float-right">{{$client->email}}</a>
                        </li>
                        <li class="list-group-item">
                            <b>{{__('Telefono')}}</b> <a class="float-right">{{$client->telefono}}</a>
                        </li>
                        <li class="list-group-item">
                            <b>{{__('Empresa')}}</b> <a class="float-right">{{$client->empresa}}</a>
                        </li>
                        <li class="list-group-item">
                            <b>{{__('NIF')}}</b> <a class="float-right">{{$client->nif}}</a>
                        </li>
                        {{--<li class="list-group-item">
                            <b>{{__('Estado')}}</b> <a class="float-right">{!!$user->activeLabel!!}</a>
                        </li> --}}
                        <li class="list-group-item">
                            <b>{{__('Creado')}}</b> <a class="float-right">{{$client->created_at}}</a>
                        </li>
                     
                    </ul>
                </div>
            
            </div>
        </div>
        <div class="col-md-8">
            <div class="table-responsive">
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th>{{__('Id')}}</th>
                            <th>{{__('Imagen')}}</th>
                            <th>{{__('Producto')}}</th>
                            <th>{{__('Email')}}</th>
                            <th>{{__('Email')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @foreach ($category->products as $product)
                        <tr>
                            <td>{{$product->id}}</td>
                            <td><x-image :item="$product"/></td>
                            <td>{{$product->name}}</td>
                            <td>{!! $product->precio !!}</td>
                            <td>{!! $product->stockLabel !!}</td>
                        </tr>
                        @endforeach --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</x-card>
