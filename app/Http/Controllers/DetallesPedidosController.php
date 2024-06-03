<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Models\DetallePedido;

class DetallesPedidosController extends Controller
{
 

    public function create()
    {
        return view('detallespedidos.create');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'id_pedido' => 'required|exists:pedidos_compra,id_pedido',
                'cantidad_productos' => 'required|numeric',
                'precio_total' => 'required|numeric',
            ]);

            DetallePedido::create($request->all());

            return redirect()->route('admin.index')->with('success', 'Detalle pedido creado exitosamente');
        } catch (\Exception $e) {
            return redirect()->route('detallespedidos.create')->with('error', $e->getMessage());
        }
    }

    public function show($id)
    {
        $detallePedido = DetallePedido::find($id);
        return view('detallespedidos.show', compact('detallePedido'));
    }

    public function edit($id)
    {
        $detallePedido = DetallePedido::find($id);
        return view('detallespedidos.edit', compact('detallePedido'));
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'id_pedido' => 'required|exists:pedidos_compra,id_pedido',
                'cantidad_productos' => 'required|numeric',
                'precio_total' => 'required|numeric',
            ]);

            $detallePedido = DetallePedido::find($id);
            $detallePedido->update($request->all());

            return redirect()->route('admin.index')->with('success', 'Detalle de pedido actualizado exitosamente');
        } catch (\Exception $e) {
            return redirect()->route('detallespedidos.edit', $id)->with('error', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $detallePedido = DetallePedido::findOrFail($id);
        $detallePedido->delete();

        return redirect()->route('admin.index')->with('success', 'Detalle de pedido eliminado correctamente');
    }
}
    