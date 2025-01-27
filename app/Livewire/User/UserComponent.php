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

        if($this->image){
            $customName = 'users/'.uniqid().'.'.$this->image->extension();
            $this->image->storeAs($customName);
            $user->image()->create(['url'=> $customName]);

        }
        
        $this->dispatch('close-modal', 'modalUser');
        $this->dispatch('msg', 'Usuario creado correctamente');
        $this->clean();
    }


    public function clean()
    {
        $this->reset(['Id', 'name', 'email', 'password', 'admin', 'active', 'image']);
        $this->resetErrorBag();
    }

    public function edit(User $user){

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

    public function update(User $user){
        
        $rules = [
            'name' => 'required|min:5|max:255|unique:users,name'.$this->Id,
            'email'=> 'required|email|max:255|unique:users,email'.$this->Id,
            'password'=> 'required|min:5',
            're_password'=> 'required|same:password',
            'image' => 'image|max:1024|nullable',
            
        ];

        $this->validate($rules);

        $user -> name = $this->name;
        $user -> email = $this->email;
        $user-> active = $this->active;
        $user-> admin = $this->admin;
        $user->update();

        if($this->image){
            if($user->image!=null){
                Storage::delete('public/'.$user->image->url);
                $user->image()->delete();
            }

            
        $customName = 'users/'.uniqid().'.'.$this->image->extension();
        $this->image->storeAs($customName);
        $user->image()->create(['url'=> $customName]);
    
            
        }

        $this->dispatch('close-modal', 'modalUser');
        $this->dispatch('msg', 'Usuario editado correctamente');

        $this->clean();
    }

    public function render()
    {
       
        $this->totalRegistros = User::count();
        $users = User::where('name', 'like', '%'.$this->search.'%')
        ->orderBy('id', 'desc') 
        ->paginate($this->cant);
        return view('livewire.user.user-component', [
            'users' => $users,
        ]);
    }
}
