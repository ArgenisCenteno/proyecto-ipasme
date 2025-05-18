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
      /*  Schema::create('modificaciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ente_id')->constrained('entes')->onDelete('cascade');
            $table->foreignId('partida_id')->constrained()->onDelete('cascade');
            $table->decimal('monto', 20, 2);
            $table->string('tipo'); // Por ejemplo: 'aumento', 'reducción', etc.
            $table->timestamps();
        });
        */
    }

    /**
     * Reverse the migrations.
     */
   /* public function down(): void
    {
        Schema::dropIfExists('table_modificacion');
    }*/
};
