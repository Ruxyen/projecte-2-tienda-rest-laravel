<?php

namespace App\Http\Controllers\api;

use Illuminate\Support\Facades\Log;
use App\Http\Models\ProductoTalla;
use App\Http\Models\Talla;
use App\Http\Models\Producto;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductoTallaControllerApi extends Controller
{
    public function index()
    {
        $productosTallas = ProductoTalla::with('producto', 'talla')->get();

        return response()->json($productosTallas);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_producto' => 'required',
            'id_talla' => 'required',
            // Agrega otras reglas de validación según tus necesidades
        ]);

        // Puedes realizar validaciones adicionales si es necesario

        // Crea un nuevo registro en la tabla ProductoTalla
        $productoTalla = ProductoTalla::create($request->all());

        return response()->json($productoTalla, 201);
    }



    public function update(Request $request, ProductoTalla $productoTalla)
    {
        try {
            $request->validate([
                'id_producto' => 'required',
                'id_talla' => 'required',
                // Agrega otras reglas de validación según tus necesidades
            ]);

            // Loguea información específica antes de la actualización
            Log::debug('ID del ProductoTalla:', $productoTalla->id);
            Log::debug('ID del Producto:', $request->id_producto);
            Log::debug('ID de la Talla:', $request->id_talla);

            // Actualiza las propiedades del ProductoTalla
            $productoTalla->update([
                'id_producto' => $request->id_producto,
                'id_talla' => $request->id_talla,
                // Actualiza otras propiedades según tus necesidades
            ]);

            Log::debug('ProductoTalla actualizado:', $productoTalla->toArray());

            return response()->json($productoTalla, 200);
        } catch (\Exception $e) {
            // Registra la excepción en los registros de errores
            Log::error('Error al actualizar ProductoTalla: ' . $e->getMessage());

            // Devuelve una respuesta de error al cliente
            return response()->json(['error' => 'Error interno del servidor'], 500);
        }
    }







    public function storeOrUpdate(Request $request)
    {
        try {
            $request->validate([
                'id_producto' => 'required',
                'id_talla' => 'required',
                // Agrega otras reglas de validación según tus necesidades
            ]);

            // Puedes realizar validaciones adicionales si es necesario

            // Intenta encontrar un registro existente por id_producto e id_talla
            $existingRecord = ProductoTalla::where('id_producto', $request->id_producto)
                ->where('id_talla', $request->id_talla)
                ->first();

            if ($existingRecord) {
                // Si existe, actualiza el registro
                \Illuminate\Support\Facades\Log::debug('Actualizando registro existente:', $existingRecord->toArray());

                $existingRecord->update($request->all());
                return response()->json($existingRecord, 200);
            }

            // Si no existe, crea un nuevo registro
            $newRecord = ProductoTalla::create($request->all());
            return response()->json($newRecord, 201);
        } catch (\Exception $e) {
            // Registra la excepción en los registros de errores
            \Illuminate\Support\Facades\Log::error('Error al crear o actualizar ProductoTalla: ' . $e->getMessage());

            // Devuelve una respuesta de error al cliente
            return response()->json(['error' => 'Error interno del servidor'], 500);
        }
    }



    public function destroy(ProductoTalla $productoTalla)
    {
        try {
            $productoTalla->delete();
            return response()->json(null, 204);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al eliminar el registro: ' . $e->getMessage()], 500);
        }
    }
    public function show($id)
    {
        try {
            $productoTalla = ProductoTalla::with('producto', 'talla')->findOrFail($id);

            return response()->json($productoTalla);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Producto-Talla no encontrado'], 404);
        }
    }
}
