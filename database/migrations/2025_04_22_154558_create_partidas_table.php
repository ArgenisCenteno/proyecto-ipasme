<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
      /*  Schema::create('partidas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nombre_partida_id')->constrained('codigos_partidas')->onDelete('cascade');
            $table->foreignId('codigo_partida_id')->constrained('nombres_partidas')->onDelete('cascade');
            $table->text('descripcion')->nullable();
            $table->boolean('estatus')->default(true);
            $table->boolean('fondo_en_avance')->default(false);
            $table->boolean('fondo_en_anticipo')->default(false);
            $table->boolean('orden_de_pago')->default(false);
            $table->date('fecha')->nullable();
            $table->boolean('slug')->default(false);
            $table->integer('nivel')->default(1);
            $table->boolean('cash')->default(false);
            $table->timestamps();
        });*/
        
    }

    /**
     * Reverse the migrations.
     */
   /* public function down(): void
    {
        Schema::dropIfExists('partidas');
    }*/
};
