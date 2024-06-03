<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\Producto;

class ProductosController extends Controller
{
    public function index()
    {
        $productos = Producto::all();
        return view('index', compact('productos'));
    }

    public function create()
    {
        return view('productos.create');
    }

    public function store(Request $request)
    {
        $this->validateProducto($request);

        Producto::create($request->all());

        return redirect()->route('admin.index')->with('success', 'Producto creado exitosamente.');
    }

    public function show($id)
    {
        $producto = Producto::with('tallas')->find($id);

        if (!$producto) {
            abort(404); 
        }

     
        $tallas = $producto->tallas;

        return view('productos.show', compact('producto', 'tallas'));
    }

    public function edit($id)
    {
        $producto = Producto::find($id);

        if (!$producto) {
            abort(404); // Or redirect to a 404 error page
        }

        return view('productos.edit', compact('producto'));
    }

    public function update(Request $request, $id)
    {
        try {
            $this->validateProducto($request);

            $producto = Producto::find($id);

            if (!$producto) {
                abort(404); // Product not found
            }

            $producto->update($request->all());

            return redirect()->route('admin.index')->with('success', 'Producto actualizado exitosamente');
        } catch (\Exception $e) {
            return redirect()->route('productos.edit', $id)->with('error', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $producto = Producto::find($id);

            if (!$producto) {
                abort(404);
            }

            $producto->delete();

            return redirect()->route('admin.index')->with('success', 'Producto eliminado exitosamente');
        } catch (\Exception $e) {
            return redirect()->route('productos.destroy', $id)->with('error', $e->getMessage());
        }
    }

    private function validateProducto(Request $request)
    {
        $request->validate([
            'nom_producto' => 'required|string',
            'descripcion' => 'required|string',
            'precio' => 'required|numeric',
            'categoria' => 'required|string',
        ]);
    }
}
