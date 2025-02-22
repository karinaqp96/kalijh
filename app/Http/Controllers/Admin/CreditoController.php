<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Creditos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class CreditoController extends Controller
{
    public function index()
    {
        return view('admin.credito.index');
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cliente_id' => 'required|exists:clientes,id',
            'productos_id' => 'required|exists:productos,id',
            'descripcion' => 'required',
            'cantidad' => 'required|numeric',
            'estado' => 'required|numeric',
        ]);

        try {
            $validator->validate();
            $credito = new creditos();
            $credito->cliente_id = $request->cliente_id;
            $credito->productos_id = $request->productos_id;
            $credito->descripcion = $request->descripcion;
            $credito->cantidad = $request->cantidad;
            $credito->estado = $request->estado;
            
            $credito->save();

            if ($credito) {
                return redirect()->route('admin.credito.index')->with('success', 'El credito fue registrado correctamente.');
            } else {
                return back()->withErrors(['general' => 'Ocurrió un error al crear el credito.']);
            }
        } catch (ValidationException $e) {
            return back()->withErrors($e->validator->errors());
        }
    }

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'cliente_id' => 'required|exists:clientes,id',
            'productos_id' => 'required|exists:productos,id',
            'descripcion' => 'required',
            'cantidad' => 'required|numeric',
            'estado' => 'required|numeric',
        ]);

        try {
            $validator->validate();

            $credito = creditos::findOrFail($id);
            $credito->cliente_id = $request->cliente_id;
            $credito->productos_id = $request->productos_id;
            $credito->descripcion = $request->descripcion;
            $credito->cantidad = $request->cantidad;
            $credito->estado = $request->estado;

            $credito->save();

            if ($credito) {
                return redirect()->route('admin.credito.index')->with('success', 'El credito fue actualizada correctamente.');
            } else {
                return back()->withErrors(['general' => 'Ocurrió un error al actualizar el credito.']);
            }
        } catch (ValidationException $e) {
            return back()->withErrors($e->validator->errors());
        }
    }

    public function destroy(string $id)
    {
        creditos::find($id)->delete();
        return redirect()->route('admin.credito.index')->with('success', 'El credito fue eliminado correctamente.');
    }
}