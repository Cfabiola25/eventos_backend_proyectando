<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Carbon\Carbon;

class CategoryEventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoryEvents = [
            // =========================
            // CATEGORÍA 1: CONFERENCIAS (Presenciales)
            // =========================

            // Martes 21 - Mañana
            ['uuid' => Str::uuid(), 'category_id' => 1, 'event_id' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],  // Innovación Turística
            ['uuid' => Str::uuid(), 'category_id' => 1, 'event_id' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],  // Preservación Cocina
            ['uuid' => Str::uuid(), 'category_id' => 1, 'event_id' => 4, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],  // Neuro Artesanía 1
            ['uuid' => Str::uuid(), 'category_id' => 1, 'event_id' => 5, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],  // Soluciones Digitales
            ['uuid' => Str::uuid(), 'category_id' => 1, 'event_id' => 6, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],  // Marketing Turístico
            ['uuid' => Str::uuid(), 'category_id' => 1, 'event_id' => 7, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],  // WayFinding
            ['uuid' => Str::uuid(), 'category_id' => 1, 'event_id' => 8, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],  // Colección Cápsula
            ['uuid' => Str::uuid(), 'category_id' => 1, 'event_id' => 9, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],  // IA en Turismo

            // Martes 21 - Tarde
            ['uuid' => Str::uuid(), 'category_id' => 1, 'event_id' => 17, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Automatización
            ['uuid' => Str::uuid(), 'category_id' => 1, 'event_id' => 18, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Rentabilidad

            // Miércoles 22 - Mañana
            ['uuid' => Str::uuid(), 'category_id' => 1, 'event_id' => 23, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // IA Divulgación
            ['uuid' => Str::uuid(), 'category_id' => 1, 'event_id' => 24, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Entornos Mediáticos
            ['uuid' => Str::uuid(), 'category_id' => 1, 'event_id' => 25, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Modelos Turísticos
            ['uuid' => Str::uuid(), 'category_id' => 1, 'event_id' => 26, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Destino Moda
            ['uuid' => Str::uuid(), 'category_id' => 1, 'event_id' => 27, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Infografía
            ['uuid' => Str::uuid(), 'category_id' => 1, 'event_id' => 28, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Productos Exportables
            ['uuid' => Str::uuid(), 'category_id' => 1, 'event_id' => 29, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Turismo Rural
            ['uuid' => Str::uuid(), 'category_id' => 1, 'event_id' => 30, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Neuro Artesanía 2

            // Miércoles 22 - Tarde
            ['uuid' => Str::uuid(), 'category_id' => 1, 'event_id' => 37, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Estrategias Transmedia
            ['uuid' => Str::uuid(), 'category_id' => 1, 'event_id' => 38, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Financiación
            ['uuid' => Str::uuid(), 'category_id' => 1, 'event_id' => 39, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Retail Design
            ['uuid' => Str::uuid(), 'category_id' => 1, 'event_id' => 42, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Branding Experiencial

            // Jueves 23 - Mañana
            ['uuid' => Str::uuid(), 'category_id' => 1, 'event_id' => 46, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Innovación Calzado
            ['uuid' => Str::uuid(), 'category_id' => 1, 'event_id' => 47, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Retail Design
            ['uuid' => Str::uuid(), 'category_id' => 1, 'event_id' => 48, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Fintech Rural
            ['uuid' => Str::uuid(), 'category_id' => 1, 'event_id' => 49, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Brechas Digitales
            ['uuid' => Str::uuid(), 'category_id' => 1, 'event_id' => 50, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Materia Viva
            ['uuid' => Str::uuid(), 'category_id' => 1, 'event_id' => 52, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Branding Experiencial
            ['uuid' => Str::uuid(), 'category_id' => 1, 'event_id' => 53, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Proyectos Turísticos
            ['uuid' => Str::uuid(), 'category_id' => 1, 'event_id' => 54, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // E-commerce

            // Jueves 23 - Tarde
            ['uuid' => Str::uuid(), 'category_id' => 1, 'event_id' => 59, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Innovación Comunicación IA

            // =========================
            // CATEGORÍA 2: WORKSHOPS
            // =========================
            ['uuid' => Str::uuid(), 'category_id' => 2, 'event_id' => 11, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // IA Gráfica
            ['uuid' => Str::uuid(), 'category_id' => 2, 'event_id' => 12, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Fotografía Producto
            ['uuid' => Str::uuid(), 'category_id' => 2, 'event_id' => 13, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Fase 1 Prototipado
            ['uuid' => Str::uuid(), 'category_id' => 2, 'event_id' => 14, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Mentalidad Innovadora
            ['uuid' => Str::uuid(), 'category_id' => 2, 'event_id' => 15, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Narrativas Región
            ['uuid' => Str::uuid(), 'category_id' => 2, 'event_id' => 16, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Capacidades Innovación

            ['uuid' => Str::uuid(), 'category_id' => 2, 'event_id' => 32, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Diseñador Invitado
            ['uuid' => Str::uuid(), 'category_id' => 2, 'event_id' => 33, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Experiencias Turísticas
            ['uuid' => Str::uuid(), 'category_id' => 2, 'event_id' => 34, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Herramientas Tecnológicas
            ['uuid' => Str::uuid(), 'category_id' => 2, 'event_id' => 35, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Componentes Financieros
            ['uuid' => Str::uuid(), 'category_id' => 2, 'event_id' => 36, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Fase 2 Prototipado

            ['uuid' => Str::uuid(), 'category_id' => 2, 'event_id' => 55, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Tecnologías Financieras
            ['uuid' => Str::uuid(), 'category_id' => 2, 'event_id' => 56, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Fase 3 Prototipado
            ['uuid' => Str::uuid(), 'category_id' => 2, 'event_id' => 57, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Simuladores Aduaneros
            ['uuid' => Str::uuid(), 'category_id' => 2, 'event_id' => 58, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Proyectos Rentables

            // =========================
            // CATEGORÍA 3: PANELES
            // =========================
            ['uuid' => Str::uuid(), 'category_id' => 3, 'event_id' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],  // Panel Inaugural
            ['uuid' => Str::uuid(), 'category_id' => 3, 'event_id' => 7, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],  // Panel Dinámicas Mundiales
            ['uuid' => Str::uuid(), 'category_id' => 3, 'event_id' => 31, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Panel Modelos Globales
            ['uuid' => Str::uuid(), 'category_id' => 3, 'event_id' => 51, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Panel Impacto Tecnología

            // =========================
            // CATEGORÍA 4: MESAS REDONDAS
            // =========================
            ['uuid' => Str::uuid(), 'category_id' => 4, 'event_id' => 44, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Mesa Alcaldes

            // =========================
            // CATEGORÍA 5: EVENTOS VIRTUALES
            // =========================
            ['uuid' => Str::uuid(), 'category_id' => 5, 'event_id' => 19, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Logística Eventos
            ['uuid' => Str::uuid(), 'category_id' => 5, 'event_id' => 20, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Estrategias Comerciales
            ['uuid' => Str::uuid(), 'category_id' => 5, 'event_id' => 40, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Inversión Extranjera
            ['uuid' => Str::uuid(), 'category_id' => 5, 'event_id' => 41, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Competitividad
            ['uuid' => Str::uuid(), 'category_id' => 5, 'event_id' => 43, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Asociatividad
            ['uuid' => Str::uuid(), 'category_id' => 5, 'event_id' => 60, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Comercio Electrónico
            ['uuid' => Str::uuid(), 'category_id' => 5, 'event_id' => 61, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Sostenibilidad

            // =========================
            // CATEGORÍA 6: EVENTOS CULTURALES
            // =========================
            ['uuid' => Str::uuid(), 'category_id' => 6, 'event_id' => 21, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // FESCtival Cine (Ma)
            ['uuid' => Str::uuid(), 'category_id' => 6, 'event_id' => 22, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Gala Inaugural
            ['uuid' => Str::uuid(), 'category_id' => 6, 'event_id' => 45, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // FESCtival Cine (Mi)
            ['uuid' => Str::uuid(), 'category_id' => 6, 'event_id' => 62, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // FESCtival Cine (Ju)
            ['uuid' => Str::uuid(), 'category_id' => 6, 'event_id' => 64, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Desfile Modas
            ['uuid' => Str::uuid(), 'category_id' => 6, 'event_id' => 66, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Feria Cultural

            // =========================
            // CATEGORÍA 7: EVENTOS DE NETWORKING
            // =========================
            ['uuid' => Str::uuid(), 'category_id' => 7, 'event_id' => 63, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // City Tour
            ['uuid' => Str::uuid(), 'category_id' => 7, 'event_id' => 65, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Rueda Negocios
        ];
        foreach ($categoryEvents as $categoryEvent) {
            DB::table('category_event')->insert($categoryEvent);
        }

        $this->command->info('Relaciones Categoría-Evento creadas exitosamente!');
    }
}
