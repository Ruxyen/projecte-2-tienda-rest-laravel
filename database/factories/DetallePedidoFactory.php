<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\DetallePedido;

class DetallePedidoFactory extends Factory
{
    protected $model = DetallePedido::class;

    public function definition()
    {
        return [
            'id_pedido' => \App\Models\PedidoCompra::factory(),
            'cantidad_productos' => $this->faker->numberBetween(1, 10),
            'precio_total' => $this->faker->randomFloat(2, 10, 500),
        ];
    }
}