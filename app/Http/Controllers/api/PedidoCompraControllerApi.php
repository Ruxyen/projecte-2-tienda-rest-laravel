<?php

namespace App\Http\Controllers\api;

use App\Http\Models\PedidoCompra;
use App\Http\Models\DetallePedido;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PedidoCompraControllerApi extends Controller
{
    public function index()
    {
        $pedidos = PedidoCompra::with('cliente')->orderBy('fecha_pedido', 'desc')->paginate(10);

        $response = [
            'success' => true,
            'message' => 'Lista de pedidos de compra recuperada',
            'data' => $pedidos,
        ];

        return response()->json($response, 200);
    }

    public function show($id)
    {
        $pedido = PedidoCompra::with('cliente', 'detalles')->find($id);

        if ($pedido == null) {
            $response = [
                'success' => false,
                'message' => 'Pedido de compra no encontrado',
                'data' => [],
            ];

            return response()->json($response, 404);
        }

        $response = [
            'success' => true,
            'message' => 'Pedido de compra recuperado',
            'data' => $pedido,
        ];

        return response()->json($response, 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fecha_pedido' => 'required|date_format:d/m/Y',
            'total_pedido' => 'required|numeric',
            'user_id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            $response = [
                'success' => false,
                'message' => 'Errores de validación',
                'data' => $validator->errors()->all(),
            ];

            return response()->json($response, 422);
        }

        try {
            // Formatear la fecha antes de almacenarla
            $fechaPedido = \Carbon\Carbon::createFromFormat('d/m/Y', $request->fecha_pedido)
                ->format('Y-m-d H:i:s');

            // Crear el pedido de compra
            $pedido = PedidoCompra::create([
                'fecha_pedido' => $fechaPedido,
                'total_pedido' => $request->total_pedido,
                'user_id' => $request->user_id,
            ]);

            // Crear el detalle del pedido con cantidad_productos predeterminado
            $detalle = new DetallePedido([
                'cantidad_productos' => 1,
                'precio_total' => $request->total_pedido,
            ]);

            // Guardar el detalle del pedido en relación con el pedido de compra
            $pedido->detalles()->save($detalle);

            $response = [
                'success' => true,
                'message' => 'Pedido de compra creado correctamente',
                'data' => $pedido,
            ];

            return response()->json($response, 200);
        } catch (\Exception $e) {
            $response = [
                'success' => false,
                'message' => 'Error al crear el pedido de compra',
                'data' => [],
            ];

            return response()->json($response, 500);
        }
    }

    public function update(Request $request, $id)
    {
        $pedido = PedidoCompra::find($id);

        if ($pedido == null) {
            $response = [
                'success' => false,
                'message' => 'Pedido de compra no encontrado',
                'data' => [],
            ];

            return response()->json($response, 404);
        }

        $validator = Validator::make($request->all(), [
            'fecha_pedido' => 'required|date_format:d/m/Y',
            'total_pedido' => 'required|numeric',
            'user_id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            $response = [
                'success' => false,
                'message' => 'Errores de validación',
                'data' => $validator->errors()->all(),
            ];

            return response()->json($response, 422);
        }

        try {
            // Formatear la fecha antes de actualizar el pedido de compra
            $fechaPedido = \Carbon\Carbon::createFromFormat('d/m/Y', $request->fecha_pedido)
                ->format('Y-m-d H:i:s');

            // Actualizar el pedido de compra
            $pedido->update([
                'fecha_pedido' => $fechaPedido,
                'total_pedido' => $request->total_pedido,
                'user_id' => $request->user_id,
            ]);

            $response = [
                'success' => true,
                'message' => 'Pedido de compra actualizado correctamente',
                'data' => $pedido,
            ];

            return response()->json($response, 200);
        } catch (\Exception $e) {
            $response = [
                'success' => false,
                'message' => 'Error al actualizar el pedido de compra',
                'data' => [],
            ];

            return response()->json($response, 500);
        }
    }

    public function destroy($id)
    {
        $pedido = PedidoCompra::find($id);

        if ($pedido == null) {
            $response = [
                'success' => false,
                'message' => 'Pedido de compra no encontrado',
                'data' => [],
            ];

            return response()->json($response, 404);
        }

        try {
            // Eliminar el pedido de compra y sus detalles relacionados
            $pedido->detalles()->delete();
            $pedido->delete();

            $response = [
                'success' => true,
                'message' => 'Pedido de compra eliminado correctamente',
                'data' => [],
            ];

            return response()->json($response, 200);
        } catch (\Exception $e) {
            $response = [
                'success' => false,
                'message' => 'Error al eliminar el pedido de compra',
                'data' => [],
            ];

            return response()->json($response, 500);
        }
    }
}
