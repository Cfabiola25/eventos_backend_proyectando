<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * ===================================
     * Generos
     * ===================================
     * Función: Define los géneros en los que se pueden clasificar los eventos.
     * Ejemplo: "Masculino", "Femenino", "No binario".
     */
    public function up(): void
    {
        Schema::create('genders', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->string('name')->unique(); // Nombre del género (único)
            $table->boolean('is_active')->default(true); // Indica si el género está activo
            $table->timestamps(); // Fechas de creación y actualización
            $table->softDeletes(); // Borrado suave (deleted_at)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('genders');
    }
};
