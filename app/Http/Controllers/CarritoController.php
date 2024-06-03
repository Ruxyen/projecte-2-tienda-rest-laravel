<?php

namespace App\Http\Controllers;
use App\Http\Models\Producto;
use App\Http\Models\ProductoTalla;


use Illuminate\Http\Request;

class CarritoController extends Controller
{
    public function mostrarCarrito()
    {
        $carrito = session('carrito', []);

        // Lógica para mostrar los productos en el carrito
        return view('carrito.mostrar', compact('carrito'));
    }

    public function agregarAlCarrito(Request $request, $idProducto)
{

    $userId = \Illuminate\Support\Facades\Auth::id();

    $carrito = session('carrito', []);

    $producto = Producto::find($idProducto);
    $idTalla = $request->input('talla');
    $talla = $producto->tallas()->wherePivot('id_talla', $idTalla)->first();
    $nomTalla = $talla->nom_talla;

    if ($producto && $talla) {
        $idProductoConTalla = $idProducto . '_' . $idTalla;

        if (array_key_exists($idProductoConTalla, $carrito)) {

            $carrito[$idProductoConTalla]['cantidad'] += $request->input('quantity');
        } else {
            $carrito[$idProductoConTalla] = [
                'id' => $producto->id_producto,
                'nombre' => $producto->nom_producto,
                'precio' => $producto->precio,
                'cantidad' => $request->input('quantity'),
                'talla' => $nomTalla,
                'categoria' => $producto->categoria,
                'user_id' => $userId, 

            ];
        }
    }

    session(['carrito' => $carrito]);


    return redirect()->route('compra.confirmacion')->with('success', 'Producto agregado al carrito');
}
    

    public function eliminarDelCarrito($id)
    {
        $carrito = session('carrito', []);


        unset($carrito[$id]);

        session(['carrito' => $carrito]);

        return redirect()->route('carrito.mostrar')->with('success', 'Producto eliminado del carrito');
    }
}