<?php

namespace App\Livewire\Admin;

use App\Models\Categoria;
use App\Models\productos;
use Livewire\Component;

class ProductoIndex extends Component
{
    public function render()
    {
        $categorias = Categoria::all();
        $productos = productos::all();
        return view('livewire.admin.producto-index', compact('categorias', 'productos'));
    }
}
