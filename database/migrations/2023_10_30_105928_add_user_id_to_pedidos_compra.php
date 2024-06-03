<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::table('pedidos_compra', function (Blueprint $table) {
        if (!Schema::hasColumn('pedidos_compra', 'user_id')) {
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
        }
    });
}

public function down()
{
    Schema::table('pedidos_compra', function (Blueprint $table) {
        if (Schema::hasColumn('pedidos_compra', 'user_id')) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        }
    });
}
};
