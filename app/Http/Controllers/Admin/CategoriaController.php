<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index()
    {
        return view('admin.categoria.index');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'marca' => 'required',
        ]);

        $categoria = new Categoria();

        $categoria->nombre = $validatedData['nombre'];
        $categoria->descripcion = $validatedData['descripcion'];
        $categoria->marca = $validatedData['marca'];

        $categoria->save();

        if ($categoria){
            return redirect()->route('admin.categoria.index')->with('success', 'La categoria fue registrado correctamente.');
        } else {
            return redirect()->back()->withErrors('No se registro correctamente la categoria:' . $categoria->getMessage());
        }
    }

    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'marca' => 'required',
        ]);

        $categoria = Categoria::findOrFail($id);

        $categoria->nombre = $validatedData['nombre'];
        $categoria->descripcion = $validatedData['descripcion'];
        $categoria->marca = $validatedData['marca'];

        $categoria->save();

        if ($categoria) {
            return redirect()->route('admin.categoria.index')->with('success', 'La categoria fue actualizada correctamente.');
        } else {
            return back()->withErrors(['general' => 'Ocurrió un error al actualizar la categoría.']);
        }
    }

    public function destroy(string $id)
    {
        Categoria::find($id)->delete();
        return redirect()->route('admin.categoria.index')->with('success','la categoria fue  eliminado correctamente');
    }
}
