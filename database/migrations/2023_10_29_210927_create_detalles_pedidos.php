<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('detalles_pedidos', function (Blueprint $table) {
        $table->id('id_detalle_pedido');
        $table->unsignedBigInteger('id_pedido'); // Cambio a unsignedBigInteger para la clave foránea
        $table->integer('cantidad_productos');
        $table->decimal('precio_total');
         
        // Clave foránea para relacionar con la tabla pedidos_compra
        $table->foreign('id_pedido')->references('id')->on('pedidos_compra');
    });
}




    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalles_pedidos');
    }
};
