<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\User;
use App\Http\Models\PedidoCompra;
use App\Http\Models\DetallePedido;
use Illuminate\Support\Facades\Validator;


class UsuariosControllerApi extends Controller
{
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $usuarios = User::latest()->paginate(10);

        $response = [
            'success' => true,
            'message' => "Llistat planetes recuperat",
            'data' => $usuarios,
        ];

        //return $response;
        return response()->json($response, 200);
    }

    public function all()
    {

        $usuarios = User::all();

        $response = [
            'success' => true,
            'message' => "Llistat planetes recuperat",
            'data' => $usuarios,
        ];

        return response()->json($response, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fecha_pedido' => 'required|date',
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
            // Crear el pedido de compra
            $pedido = PedidoCompra::create([
                'fecha_pedido' => $request->fecha_pedido,
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validar campos
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required|min:3|max:10',
            'email' => 'required|email|unique:users',
        ]);

        if ($validator->fails()) {
            $response = [
                'success' => false,
                'message' => 'Errores de validación',
                'data' => $validator->errors()->all(),
            ];
            return response()->json($response, 422); // Cambiado a código 422 para errores de validación
        }

        $usuario = User::create($input);

        $response = [
            'success' => true,
            'message' => 'Usuario creado correctamente',
            'data' => $usuario,
        ];
        return response()->json($response, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $usuario = User::find($id);
        if ($usuario == null) {

            $response = [
                'success' => false,
                'message' => "Planeta no trobat",
                'data' => [],
            ];

            return response()->json($response, 404);
        }

        $response = [
            'success' => true,
            'message' => "Planeta trobat",
            'data' => $usuario,
        ];

        return response()->json($response, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $usuario = User::find($id);
        if ($usuario == null) {
            $response = [
                'success' => false,
                'message' => "Planeta no trobat",
                'data' => [],
            ];
            return response()->json($response, 404);
        }

        $input = $request->all();
        $validator = Validator::make(
            $input,
            [
                'name' => 'required|min:3|max:10',

            ]
        );

        if ($validator->fails()) {
            $response = [
                'success' => false,
                'message' => "Errors de validació",
                'data' => $validator->errors()->all(),
            ];
            return response()->json($response, 400);
        }


        $usuario->update($input);

        $response = [
            'success' => true,
            'message' => "Planeta actualitzat correctament",
            'data' => $usuario,
        ];
        return response()->json($response, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $usuario = User::find($id);
        if ($usuario == null) {

            $response = [
                'success' => false,
                'message' => "Planeta no trobat",
                'data' => [],
            ];

            return response()->json($response, 404);
        }

        try {
            $usuario->delete();

            $response = [
                'success' => true,
                'message' => "Planeta esborrat",
                'data' => $usuario,
            ];

            return response()->json($response, 200);
        } catch (\Exception $e) {
            $response = [
                'success' => false,
                'message' => "Error esborrant planeta",
            ];

            return response()->json($response, 400);
        }
    }
}
