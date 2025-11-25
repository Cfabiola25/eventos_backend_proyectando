<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * =================================================
     * RELACIÓN INSCRIPCIÓN GENERAL ↔ CITY TOUR (OPCIONAL)
     * =================================================
     * Función: Permitir que los participantes se inscriban en city tours adicionales 
     * al registrarse en el evento principal.
     * Ejemplo: Inscripción "Juan Pérez" → City Tour "Recorrido Histórico por la Ciudad".
     */
    public function up(): void
    {
        Schema::create('registration_city_tour', function (Blueprint $table) {
            $table->id();
             $table->uuid('uuid')->unique(); // Ej: "RCT-12345"
            
            // Relación con la inscripción general
            $table->foreignId('registration_id')->constrained('registrations'); 
            
            // Relación con el city tour
            $table->foreignId('city_tour_id')->constrained('city_tours'); 
            
            // Cantidad de cupos reservados (por si se permite más de 1 persona)
            $table->unsignedInteger('quantity')->default(1); // Ej: 2
            
            // Estado del registro en el carrito
            $table->enum('status', ['pendiente', 'confirmado', 'cancelado'])->default('pendiente');
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registration_city_tour');
    }
};
