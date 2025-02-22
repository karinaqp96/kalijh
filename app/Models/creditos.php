<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Creditos extends Model
{
    use HasFactory;
    protected $fillable = [
        'clientes_id',
        'productos_id',
        'descripcion',
        'cantidad',
        'estado',
        
    ];
    //relacion con cliente
    public function cliente()
    {
        return $this->belongsTo(cliente::class, 'cliente_id');
    }
    //relacion con producto
    public function producto()
    {
        return $this->belongsTo(productos::class, 'productos_id');
    }
}
