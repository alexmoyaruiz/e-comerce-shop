<?php

namespace App\Livewire\Client;

use Livewire\Component;
use Livewire\Attributes\Title;
use App\Models\Client;
use Livewire\WithPagination;
use Livewire\Attributes\On;

#[Title('Clientes')]
class ClientComponent extends Component
{
    use WithPagination;
    //Propiedades de la clase
    public $totalRegistros=0;
    public $search='';
    public $cant=5;
    //Propiedades modelo
    public $name = '';
    public $Id;
    public $email;
    public $identification;
    public $telefono;
    public $empresa;
    public $nif;
    
    public function render()
    {
        if($this->search==''){
            $this->resetPage();
        }

        $this->totalRegistros = Client::count();
        $clients = Client::where('name', 'like', '%'.$this->search.'%')
                        ->orderBy('id', 'desc') 
                        ->paginate($this->cant);
                        

        return view('livewire.Client.Client-component', [
            'clients' => $clients
        ]);
    }

    public function create(){

        $this->Id=0;//Indica al modal que va a crear un usuario

        $this->reset(['name']);
        $this->clean();
        $this->dispatch('open-modal', 'modalClient');
    }

    public function clean()
    {
        $this->reset('name', 'identification', 'telefono', 'email', 'empresa', 'nif');
        $this->resetErrorBag();
    }

    //Crea el cliente
    public function store(){
        
        $rules = [
            'name' => 'required|min:5|max:255|unique:clients',
            'identification' => 'required|min:5|max:15|unique:clients',
      
        ];

        $this->validate($rules);

        $client = new Client();
        $client -> name = $this->name;
        $client -> identification = $this->identification;
        $client -> email = $this->email;
        $client -> telefono = $this->telefono;
        $client -> empresa = $this->empresa;
        $client -> nif = $this->nif;
        $client -> save();

        $this->dispatch('close-modal', 'modalClient');
        $this->dispatch('msg', 'Cliente creado correctamente');

       $this->clean();
    }

    public function edit(Client $client){

        $this->clean();
        $this->Id = $client->id;
        $this->name = $client->name;
        $this->identification = $client->identification;
        $this->email = $client->email;
        $this->telefono = $client->telefono;
        $this->empresa = $client->empresa;
        $this->nif = $client->nif;

        $this->dispatch('open-modal', 'modalClient');
    }

    public function update(Client $client){

        $rules = [
            'name' => 'required|min:5|max:55',
            'identification' => 'required|min:5|max:55|unique:clients,id,'.$this->Id,
            'email' => 'required|min:5|max:55'
        ];

        $this->validate($rules);

        $client->name = $this->name;
        $client->identification = $this->identification;
        $client->email = $this->email;
        $client->telefono = $this->telefono;
        $client->empresa = $this->empresa;
        $client->nif = $this->nif;
        $client->update();

        $this->dispatch('close-modal', 'modalClient');
        $this->dispatch('msg', 'Cliente editado correctamente');

        $this->reset(['name']);
    }
    
    #[On('destroyClient')]//Nombre del evento por que se escucha
    public function destroy($id)
    {
        $client = Client::findOrFail($id);
        $client->delete();

        $this->dispatch('msg', 'El cliente ha sido eliminada correctamente');
    }
}
