<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class productos extends Model
{
    use HasFactory;

    protected $fillable = [
        'categorias_id',
        'nombre',
        'descripcion',
        'precio de compra',
        'precio de venta',
        'stock',

    ];
    //relacion con categoria
    public function categorias()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }
}
