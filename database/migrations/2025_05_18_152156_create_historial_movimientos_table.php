<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('historial_movimientos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ente_origen_id')->nullable()->constrained('entes')->nullOnDelete();
            $table->foreignId('ente_destino_id')->nullable()->constrained('entes')->nullOnDelete();
            $table->foreignId('departamento_origen_id')->nullable()->constrained('departamentos')->nullOnDelete();
            $table->foreignId('departamento_destino_id')->nullable()->constrained('departamentos')->nullOnDelete();
            $table->foreignId('bien_id')->nullable()->constrained('bienes')->nullOnDelete();
             $table->foreignId('bien_asignado_id')->nullable()->constrained('bienes_asignados')->nullOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historial_movimientos');
    }
};
