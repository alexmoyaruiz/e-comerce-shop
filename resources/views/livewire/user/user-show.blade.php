<x-card cardTitle="Detalles de la categoria">
    <x-slot:cardTools>
        <a href="{{ route('users')}}" class="btn btn-primary">
           <i class="fas fa-arrow-circle-left"></i> {{__('Regresar')}}
        </a>
    </x-slot>

    <div class="row">
        <div class="col-md-4">
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <x-image :item="$user" size="250" />
                    </div>
                    <h2 class="profile-username text-center">{{$user->name}}</h2>
                    <p class="text-muted text-center">
                        {{$user->admin ? __('Administrador') : __('Empleado')}}
                    </p>
                    <ul class="list-group  mb-3">
                        <li class="list-group-item">
                            <b>{{__('Email')}}</b> <a class="float-right">{{$user->email}}</a>
                        </li>
                        <li class="list-group-item">
                            <b>{{__('Perfil')}}</b> <a class="float-right">{{$user->admin ? __('Administrador') : __('Empleado')}}</a>
                        </li>
                        <li class="list-group-item">
                            <b>{{__('Creado')}}</b> <a class="float-right">{{$user->created_at}}</a>
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
