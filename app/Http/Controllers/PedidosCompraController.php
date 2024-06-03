<?php

namespace App\Http\Controllers;
use App\Http\Models\DetallePedido;
use App\Http\Models\PedidoCompra;
use App\Http\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Carbon;

class PedidosCompraController extends Controller
{
    public function create()
    {
        $users = User::all();
        return view('pedidoscompra.create', compact('users'));

    }

    public function store(Request $request)
{
    try {
        $request->validate([
            'fecha_pedido' => 'required|date',
            'total_pedido' => 'required|numeric',
            'user_id' => 'required|exists:users,id'
        ]);

        $pedido = new PedidoCompra();
        $pedido->fecha_pedido = $request->fecha_pedido;
        $pedido->total_pedido = $request->total_pedido;
        $pedido->user_id = $request->user_id;
        $pedido->save();

        $detalle = new DetallePedido();
        $detalle->id_pedido = $pedido->id;
        $detalle->cantidad_productos = 0; 
        $detalle->precio_total = $request->total_pedido; 
        $detalle->save();

        return redirect()->route('admin.index')->with('success', 'Pedido de compra creado exitosamente');
    } catch (\Exception $e) {
        return redirect()->route('pedidoscompra.create')->with('error', $e->getMessage());
    }
}




    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'fecha_pedido' => 'required|date',
                'total_pedido' => 'required|numeric',
                'user_id' => 'required|exists:users,id' 
            ]);
    
            $pedidoCompra = PedidoCompra::find($id);
            $pedidoCompra->update([
                'fecha_pedido' => Carbon::now(),
                'total_pedido' => $request->total_pedido
            ]);
    
            return redirect()->route('admin.index')->with('success', 'Pedido de compra actualizado exitosamente');
        } catch (\Exception $e) {
            return redirect()->route('pedidoscompra.edit', $id)->with('error', $e->getMessage());
        }
    }
    public function destroy($id)
    {
        try {
            $pedidoCompra = PedidoCompra::find($id);
            $pedidoCompra->delete();

            return redirect()->route('admin.index')->with('success', 'Pedido de compra eliminado exitosamente');
        } catch (\Exception $e) {
            return redirect()->route('admin.index')->with('error', $e->getMessage());
        }
    }

        public function edit($id)
    {
        try {
            $pedidoCompra = PedidoCompra::find($id);
            $users = User::all();
            return view('pedidoscompra.edit', compact('pedidoCompra', 'users'));
        } catch (\Exception $e) {
            return redirect()->route('admin.index')->with('error', $e->getMessage());
        }
    }

}