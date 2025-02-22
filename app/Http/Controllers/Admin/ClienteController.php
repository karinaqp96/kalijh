<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view ('admin.cliente.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required',
            'direccion' => 'required',
            'celular' => 'required',
        ]);

        $cliente = new cliente();

        $cliente->nombre = $validatedData['nombre'];
        $cliente->direccion = $validatedData['direccion'];
        $cliente->celular= $validatedData['celular'];

        $cliente->save();

        if ($cliente){
            return redirect()->route('admin.cliente.index')->with('success', 'El cliente fue registrado correctamente.');
        } else {
            return redirect()->back()->withErrors('No se registro correctamente' . $cliente->getMessage());
        }
    }

        /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'nombre' => 'required',
            'direccion' => 'required',
            'celular' => 'required',
        ]);

        $cliente = Cliente::findOrFail($id);

        $cliente->nombre = $validatedData['nombre'];
        $cliente->direccion = $validatedData['direccion'];
        $cliente->celular = $validatedData['celular'];

        $cliente->save();

        if ($cliente) {
            return redirect()->route('admin.cliente.index')->with('succes', 'Los datos del cliente fue actualizada correctamente');
        } else {
            return redirect()->back()->withErrors('no se actualizó correctamente los datos del cliente' . $cliente->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Cliente::find($id)->delete();
        return redirect()->route('admin.cliente.index')->with('success','El registro del cliente fue  eliminado correctamente');
    }
}
