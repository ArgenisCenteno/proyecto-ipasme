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
        Schema::table('bienes_asignados', function (Blueprint $table) {
            $table->string('codigo_inventario');
        });
    }

    public function down()
    {
        Schema::table('bienes_asignados', function (Blueprint $table) {
            $table->dropColumn('codigo_inventario');
        });
    }
};
