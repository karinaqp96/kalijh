<?php

namespace App\Livewire\Admin;

use App\Models\cliente;
use App\Models\Creditos;
use App\Models\productos;
use Livewire\Component;

class CreditoIndex extends Component
{
    public function render()
    {
        $clientes = cliente::all();
        $productos = productos::all();
        $creditos = Creditos::all();
        return view('livewire.admin.credito-index', compact('clientes', 'creditos', 'productos' ));
    }
}
