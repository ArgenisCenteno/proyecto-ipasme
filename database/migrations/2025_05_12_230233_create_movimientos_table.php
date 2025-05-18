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
        Schema::create('movimientos', function (Blueprint $table) {
            $table->id();
            $table->string('tipo');
            $table->string('descripcion');
            $table->date('fecha');
            $table->string('factura')->nullable();
            $table->decimal('monto', 12, 2)->nullable();
            $table->text('observacion')->nullable();
            $table->foreignId('ente_origen_id')->nullable()->constrained('entes')->nullOnDelete();
            $table->foreignId('ente_destino_id')->nullable()->constrained('entes')->nullOnDelete();
            $table->foreignId('departamento_origen_id')->nullable()->constrained('departamentos')->nullOnDelete();
            $table->foreignId('departamento_destino_id')->nullable()->constrained('departamentos')->nullOnDelete();
            $table->text('observaciones')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movimientos');
    }
};
