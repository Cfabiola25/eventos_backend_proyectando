<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * ===================================
     * TIPOS DE USUARIO
     * ===================================
     * Función: Define los tipos de usuario que pueden interactuar con la plataforma.
     * Ejemplo: "Administrador", "Organizador", "Asistente".
     */
    public function up(): void
    {
        Schema::create('user_types', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->string('type')->unique(); // Tipo de persona
            $table->string('description'); // Descripción del tipo
            $table->boolean('is_active')->default(true); // Estado del tipo de usuario
            $table->timestamps(); // Fechas de creación y actualización
            $table->softDeletes(); // Borrado suave (deleted_at)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_types');
    }
};
