<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PedidoCompra;

class PedidosCompraTableSeeder extends Seeder
{
    public function run()
    {
        \App\Http\Models\PedidoCompra::factory(10)->create();
    }
}