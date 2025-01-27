<?php

namespace App\Livewire\User;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\WithPagination;
use App\Models\User;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

#[Title('Usuarios')]
class UserComponent extends Component
{ 
    use WithPagination;
    use WithFileUploads;

    //Propiedades de la clase
    public $totalRegistros=0;
    public $search='';
    public $cant=5;

    //Propiedades del modelo
    public $Id;
    public $name;
    public $email;
    public $password;
    public $admin = true;
    public $active = true;
    public $image;
    public $imageModel;
    public $re_password;
    public $user;
    

    public function mount(User $user)
    {
        $this->Id = $user->id;
        $this->user = $user->Id;
    }

    public function create()
    {
        $this->Id = 0;
        $this->clean();
        $this->dispatch('open-modal', 'modalUser');
    }

    //Crea un nuevo usuario
    public function store(){
        //dd(1);
        $rules = [
            'name' => 'required|min:5|max:255',
            'email'=> 'required|email|max:255|unique:users',
            'password'=> 'required|min:5',
            're_password'=> 'required|same:password',
            'image' => 'image|max:1024|nullable',
            
        ];

        $this->validate($rules);

        $user = new User();
                
        $user -> name = $this->name;
        $user -> email = $this->email;
        $user -> password = bcrypt($this->password);
        $user -> active = $this->active;
        $user -> admin = $this->admin;
        $user -> save();

        if($this->image){//Establece un nombre único de imagen con el directorio donde se ubica
            $customName = 'users/'.uniqid().'.'.$this->image->extension();
            $this->image->storeAs($customName);
            $user->image()->create(['url'=> $customName]);//

        }
        
        $this->dispatch('close-modal', 'modalUser');
        $this->dispatch('msg', 'Usuario creado correctamente');
        $this->clean();
    }


    public function clean()//Limpia todos los campos del modal
    {
        $this->reset(['Id', 'name', 'email', 'password', 'admin', 'active', 'image']);
        $this->resetErrorBag();
    }

    public function edit(User $user){// Limpia y carga todos los campos en el modal con los 
        //datos del usuario antes de abrir el modal

        $this->clean();
        //$this->reset(['name']);
        $this->Id = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->admin = $user->admin ? true : false;
        $this->active = $user->active ? true : false;
        $this->imageModel = $user->image ? $user->image : null;

        $this->dispatch('open-modal', 'modalUser');
    }

    public function update(User $user){//Actualiza el usuario
        
        $rules = [
            'name' => 'required|min:5|max:255',
            'email'=> 'required|email|max:255|unique:users,id',
            'password'=> 'min:5|nullable',
            're_password'=> 'same:password',
            'image' => 'image|max:1024|nullable',         
        ];
        
        $this->validate($rules);
        
        $user -> name = $this->name;
        $user -> email = $this->email;
        $user-> active = $this->active;
        $user-> admin = $this->admin;

        if($this->password){//Si el usuario introduce contraseña establece la nueva
            $user->password = $this->password;
        }

        $user->update();

        //Si hay imagen elimina la antigua y coge la nueva
        if($this->image){
            if($user->image!=null){
                Storage::delete('public/'.$user->image->url);
                $user->image()->delete();
            }
        

        $customName = 'users/'.uniqid().'.'.$this->image->extension();
        $this->image->storeAs($customName);
        $user->image()->create(['url'=> $customName]);
    
            
        }

        $this->dispatch('close-modal', 'modalUser');//Se cierra el modal y confirma al usuario.
        $this->dispatch('msg', 'Usuario editado correctamente');

        $this->clean();
    }

    public function render()
    {
       
        $this->totalRegistros = User::count();//Cuenta el total de registros
        $users = User::where('name', 'like', '%'.$this->search.'%')//Busca por nombre
        ->orderBy('id', 'desc') //Ordena por id en orden descendente
        ->paginate($this->cant);//Estable la paginación en base a la variable $cant
        return view('livewire.user.user-component', [
            'users' => $users,
        ]);
    }
}
