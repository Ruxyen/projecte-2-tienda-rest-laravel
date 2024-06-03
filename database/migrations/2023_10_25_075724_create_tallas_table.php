<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTallasTable extends Migration
{
    public function up()
    {
        Schema::create('tallas', function (Blueprint $table) {
            $table->id('id_talla');
            $table->string('nom_talla');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tallas');
    }
}
