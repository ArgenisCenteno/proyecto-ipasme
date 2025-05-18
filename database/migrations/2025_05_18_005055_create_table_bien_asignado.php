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
        Schema::create('bienes_asignados', function (Blueprint $table) {
            $table->id();
            $table->foreignId('departamento_id')->constrained('departamentos')->onDelete('cascade');
            $table->foreignId('ente_id')->constrained('entes')->onDelete('cascade');
            $table->foreignId('bien_id')->constrained('bienes')->onDelete('cascade');
            $table->foreignId('movimiento_id')->constrained('movimientos')->onDelete('cascade');
            $table->decimal('cantidad', 10, 2);
            $table->enum('estado', ['Activo', 'Inactivo', 'Dañado', 'Mantenimiento', 'Desaparecido'])->default('Activo');
            $table->date('fecha_adquisicion')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bienes_asignados');
    }
};
