<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * ===================================
     * EVENTO - PROGRAMA (Pivot)
     * ===================================
     * Función: Relaciona un evento con uno o varios programas académicos.
     * Ejemplo: "Taller de Marketing Digital" → asociado a "Administración de Empresas" y "Comunicación Social".
     */
    public function up(): void
    {
        Schema::create('event_program', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->foreignId('event_id')->constrained('events')->onDelete('cascade'); // Evento relacionado
            $table->foreignId('program_id')->constrained('programs')->onDelete('cascade'); // Programa relacionado
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_program');
    }
};
