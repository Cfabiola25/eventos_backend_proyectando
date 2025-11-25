<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Carbon\Carbon;

class EventTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $eventTags = [
           // ==================== TURISMO (Tag 1) ====================
            ['uuid' => Str::uuid(), 'tag_id' => 1, 'event_id' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],   // IA Transformando Turismo
            ['uuid' => Str::uuid(), 'tag_id' => 1, 'event_id' => 5, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],   // Preservación Cocina Tradicional
            ['uuid' => Str::uuid(), 'tag_id' => 1, 'event_id' => 6, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],   // Innovación Turística Sostenible
            ['uuid' => Str::uuid(), 'tag_id' => 1, 'event_id' => 8, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],   // Marketing Promocional Destinos
            ['uuid' => Str::uuid(), 'tag_id' => 1, 'event_id' => 9, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],   // WayFinding Ciudades Legibles
            ['uuid' => Str::uuid(), 'tag_id' => 1, 'event_id' => 15, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],  // Narrativas de Región
            ['uuid' => Str::uuid(), 'tag_id' => 1, 'event_id' => 16, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],  // Desarrollo Capacidades Innovación
            ['uuid' => Str::uuid(), 'tag_id' => 1, 'event_id' => 17, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],  // Automatización Talento Humano
            ['uuid' => Str::uuid(), 'tag_id' => 1, 'event_id' => 18, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],  // Rentabilidad Empresas Turísticas
            ['uuid' => Str::uuid(), 'tag_id' => 1, 'event_id' => 20, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],  // Estrategias Comerciales
            ['uuid' => Str::uuid(), 'tag_id' => 1, 'event_id' => 25, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],  // Modelos Desarrollo Turístico
            ['uuid' => Str::uuid(), 'tag_id' => 1, 'event_id' => 29, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],  // Turismo Rural Sostenible
            ['uuid' => Str::uuid(), 'tag_id' => 1, 'event_id' => 33, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],  // Diseño Experiencias Turísticas
            ['uuid' => Str::uuid(), 'tag_id' => 1, 'event_id' => 37, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],  // Estrategias Trasmedia
            ['uuid' => Str::uuid(), 'tag_id' => 1, 'event_id' => 43, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],  // Conecta para Crecer
            ['uuid' => Str::uuid(), 'tag_id' => 1, 'event_id' => 53, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],  // Estrategias Proyectos Turísticos
            ['uuid' => Str::uuid(), 'tag_id' => 1, 'event_id' => 63, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],  // City Tour
            ['uuid' => Str::uuid(), 'tag_id' => 1, 'event_id' => 66, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],  // Feria Cultural

            // ==================== INNOVACIÓN (Tag 2) ====================
            ['uuid' => Str::uuid(), 'tag_id' => 2, 'event_id' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],   // IA Transformando Turismo
            ['uuid' => Str::uuid(), 'tag_id' => 2, 'event_id' => 4, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],   // Soluciones Digitales
            ['uuid' => Str::uuid(), 'tag_id' => 2, 'event_id' => 6, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],   // Innovación Turística Sostenible
            ['uuid' => Str::uuid(), 'tag_id' => 2, 'event_id' => 11, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],  // IA Generación Gráfica
            ['uuid' => Str::uuid(), 'tag_id' => 2, 'event_id' => 14, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],  // Mentalidad Innovadora
            ['uuid' => Str::uuid(), 'tag_id' => 2, 'event_id' => 16, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],  // Desarrollo Capacidades Innovación
            ['uuid' => Str::uuid(), 'tag_id' => 2, 'event_id' => 23, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],  // Generación Gráfica IA
            ['uuid' => Str::uuid(), 'tag_id' => 2, 'event_id' => 24, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],  // Entornos Mediáticos Expandidos
            ['uuid' => Str::uuid(), 'tag_id' => 2, 'event_id' => 37, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],  // Estrategias Trasmedia
            ['uuid' => Str::uuid(), 'tag_id' => 2, 'event_id' => 46, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],  // Innovación Calzado
            ['uuid' => Str::uuid(), 'tag_id' => 2, 'event_id' => 48, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],  // Soluciones Fintech
            ['uuid' => Str::uuid(), 'tag_id' => 2, 'event_id' => 49, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],  // Cerrando Brechas Digitales
            ['uuid' => Str::uuid(), 'tag_id' => 2, 'event_id' => 59, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],  // Innovación Comunicación IA

            // ==================== INTELIGENCIA ARTIFICIAL (Tag 4) ====================
            ['uuid' => Str::uuid(), 'tag_id' => 4, 'event_id' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],   // IA Transformando Turismo
            ['uuid' => Str::uuid(), 'tag_id' => 4, 'event_id' => 11, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],  // IA Generación Gráfica
            ['uuid' => Str::uuid(), 'tag_id' => 4, 'event_id' => 23, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],  // Generación Gráfica IA
            ['uuid' => Str::uuid(), 'tag_id' => 4, 'event_id' => 59, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],  // Innovación Comunicación IA

            // ==================== DISEÑO (Tag 20) ====================
            ['uuid' => Str::uuid(), 'tag_id' => 20, 'event_id' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],  // Colección Cápsula Efectiva
            ['uuid' => Str::uuid(), 'tag_id' => 20, 'event_id' => 9, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],  // WayFinding Ciudades Legibles
            ['uuid' => Str::uuid(), 'tag_id' => 20, 'event_id' => 11, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // IA Generación Gráfica
            ['uuid' => Str::uuid(), 'tag_id' => 20, 'event_id' => 23, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Generación Gráfica IA
            ['uuid' => Str::uuid(), 'tag_id' => 20, 'event_id' => 26, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Destino Moda
            ['uuid' => Str::uuid(), 'tag_id' => 20, 'event_id' => 27, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Infografía Souvenirs
            ['uuid' => Str::uuid(), 'tag_id' => 20, 'event_id' => 32, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Taller Diseñador Invitado
            ['uuid' => Str::uuid(), 'tag_id' => 20, 'event_id' => 34, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Herramientas Tecnológicas Diseño
            ['uuid' => Str::uuid(), 'tag_id' => 20, 'event_id' => 39, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Retail Design UX
            ['uuid' => Str::uuid(), 'tag_id' => 20, 'event_id' => 47, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Retail Design UX (Jueves)
            ['uuid' => Str::uuid(), 'tag_id' => 20, 'event_id' => 50, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Materia Viva
            ['uuid' => Str::uuid(), 'tag_id' => 20, 'event_id' => 59, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Innovación Comunicación IA
            ['uuid' => Str::uuid(), 'tag_id' => 20, 'event_id' => 64, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Desfile Modas

            // ==================== MODA (Tag 11) ====================
            ['uuid' => Str::uuid(), 'tag_id' => 11, 'event_id' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],  // Colección Cápsula Efectiva
            ['uuid' => Str::uuid(), 'tag_id' => 11, 'event_id' => 10, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Neuro Artesanía 1
            ['uuid' => Str::uuid(), 'tag_id' => 11, 'event_id' => 26, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Destino Moda
            ['uuid' => Str::uuid(), 'tag_id' => 11, 'event_id' => 30, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Neuro Artesanía 2
            ['uuid' => Str::uuid(), 'tag_id' => 11, 'event_id' => 32, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Taller Diseñador Invitado
            ['uuid' => Str::uuid(), 'tag_id' => 11, 'event_id' => 46, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Innovación Calzado
            ['uuid' => Str::uuid(), 'tag_id' => 11, 'event_id' => 50, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Materia Viva
            ['uuid' => Str::uuid(), 'tag_id' => 11, 'event_id' => 64, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Desfile Modas

            // ==================== SOSTENIBILIDAD (Tag 12) ====================
            ['uuid' => Str::uuid(), 'tag_id' => 12, 'event_id' => 6, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],  // Innovación Turística Sostenible
            ['uuid' => Str::uuid(), 'tag_id' => 12, 'event_id' => 25, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Modelos Desarrollo Turístico
            ['uuid' => Str::uuid(), 'tag_id' => 12, 'event_id' => 29, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Turismo Rural Sostenible
            ['uuid' => Str::uuid(), 'tag_id' => 12, 'event_id' => 38, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Financiación Agrosostenible
            ['uuid' => Str::uuid(), 'tag_id' => 12, 'event_id' => 50, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Materia Viva
            ['uuid' => Str::uuid(), 'tag_id' => 12, 'event_id' => 54, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // E-commerce Sostenibilidad
            ['uuid' => Str::uuid(), 'tag_id' => 12, 'event_id' => 58, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Proyectos Rentables Sostenibles
            ['uuid' => Str::uuid(), 'tag_id' => 12, 'event_id' => 61, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Sostenibilidad Impactos

            // ==================== ECONOMÍA CIRCULAR (Tag 13) ====================
            ['uuid' => Str::uuid(), 'tag_id' => 13, 'event_id' => 10, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Neuro Artesanía 1
            ['uuid' => Str::uuid(), 'tag_id' => 13, 'event_id' => 30, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Neuro Artesanía 2
            ['uuid' => Str::uuid(), 'tag_id' => 13, 'event_id' => 50, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Materia Viva

            // ==================== CULTURA (Tag 8) ====================
            ['uuid' => Str::uuid(), 'tag_id' => 8, 'event_id' => 5, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],   // Preservación Cocina Tradicional
            ['uuid' => Str::uuid(), 'tag_id' => 8, 'event_id' => 15, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],  // Narrativas de Región
            ['uuid' => Str::uuid(), 'tag_id' => 8, 'event_id' => 21, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],  // FESCtival Cine (Martes)
            ['uuid' => Str::uuid(), 'tag_id' => 8, 'event_id' => 22, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],  // Gala Inaugural
            ['uuid' => Str::uuid(), 'tag_id' => 8, 'event_id' => 45, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],  // FESCtival Cine (Miércoles)
            ['uuid' => Str::uuid(), 'tag_id' => 8, 'event_id' => 62, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],  // FESCtival Cine (Jueves)
            ['uuid' => Str::uuid(), 'tag_id' => 8, 'event_id' => 63, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],  // City Tour
            ['uuid' => Str::uuid(), 'tag_id' => 8, 'event_id' => 64, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],  // Desfile Modas
            ['uuid' => Str::uuid(), 'tag_id' => 8, 'event_id' => 66, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],  // Feria Cultural

            // ==================== NEGOCIOS (Tag 9) ====================
            ['uuid' => Str::uuid(), 'tag_id' => 9, 'event_id' => 8, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],   // Marketing Promocional
            ['uuid' => Str::uuid(), 'tag_id' => 9, 'event_id' => 20, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],  // Estrategias Comerciales
            ['uuid' => Str::uuid(), 'tag_id' => 9, 'event_id' => 28, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],  // Productos Exportables
            ['uuid' => Str::uuid(), 'tag_id' => 9, 'event_id' => 35, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],  // Componentes Financieros
            ['uuid' => Str::uuid(), 'tag_id' => 9, 'event_id' => 38, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],  // Financiación Agrosostenible
            ['uuid' => Str::uuid(), 'tag_id' => 9, 'event_id' => 40, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],  // Inversión Extranjera
            ['uuid' => Str::uuid(), 'tag_id' => 9, 'event_id' => 41, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],  // Competitividad Regional
            ['uuid' => Str::uuid(), 'tag_id' => 9, 'event_id' => 43, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],  // Conecta para Crecer
            ['uuid' => Str::uuid(), 'tag_id' => 9, 'event_id' => 48, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],  // Soluciones Fintech
            ['uuid' => Str::uuid(), 'tag_id' => 9, 'event_id' => 54, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],  // E-commerce
            ['uuid' => Str::uuid(), 'tag_id' => 9, 'event_id' => 55, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],  // Tecnologías Financieras
            ['uuid' => Str::uuid(), 'tag_id' => 9, 'event_id' => 60, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],  // Comercio Electrónico
            ['uuid' => Str::uuid(), 'tag_id' => 9, 'event_id' => 65, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],  // Rueda Negocios

            // ==================== INVESTIGACIÓN (Tag 25) ====================
            ['uuid' => Str::uuid(), 'tag_id' => 25, 'event_id' => 51, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Panel Investigación Tecnología
        ];

        foreach ($eventTags as $eventTag) {
            DB::table('event_tag')->insert($eventTag);
        }

        $this->command->info('Relaciones Evento-Tag creadas exitosamente!');
    }
}
