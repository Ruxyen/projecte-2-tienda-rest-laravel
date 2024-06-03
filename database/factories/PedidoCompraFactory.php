<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\PedidoCompra;

class PedidoCompraFactory extends Factory
{
    protected $model = PedidoCompra::class;

    public function definition()
    {
        return [
            'fecha_pedido' => $this->faker->date,
            'total_pedido' => $this->faker->randomFloat(2, 10, 1000),
            'id_cliente' => \App\Models\Cliente::factory(),
        ];
    }
}