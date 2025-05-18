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
      /*  Schema::create('detalles_formulacion', function (Blueprint $table) {
            $table->id();
            $table->foreignId('formulacion_id')->constrained('formulaciones')->onDelete('cascade');
            $table->foreignId('partida_id')->constrained()->onDelete('cascade');
            $table->foreignId('ente_id')->constrained('entes')->onDelete('cascade');
            $table->decimal('presupuesto', 20, 2)->default(0);
            $table->decimal('otros', 20, 2)->default(0);
            $table->timestamps();
        });*/
        
    }

    /**
     * Reverse the migrations.
     */
  /*  public function down(): void
    {
        Schema::dropIfExists('detalle_formulacions');
    }*/
};
