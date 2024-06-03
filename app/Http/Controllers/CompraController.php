<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\DetallePedido;
use App\Http\Models\PedidoCompra;
use Illuminate\Support\Facades\DB;

class CompraController extends Controller
{
    public function confirmacion(Request $request) {
        $carrito = $request->session()->get('carrito', []);

        $totalAPagar = $this->calcularTotalAPagar($carrito);
        $productosEnCarrito = $this->obtenerProductosEnCarrito($carrito);

        return view('compra.confirmacion', compact('productosEnCarrito', 'totalAPagar'));
    }

    public function confirmarCompra(Request $request) {
        DB::beginTransaction(); // Comienza la transacción
        
        try {
            $pedido = new PedidoCompra();
            $pedido->fecha_pedido = now();
            $pedido->total_pedido = $request->input('totalAPagar');
    
            $userId = \Illuminate\Support\Facades\Auth::id();
            $pedido->user_id = $userId; 
    
            $pedido->save();
    
            $detalle = new DetallePedido();
            $detalle->id_pedido = $pedido->id;
            $detalle->cantidad_productos = $this->calcularCantidadProductos($request->session()->get('carrito'));
            $detalle->precio_total = $request->input('totalAPagar');
            $detalle->save();
            
            DB::commit(); 
    
            $request->session()->forget('carrito');
    
            return redirect()->route('index')->with('success', '¡Compra realizada con éxito! La cesta ha sido limpiada.');
        } catch (\Exception $e) {
            DB::rollBack(); 
    
        }
    }

    private function calcularTotalAPagar($carrito) {
        $total = 0;
    
        foreach ($carrito as $producto) {
            $total += $producto['precio'] * $producto['cantidad'];
        }
        
        return $total;
    }
    
    private function obtenerProductosEnCarrito($carrito) {
        return $carrito;
    }

    private function calcularCantidadProductos($carrito) {
        return count($carrito);
    }

    private function obtenerIdPedido() {
        $ultimoPedido = PedidoCompra::orderBy('id', 'desc')->first(); 
        $nuevoId = $ultimoPedido ? $ultimoPedido->id + 1 : 1; 
        
        return $nuevoId;
    }
}