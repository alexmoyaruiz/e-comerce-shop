<?php

namespace App\Livewire\Client;

use Livewire\Component;
use Livewire\Attributes\Title;
use App\Models\Client;

#[Title('Ver detalles del cliente')]
class ClientShow extends Component
{
    public Client $client;

    public function render()
    {
        return view('livewire.client.client-show');
    }
}
