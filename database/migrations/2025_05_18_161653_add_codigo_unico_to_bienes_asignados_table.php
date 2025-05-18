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
        Schema::table('historial_movimientos', function (Blueprint $table) {
            $table->string('codigo_inventario');
        });
    }

    public function down()
    {
        Schema::table('historial_movimientos', function (Blueprint $table) {
            $table->dropColumn('codigo_inventario');
        });
    }
};
