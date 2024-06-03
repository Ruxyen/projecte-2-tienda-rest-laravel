<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Http\Models\ProductoTalla;
use App\Http\Models\Producto;
use App\Http\Models\Talla;

class ProductoTallaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Suponiendo que ya tienes productos y tallas existentes en la base de datos
        $productos = Producto::pluck('id_producto');
        $tallas = Talla::pluck('id_talla');

        // Puedes ajustar este bucle según tus necesidades y relaciones
        foreach ($productos as $producto) {
            foreach ($tallas as $talla) {
                ProductoTalla::create([
                    'id_producto' => $producto,
                    'id_talla' => $talla,
                ]);
            }
        }
    }
}

