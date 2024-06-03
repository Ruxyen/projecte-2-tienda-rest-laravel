<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\ProductoTalla;

class ProductoTallaController extends Controller
{
    public function show($id)
{
    $productotalla = ProductoTalla::findOrFail($id);
    return view('producto_talla.show', compact('productotalla'));
}

    public function destroy($id)
    {
        try {
            $productotalla = ProductoTalla::findOrFail($id);
            $productotalla->delete();
            return redirect()->route('admin.index')->with('success', 'Producto Talla eliminado exitosamente');
        } catch (\Exception $e) {
            return redirect()->route('producto_talla.destroy', $id)->with('error', $e->getMessage());
        }
    }

    public function create()
    {
        return view('producto_talla.create');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'id_talla' => 'required',
                'id_producto' => 'required',
            ]);

            ProductoTalla::create($request->all());

            return redirect()->route('admin.index')->with('success', 'Producto Talla creado exitosamente');
        } catch (\Exception $e) {
            return redirect()->route('producto_talla.create')->with('error', $e->getMessage());
        }
    }

    public function edit($id)
{
    $productotalla = ProductoTalla::findOrFail($id);
    return view('producto_talla.edit', compact('productotalla'));
}

    public function update(Request $request, $id)
    {
        try {
            $productotalla = ProductoTalla::findOrFail($id);

            $request->validate([
                'id_talla' => 'required',
                'id_producto' => 'required',
            ]);

            $productotalla->update($request->all());

            return redirect()->route('admin.index')->with('success', 'Producto Talla actualizado exitosamente');
        } catch (\Exception $e) {
            return redirect()->route('producto_talla.edit', $id)->with('error', $e->getMessage());
        }
    }
}
