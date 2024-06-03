<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DetallePedido;

class DetallesPedidosTableSeeder extends Seeder
{
    public function run()
    {
        \App\Http\Models\DetallePedido::factory(10)->create();
    }
}