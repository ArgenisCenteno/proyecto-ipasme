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
        Schema::create('bienes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->text('descripcion')->nullable();
            $table->foreignId('categoria_id')->constrained('categorias')->onDelete('cascade');
            $table->string('codigo_inventario')->unique();
           // $table->integer('inventario_inicial')->default(0);
           // $table->foreignId('departamento_id')->constrained('departamentos')->onDelete('cascade');

            $table->enum('estado', ['Activo', 'Inactivo'])->default('Activo');
           // $table->date('fecha_adquisicion')->nullable();
            $table->string('unidad_medida')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bienes');
    }
};
