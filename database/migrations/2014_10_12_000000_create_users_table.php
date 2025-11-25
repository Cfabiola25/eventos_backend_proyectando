<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * ===================================
     * USUARIOS
     * ===================================
     * Función: Define los usuarios que pueden interactuar con la plataforma.
     * Ejemplo: "Usuario", "Administrador", "Moderador".
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->string('first_name'); // Nombres
            $table->string('last_name'); //apellidos
            $table->string('email')->unique(); //email
            $table->string('phone'); //teléfono
            $table->string('country'); //país
            $table->string('city'); //ciudad
            $table->date('birthdate'); //fecha de cumpleaños

            $table->string('photo')->nullable(); // Foto de perfil

            $table->foreignId('gender_id')->constrained(); // Género
            $table->foreignId('document_type_id')->constrained(); // Tipo de documento
            $table->foreignId('user_type_id')->constrained(); // Tipo de persona
            $table->string('document_number')->unique(); // Número de documento
        
            // Estudiante
            $table->string('institution_name')->nullable();  // Nombre de la institución educativa
            $table->string('academic_program')->nullable();  // Programa académico
            $table->foreignId('modality_id'); // Modalidad

            // Campos específicos para Docentes
            $table->string('university')->nullable();

            // campos de Empresa / Institución (Trabajador/Funcionario)
            $table->string('company_name')->nullable(); // Nombre de la compañía
            $table->string('company_position')->nullable(); // Cargo en la compañía
            $table->text('company_address')->nullable(); // Dirección de la compañía

            // Emprendedor
            $table->string('entrepreneur_name')->nullable();
            $table->string('product_type')->nullable();

            // Independiente
            $table->string('occupation')->nullable();

            $table->boolean('status')->default(true); // Estado del usuario (activo/inactivo)

            // Términos y condiciones
            $table->boolean('accepted_terms')->default(false); // Aceptación de términos
            $table->boolean('is_admin')->default(false); // Estado del usuario administrador
            $table->boolean('is_invited')->default(false);  // Estado si es inditado
            $table->boolean('is_paid')->default(false); // Estado del usuario pago si/no
            $table->boolean('is_downloaded')->default(false); // Estado del usuario si ha descargado certificado
            $table->boolean('kit_confirmed')->default(false); // Estado del kit confirmado

            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes(); // Borrado suave (deleted_at)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
