<?php

namespace App\Livewire\Admin;

use App\Models\cliente;
use Livewire\Component;

class Clienteindex extends Component
{
    public function render()
    {
        $clientes = cliente::all();
        return view('livewire.admin.clienteindex', compact('clientes'));
    }
}
