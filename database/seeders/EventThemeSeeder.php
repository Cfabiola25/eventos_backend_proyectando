<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Carbon\Carbon;

class EventThemeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $eventThemes = [
            // ======================================================
            // LUNES 20 DE OCTUBRE - TEMA 1: INAUGURACIÓN
            // ======================================================
            ['uuid' => Str::uuid(), 'theme_id' => 1, 'event_id' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Panel Inaugural

            // ======================================================
            // MARTES 21 DE OCTUBRE - TEMA 2: DINÁMICAS MUNDIALES TURÍSTICAS
            // ======================================================
            ['uuid' => Str::uuid(), 'theme_id' => 2, 'event_id' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],  // IA Transformando Turismo
            ['uuid' => Str::uuid(), 'theme_id' => 2, 'event_id' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],  // Colección Cápsula Efectiva
            ['uuid' => Str::uuid(), 'theme_id' => 2, 'event_id' => 4, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],  // Soluciones Digitales
            ['uuid' => Str::uuid(), 'theme_id' => 2, 'event_id' => 5, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],  // Preservación Cocina Tradicional
            ['uuid' => Str::uuid(), 'theme_id' => 2, 'event_id' => 6, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],  // Innovación Turística Sostenible
            ['uuid' => Str::uuid(), 'theme_id' => 2, 'event_id' => 7, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],  // Panel Dinámicas Mundiales
            ['uuid' => Str::uuid(), 'theme_id' => 2, 'event_id' => 8, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],  // Marketing Promocional
            ['uuid' => Str::uuid(), 'theme_id' => 2, 'event_id' => 9, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],  // WayFinding Ciudades Legibles
            ['uuid' => Str::uuid(), 'theme_id' => 2, 'event_id' => 10, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Neuro Artesanía 1
            ['uuid' => Str::uuid(), 'theme_id' => 2, 'event_id' => 11, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // IA Generación Gráfica
            ['uuid' => Str::uuid(), 'theme_id' => 2, 'event_id' => 12, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Fotografía de Producto
            ['uuid' => Str::uuid(), 'theme_id' => 2, 'event_id' => 13, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Fase 1 Prototipado
            ['uuid' => Str::uuid(), 'theme_id' => 2, 'event_id' => 14, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Mentalidad Innovadora
            ['uuid' => Str::uuid(), 'theme_id' => 2, 'event_id' => 15, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Narrativas de Región
            ['uuid' => Str::uuid(), 'theme_id' => 2, 'event_id' => 16, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Desarrollo Capacidades Innovación
            ['uuid' => Str::uuid(), 'theme_id' => 2, 'event_id' => 17, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Automatización Talento Humano
            ['uuid' => Str::uuid(), 'theme_id' => 2, 'event_id' => 18, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Rentabilidad Empresas Turísticas
            ['uuid' => Str::uuid(), 'theme_id' => 2, 'event_id' => 19, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Logística de Eventos (Virtual)
            ['uuid' => Str::uuid(), 'theme_id' => 2, 'event_id' => 20, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Estrategias Comerciales (Virtual)
            ['uuid' => Str::uuid(), 'theme_id' => 2, 'event_id' => 21, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // FESCtival Cine (Martes)
            ['uuid' => Str::uuid(), 'theme_id' => 2, 'event_id' => 22, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Gala Inaugural Cine

            // ======================================================
            // MIÉRCOLES 22 DE OCTUBRE - TEMA 3: MODELOS GLOBALES DESARROLLO ECONÓMICO
            // ======================================================
            ['uuid' => Str::uuid(), 'theme_id' => 3, 'event_id' => 23, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Generación Gráfica IA
            ['uuid' => Str::uuid(), 'theme_id' => 3, 'event_id' => 24, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Entornos Mediáticos Expandidos
            ['uuid' => Str::uuid(), 'theme_id' => 3, 'event_id' => 25, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Modelos Desarrollo Turístico
            ['uuid' => Str::uuid(), 'theme_id' => 3, 'event_id' => 26, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Destino Moda
            ['uuid' => Str::uuid(), 'theme_id' => 3, 'event_id' => 27, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Infografía Souvenirs
            ['uuid' => Str::uuid(), 'theme_id' => 3, 'event_id' => 28, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Identificación Productos Exportables
            ['uuid' => Str::uuid(), 'theme_id' => 3, 'event_id' => 29, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Turismo Rural Sostenible
            ['uuid' => Str::uuid(), 'theme_id' => 3, 'event_id' => 30, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Neuro Artesanía 2
            ['uuid' => Str::uuid(), 'theme_id' => 3, 'event_id' => 31, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Panel Modelos Globales
            ['uuid' => Str::uuid(), 'theme_id' => 3, 'event_id' => 32, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Taller Diseñador Invitado
            ['uuid' => Str::uuid(), 'theme_id' => 3, 'event_id' => 33, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Diseño Experiencias Turísticas
            ['uuid' => Str::uuid(), 'theme_id' => 3, 'event_id' => 34, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Herramientas Tecnológicas Diseño
            ['uuid' => Str::uuid(), 'theme_id' => 3, 'event_id' => 35, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Componentes Financieros
            ['uuid' => Str::uuid(), 'theme_id' => 3, 'event_id' => 36, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Fase 2 Prototipado
            ['uuid' => Str::uuid(), 'theme_id' => 3, 'event_id' => 37, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Estrategias Trasmedia
            ['uuid' => Str::uuid(), 'theme_id' => 3, 'event_id' => 38, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Financiación Agrosostenible
            ['uuid' => Str::uuid(), 'theme_id' => 3, 'event_id' => 39, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Retail Design UX
            ['uuid' => Str::uuid(), 'theme_id' => 3, 'event_id' => 40, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Branding Experiencial
            ['uuid' => Str::uuid(), 'theme_id' => 3, 'event_id' => 41, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Inversión Extranjera (Virtual)
            ['uuid' => Str::uuid(), 'theme_id' => 3, 'event_id' => 42, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Competitividad Regional (Virtual)
            ['uuid' => Str::uuid(), 'theme_id' => 3, 'event_id' => 43, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Conecta para Crecer (Virtual)
            ['uuid' => Str::uuid(), 'theme_id' => 3, 'event_id' => 44, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Mesa Redonda Alcaldes
            ['uuid' => Str::uuid(), 'theme_id' => 3, 'event_id' => 45, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // FESCtival Cine (Miércoles)

            // ======================================================
            // JUEVES 23 DE OCTUBRE - TEMA 4: IMPACTO INVESTIGACIÓN Y TECNOLOGÍA
            // ======================================================
            ['uuid' => Str::uuid(), 'theme_id' => 4, 'event_id' => 46, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Innovación Calzado
            ['uuid' => Str::uuid(), 'theme_id' => 4, 'event_id' => 47, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Retail Design UX (Jueves)
            ['uuid' => Str::uuid(), 'theme_id' => 4, 'event_id' => 48, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Soluciones Fintech
            ['uuid' => Str::uuid(), 'theme_id' => 4, 'event_id' => 49, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Cerrando Brechas Digitales
            ['uuid' => Str::uuid(), 'theme_id' => 4, 'event_id' => 50, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Materia Viva
            ['uuid' => Str::uuid(), 'theme_id' => 4, 'event_id' => 51, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Panel Investigación Tecnología
            ['uuid' => Str::uuid(), 'theme_id' => 4, 'event_id' => 52, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Estrategias Proyectos Turísticos
            ['uuid' => Str::uuid(), 'theme_id' => 4, 'event_id' => 53, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // E-commerce Sostenibilidad
            ['uuid' => Str::uuid(), 'theme_id' => 4, 'event_id' => 54, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Tecnologías Financieras
            ['uuid' => Str::uuid(), 'theme_id' => 4, 'event_id' => 55, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Fase 3 Prototipado
            ['uuid' => Str::uuid(), 'theme_id' => 4, 'event_id' => 56, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Simuladores Gestión Aduanera
            ['uuid' => Str::uuid(), 'theme_id' => 4, 'event_id' => 57, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Proyectos Rentables Sostenibles
            ['uuid' => Str::uuid(), 'theme_id' => 4, 'event_id' => 58, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Innovación Comunicación IA
            ['uuid' => Str::uuid(), 'theme_id' => 4, 'event_id' => 59, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Comercio Electrónico (Virtual)
            ['uuid' => Str::uuid(), 'theme_id' => 4, 'event_id' => 60, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Sostenibilidad Impactos (Virtual)
            ['uuid' => Str::uuid(), 'theme_id' => 4, 'event_id' => 61, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // City Tour
            ['uuid' => Str::uuid(), 'theme_id' => 4, 'event_id' => 62, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Desfile Modas
            ['uuid' => Str::uuid(), 'theme_id' => 4, 'event_id' => 63, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // FESCtival Cine (Jueves)

            // VIERNES 24 DE OCTUBRE - TEMA 5: CIERRE NETWORKING, NEGOCIOS Y CULTURA
            ['uuid' => Str::uuid(), 'theme_id' => 5, 'event_id' => 64, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Rueda de Negocios
            ['uuid' => Str::uuid(), 'theme_id' => 5, 'event_id' => 65, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Feria Cultural
            ['uuid' => Str::uuid(), 'theme_id' => 5, 'event_id' => 66, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Fiesta de Cierre
        ];

        foreach ($eventThemes as $eventTheme) {
            DB::table('event_theme')->insert($eventTheme);
        }

        $this->command->info('eventos y temas creados exitosamente!');
    }
}
