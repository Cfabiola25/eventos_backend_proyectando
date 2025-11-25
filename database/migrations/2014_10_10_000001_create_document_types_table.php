<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * ===================================
     * TIPOS DE DOCUMENTO
     * ===================================
     * Función: Define los tipos de documento que se pueden asociar a los eventos.
     * Ejemplo: "CEDULA", "TARJETA DE IDENTIDAD", "PASAPORTE".
     */
    public function up(): void
    {
        Schema::create('document_types', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->string('name')->unique(); // Nombre completo del documento
            $table->string('code')->unique(); // Código abreviado
            $table->timestamps(); // Fechas de creación y actualización
            $table->softDeletes(); // Borrado suave (deleted_at)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('document_types');
    }
};
