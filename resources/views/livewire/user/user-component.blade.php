<div>
    <x-card cardTitle="{{ __('Listado de Usuarios') }} ({{$this->totalRegistros}})">
        <x-slot:cardTools>
            <a href="#" class="btn btn-primary" wire:click='create'>
                <i class="fas fa-plus-circle"></i>
                {{ __('Crear usuario') }}             
            </a>
        </x-slot:cardTools>
       
        <x-table>
            <x-slot:thead> 
                <th>{{ __('Id') }}</th>
                <th>{{ __('Imagen') }}</th>
                <th>{{ __('Nombre') }}</th>
                <th>{{ __('Email') }}</th>
                <th>{{ __('Perfil') }}</th>
                <th>{{ __('Estado') }}</th>
                <th width="3%">...</th>
                <th width="3%">...</th>
                <th width="3%">...</th>
            </x-slot:thead>

            @forelse ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>
                        <x-image :item="$user" />
                    </td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->admin ? __('Administrador') : __('Vendedor') }}</td>
                    <td>{!!$user->activeLabel!!}</td>
                    <td>
                        <a href="{{route('user.show', $user)}}" class="btn btn-success bt-sm" title="{{ __('Ver') }}">
                            <i class="far fa-eye"></i>
                        </a>
                    </td>
                    <td>
                        <a href="#" wire:click="edit({{$user->id}})" class="btn btn-primary bt-sm" title="{{ __('Editar') }}">
                            <i class="far fa-edit"></i>
                        </a>
                    </td>
                    <td>
                        <a wire:click="$dispatch('delete', {id: {{$user->id}}, eventName: 'destroyUser'})"
                            class="btn btn-danger bt-sm" title="{{ __('Eliminar') }}">
                            <i class="far fa-trash-alt"></i>
                         </a>
                    </td>
                </tr>
            @empty
                <tr class="text-center">
                    <td colspan="10">{{ __('Sin registros') }}</td>
                </tr>
            @endforelse
        </x-table>
        <x-slot:cardFooter>
            {{$users->links()}}
        </x-slot>
    </x-card>
    
    <x-modal modalId="modalUser" modalTitle="{{ __('Usuarios') }}">
        <form wire:submit.prevent="{{$Id==0 ? 'store' : "update($Id)"}}">
            <div class="form-row">
                {{-- Input name --}}
                <div class="form-group col-12 col-md-6">
                    <label for="name">{{ __('Nombre:') }}</label>
                    <input wire:model='name' type="text" class="form-control" id="name" placeholder="{{ __('Nombre del usuario') }}">
                    @error('name')
                        <div class="alert alert-danger w-100 mt-2">{{$message}}</div>
                    @enderror
                </div>
                {{-- Input email --}}
                <div class="form-group col-12 col-md-6">
                    <label for="email">{{ __('Email:') }}</label>
                    <input wire:model='email' type="text" class="form-control" id="email" placeholder="{{ __('Email del usuario') }}">
                    @error('email')
                        <div class="alert alert-danger w-100 mt-2">{{$message}}</div>
                    @enderror
                </div>
                {{-- Input password --}}
                <div class="form-group col-12 col-md-6">
                    <label for="password">{{ __('Contraseña:') }}</label>
                    <input wire:model='password' type="password" class="form-control" id="password" placeholder="{{ __('Contraseña del usuario') }}">
                    @error('password')
                        <div class="alert alert-danger w-100 mt-2">{{$message}}</div>
                    @enderror
                </div>
                {{-- Input re-password --}}
                <div class="form-group col-12 col-md-6">
                    <label for="re_password">{{ __('Repetir Contraseña:') }}</label>
                    <input wire:model='re_password' type="password" class="form-control" id="re_password" placeholder="{{ __('Repetir contraseña') }}">
                    @error('re_password')
                        <div class="alert alert-danger w-100 mt-2">{{$message}}</div>
                    @enderror
                </div>
                {{-- Input checkbox admin --}}
                <div class="form-group form-check col-md-6">
                    <div class="icheck-primary">
                        <input wire:model='admin' type="checkbox" id="admin">
                        <label class="form-check-label" for="admin"> {{ __('¿Es administrador?') }}</label>
                    </div>
                </div>
                {{-- Input checkbox activo --}}
                <div class="form-group form-check col-md-6">
                    <div class="icheck-primary">
                        <input wire:model='active' type="checkbox" id="active">
                        <label class="form-check-label" for="active"> {{ __('¿Está activo?') }}</label>
                    </div>
                </div>
                {{-- Input image --}}
                <div class="form-group col-md-12">
                    <label for="image">{{ __('Imagen:') }}</label>
                    <input wire:model='image' type="file" id="image" accept="image/*">
                </div>

                <div class="col-md-12">
                    
                @if($Id>0)
                    <x-image :item="$user=App\Models\User::find($Id)" float="float-right" size="150"/>
                @endif

                    
                @if ($this->image)
                    <img src="{{$image->temporaryUrl()}}" class="rounded float-left" width="200">
                @endif
                </div>
            </div>
            <hr>
            <button class="btn btn-primary float-right">{{$Id == 0 ? __('Guardar') : __('Editar')}}</button>
        </form>
    </x-modal>
</div>
