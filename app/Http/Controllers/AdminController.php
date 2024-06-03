<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Models\User;
use App\Http\Models\Producto;
use App\Http\Models\PedidoCompra;
use App\Http\Models\DetallePedido;
use App\Http\Models\Talla;
use App\Http\Models\ProductoTalla;

class AdminController extends Controller
{
    public function index()
{
    $users = User::all();
    $productos = Producto::all();
    $pedidosCompra = PedidoCompra::all();
    $detallesPedidos = DetallePedido::all();
    $tallas = Talla::all();
    $productotallas = ProductoTalla::all(); 

    return view('admin', compact('users', 'productos', 'pedidosCompra', 'detallesPedidos', 'tallas', 'productotallas'));
}

}
