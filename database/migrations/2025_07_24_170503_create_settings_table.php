<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * ===================================
     * CONFIGURACIONES DEL SISTEMA
     * ===================================
     * Función: Define las configuraciones del sistema.
     * Ejemplo: "Modo oscuro", "Notificaciones", "Idioma".
     */
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->string('name')->unique(); 
            $table->boolean('is_active')->default(false); 
            $table->text('description')->nullable(); // Descripción del parámetro
            $table->foreignId('user_id')->constrained();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
