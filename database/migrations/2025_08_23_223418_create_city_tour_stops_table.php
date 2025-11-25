<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * ===================================
     * ESCALAS O PARADAS DE CITY TOURS
     * ===================================
     * Función: Define los puntos intermedios o escalas dentro de un recorrido turístico.
     * Ejemplo: "FESC → Cristo Rey → Terminal → Malecón".
     */
    public function up(): void
    {
        Schema::create('city_tour_stops', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->foreignId('city_tour_id')->constrained('city_tours'); // Relación con el tour principal (Ej: "Recorrido Histórico por Cúcuta")
            $table->unsignedInteger('order')->default(1); // Orden de la parada dentro del recorrido (Ej: 1 = primera parada, 2 = segunda parada)
            $table->string('name'); // Nombre de la parada (Ej: "Cristo Rey", "Terminal de Cúcuta")
            $table->text('description')->nullable(); // Descripción de la parada (Ej: "Visita al mirador con vista panorámica de la ciudad")
            $table->time('arrival_time')->nullable(); // Hora estimada de llegada a la parada (Ej: "10:30:00")
            $table->time('departure_time')->nullable(); // Hora estimada de salida de la parada (Ej: "11:00:00")
            $table->boolean('is_active')->default(true); 
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('city_tour_stops');
    }
};
