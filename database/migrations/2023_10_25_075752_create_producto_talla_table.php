<?php

// database/migrations/*_create_producto_talla_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductoTallaTable extends Migration
{
    public function up()
    {
        Schema::create('producto_talla', function (Blueprint $table) {
            $table->id('id_producto_talla');
            $table->unsignedBigInteger('id_producto');
            $table->unsignedBigInteger('id_talla');
            $table->timestamps();

            // Foreign key relationships
            $table->foreign('id_producto')->references('id_producto')->on('productos')->onDelete('cascade');
            $table->foreign('id_talla')->references('id_talla')->on('tallas')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('producto_talla');
    }
}
