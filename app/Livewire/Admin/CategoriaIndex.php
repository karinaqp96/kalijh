<?php

namespace App\Livewire\Admin;

use App\Models\Categoria;
use Livewire\Component;

class CategoriaIndex extends Component
{
    public function render()
    {
        $category = Categoria::all();
        return view('livewire.admin.categoria-index', compact('category'));
    }
}
