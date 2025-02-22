<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\productos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ProductoController extends Controller
{
    public function index()
    {
        return view('admin.producto.index');
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'categoria_id' => 'required|exists:categorias,id',
            'nombre' => 'required',
            'descripcion' => 'required',
            'precio_de_compra' => 'required|numeric',
            'precio_de_venta' => 'required|numeric',
            'stock' => 'required|integer',
        ]);

        try {
            $validator->validate();

            $producto = new productos();
            $producto->categoria_id = $request->categoria_id;
            $producto->nombre = $request->nombre;
            $producto->descripcion = $request->descripcion;
            $producto->precio_de_compra = $request->precio_de_compra;
            $producto->precio_de_venta = $request->precio_de_venta;
            $producto->stock = $request->stock;

            $producto->save();

            if ($producto) {
                return redirect()->route('admin.producto.index')->with('success', 'El producto fue registrado correctamente.');
            } else {
                return back()->withErrors(['general' => 'Ocurrió un error al crear el producto.']);
            }
        } catch (ValidationException $e) {
            return back()->withErrors($e->validator->errors());
        }
    }

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'categoria_id' => 'required|exists:categorias,id',
            'nombre' => 'required',
            'descripcion' => 'required',
            'precio_de_compra' => 'required|numeric',
            'precio_de_venta' => 'required|numeric',
            'stock' => 'required|integer',
        ]);

        try {
            $validator->validate();

            $producto = productos::findOrFail($id);
            $producto->categoria_id = $request->categoria_id;
            $producto->nombre = $request->nombre;
            $producto->descripcion = $request->descripcion;
            $producto->precio_de_compra = $request->precio_de_compra;
            $producto->precio_de_venta = $request->precio_de_venta;
            $producto->stock = $request->stock;

            $producto->save();

            if ($producto) {
                return redirect()->route('admin.producto.index')->with('success', 'El producto fue actualizada correctamente.');
            } else {
                return back()->withErrors(['general' => 'Ocurrió un error al actualizar el producto.']);
            }
        } catch (ValidationException $e) {
            return back()->withErrors($e->validator->errors());
        }
    }

    public function destroy(string $id)
    {
        productos::find($id)->delete();
        return redirect()->route('admin.producto.index')->with('success', 'El producto fue eliminado correctamente.');
    }
}
