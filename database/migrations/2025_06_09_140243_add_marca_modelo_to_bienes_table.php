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
    Schema::table('bienes', function (Blueprint $table) {
        $table->string('marca')->nullable()->after('nombre'); // Ajusta el campo de referencia
        $table->string('modelo')->nullable()->after('marca');
    });
}

public function down()
{
    Schema::table('bienes', function (Blueprint $table) {
        $table->dropColumn(['marca', 'modelo']);
    });
}

};
