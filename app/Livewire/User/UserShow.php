<?php

namespace App\Livewire\User;

use Livewire\Component;
use Livewire\Attributes\Title;
use App\Models\User;

#[Title('Detalles usuarios')]
class UserShow extends Component
{
    public User $user;

    public function render()
    {
        return view('livewire.user.user-show');
    }
}
