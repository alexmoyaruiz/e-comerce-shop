<?php

namespace App\Livewire\Sale;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Crear Venta')]
class SaleCreate extends Component
{
    public function render()
    {
        return view('livewire.sale.sale-create');
    }
}
