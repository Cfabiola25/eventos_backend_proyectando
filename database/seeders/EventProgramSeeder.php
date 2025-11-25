<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class EventProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $eventPrograms = [
            // ======================================================
            // LUNES 20 - PANEL INAUGURAL
            // ======================================================
            [
                'uuid' => Str::uuid(),
                'event_id'   => 1, // Panel Inaugural
                'program_id' => 1, // Software
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'uuid' => Str::uuid(),
                'event_id'   => 1,
                'program_id' => 2, // Turismo
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            // ======================================================
            // MARTES 21 DE OCTUBRE
            // ======================================================

            // MAÑANA - CONFERENCIAS
            [
                'uuid' => Str::uuid(),
                'event_id'   => 2, // Datos, Experiencias y Decisiones: Cómo la IA está Transformando el Turismo
                'program_id' => 1, // Software
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'uuid' => Str::uuid(),
                'event_id'   => 2,
                'program_id' => 2, // Turismo
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'uuid' => Str::uuid(),
                'event_id'   => 3, // Sesión 1. Colección Cápsula Efectiva
                'program_id' => 4, // Moda
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'uuid' => Str::uuid(),
                'event_id'   => 4, // Soluciones Digitales para la Gestión Productiva
                'program_id' => 1, // Software
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'uuid' => Str::uuid(),
                'event_id'   => 5, // Preservación de la Cocina Tradicional
                'program_id' => 2, // Turismo
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'uuid' => Str::uuid(),
                'event_id'   => 6, // Innovación Turística y Sostenible
                'program_id' => 2, // Turismo
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'uuid' => Str::uuid(),
                'event_id'   => 8, // Marketing Promocional de Destinos Turísticos
                'program_id' => 2, // Turismo
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'uuid' => Str::uuid(),
                'event_id'   => 9, // El Poder de WayFinding
                'program_id' => 3, // Gráfico
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'uuid' => Str::uuid(),
                'event_id'   => 10, // Sesión 1. La Neuro Artesanía
                'program_id' => 4, // Moda
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            // TARDE - WORKSHOPS
            [
                'uuid' => Str::uuid(),
                'event_id'   => 11, // IA para la Generación Gráfica
                'program_id' => 1, // Software
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'uuid' => Str::uuid(),
                'event_id'   => 11,
                'program_id' => 3, // Gráfico
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // Evento 12 - Fotografía de Producto (Por definir) - Sin programa asignado
            [
                'uuid' => Str::uuid(),
                'event_id'   => 13, // Fase 1. Prototipado y Validación
                'program_id' => 1, // Software
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'uuid' => Str::uuid(),
                'event_id'   => 14, // Despertando la Mentalidad Innovadora
                'program_id' => 1, // Software (innovación)
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'uuid' => Str::uuid(),
                'event_id'   => 15, // Narrativas de Región
                'program_id' => 2, // Turismo
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'uuid' => Str::uuid(),
                'event_id'   => 16, // Desarrollo de Capacidades de Innovación
                'program_id' => 2, // Turismo
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            // TARDE - CONFERENCIAS
            [
                'uuid' => Str::uuid(),
                'event_id'   => 17, // Automatización y Talento Humano
                'program_id' => 2, // Turismo
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'uuid' => Str::uuid(),
                'event_id'   => 18, // Rentabilidad de las Empresas Turísticas
                'program_id' => 2, // Turismo
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            // VIRTUALES
            [
                'uuid' => Str::uuid(),
                'event_id'   => 19, // Logística de Eventos
                'program_id' => 5, // Logística
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'uuid' => Str::uuid(),
                'event_id'   => 20, // Estrategias Comerciales
                'program_id' => 2, // Turismo
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            // CULTURALES
            [
                'uuid' => Str::uuid(),
                'event_id'   => 7, // Panel: Dinámicas Mundiales
                'program_id' => 2, // Turismo
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'uuid' => Str::uuid(),
                'event_id'   => 21, // FESCtival de Cine - Proyección
                'program_id' => 3, // Gráfico
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'uuid' => Str::uuid(),
                'event_id'   => 22, // Gala Inaugural FESCtival
                'program_id' => 3, // Gráfico
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            // ======================================================
            // MIÉRCOLES 22 DE OCTUBRE
            // ======================================================

            // MAÑANA - CONFERENCIAS
            [
                'uuid' => Str::uuid(),
                'event_id'   => 23, // Generación Gráfica con IA
                'program_id' => 1, // Software
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'uuid' => Str::uuid(),
                'event_id'   => 23,
                'program_id' => 3, // Gráfico
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'uuid' => Str::uuid(),
                'event_id'   => 24, // Entornos Mediáticos Expandidos
                'program_id' => 3, // Gráfico
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'uuid' => Str::uuid(),
                'event_id'   => 25, // Modelos de Desarrollo Turístico
                'program_id' => 2, // Turismo
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'uuid' => Str::uuid(),
                'event_id'   => 26, // Sesión 2. Destino Moda
                'program_id' => 4, // Moda
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'uuid' => Str::uuid(),
                'event_id'   => 27, // La Infografía como Herramienta
                'program_id' => 3, // Gráfico
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'uuid' => Str::uuid(),
                'event_id'   => 28, // Identificación de Productos Exportables
                'program_id' => 5, // Logística
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'uuid' => Str::uuid(),
                'event_id'   => 29, // Turismo Rural Sostenible
                'program_id' => 2, // Turismo
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'uuid' => Str::uuid(),
                'event_id'   => 30, // Sesión 2. La Neuro Artesanía
                'program_id' => 4, // Moda
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            // TARDE - WORKSHOPS
            [
                'uuid' => Str::uuid(),
                'event_id'   => 32, // Taller con Diseñador Invitado
                'program_id' => 4, // Moda
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'uuid' => Str::uuid(),
                'event_id'   => 33, // Taller de Diseño de Experiencias Turísticas
                'program_id' => 2, // Turismo
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'uuid' => Str::uuid(),
                'event_id'   => 34, // Herramientas Tecnológicas
                'program_id' => 3, // Gráfico
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'uuid' => Str::uuid(),
                'event_id'   => 35, // Componentes Financieros
                'program_id' => 1, // Software (gestión financiera)
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'uuid' => Str::uuid(),
                'event_id'   => 36, // Fase 2. Prototipado y Validación
                'program_id' => 1, // Software
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            // TARDE - CONFERENCIAS
            [
                'uuid' => Str::uuid(),
                'event_id'   => 37, // Estrategias Trasmedia
                'program_id' => 2, // Turismo
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'uuid' => Str::uuid(),
                'event_id'   => 38, // Oportunidades de Financiación
                'program_id' => 1, // Software (financiamiento proyectos)
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'uuid' => Str::uuid(),
                'event_id'   => 39, // Retail Design para UX
                'program_id' => 3, // Gráfico
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'uuid' => Str::uuid(),
                'event_id'   => 42, // Branding Experiencial
                'program_id' => 3, // Gráfico
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            // VIRTUALES
            [
                'uuid' => Str::uuid(),
                'event_id'   => 40, // Atracción de Inversión Extranjera
                'program_id' => 1, // Software (inversiones)
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'uuid' => Str::uuid(),
                'event_id'   => 41, // Impulso a la Competitividad Regional
                'program_id' => 1, // Software
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'uuid' => Str::uuid(),
                'event_id'   => 43, // Conecta para Crecer
                'program_id' => 2, // Turismo
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            // ESPECIALES
            [
                'uuid' => Str::uuid(),
                'event_id'   => 31, // Panel: Modelos Globales
                'program_id' => 1, // Software
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'uuid' => Str::uuid(),
                'event_id'   => 44, // Mesa Redonda "Hablando con los Alcaldes"
                'program_id' => 2, // Turismo
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'uuid' => Str::uuid(),
                'event_id'   => 45, // FESCtival de Cine - Proyección
                'program_id' => 3, // Gráfico
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            // ======================================================
            // JUEVES 23 DE OCTUBRE
            // ======================================================

            // MAÑANA - CONFERENCIAS
            [
                'uuid' => Str::uuid(),
                'event_id'   => 46, // Innovación en la Industria Calzado
                'program_id' => 4, // Moda
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'uuid' => Str::uuid(),
                'event_id'   => 47, // Retail Design para UX
                'program_id' => 3, // Gráfico
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'uuid' => Str::uuid(),
                'event_id'   => 48, // Soluciones Fintech
                'program_id' => 1, // Software
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'uuid' => Str::uuid(),
                'event_id'   => 49, // Cerrando Brechas Digitales
                'program_id' => 1, // Software
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'uuid' => Str::uuid(),
                'event_id'   => 50, // Materia Viva
                'program_id' => 4, // Moda
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'uuid' => Str::uuid(),
                'event_id'   => 52, // Branding Experiencial
                'program_id' => 3, // Gráfico
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'uuid' => Str::uuid(),
                'event_id'   => 53, // Estrategias para la Presentación de Proyectos
                'program_id' => 2, // Turismo
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'uuid' => Str::uuid(),
                'event_id'   => 54, // E-commerce de Productos y Servicios
                'program_id' => 1, // Software
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            // TARDE - WORKSHOPS
            [
                'uuid' => Str::uuid(),
                'event_id'   => 55, // Uso de Tecnologías Financieras
                'program_id' => 1, // Software
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'uuid' => Str::uuid(),
                'event_id'   => 56, // Fase 3 Final: Prototipado y Validación
                'program_id' => 1, // Software
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'uuid' => Str::uuid(),
                'event_id'   => 57, // Simuladores para la Gestión Aduanera
                'program_id' => 5, // Logística
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'uuid' => Str::uuid(),
                'event_id'   => 58, // De la Idea al Impacto
                'program_id' => 1, // Software
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            // TARDE - CONFERENCIAS
            [
                'uuid' => Str::uuid(),
                'event_id'   => 59, // Proyectos de Innovación en Comunicación
                'program_id' => 3, // Gráfico
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            // VIRTUALES
            [
                'uuid' => Str::uuid(),
                'event_id'   => 60, // Comercio Electrónico
                'program_id' => 1, // Software
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'uuid' => Str::uuid(),
                'event_id'   => 61, // Sostenibilidad y Reducción de Impactos
                'program_id' => 1, // Software (sostenibilidad)
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            // CULTURALES
            [
                'uuid' => Str::uuid(),
                'event_id'   => 51, // Panel: Impacto de la Investigación
                'program_id' => 1, // Software
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'uuid' => Str::uuid(),
                'event_id'   => 62, // FESCtival de Cine - Proyección
                'program_id' => 3, // Gráfico
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'uuid' => Str::uuid(),
                'event_id'   => 63, // City Tour
                'program_id' => 2, // Turismo
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'uuid' => Str::uuid(),
                'event_id'   => 64, // Desfile de Modas
                'program_id' => 4, // Moda
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            // ======================================================
            // VIERNES 24 DE OCTUBRE
            // ======================================================
            [
                'uuid' => Str::uuid(),
                'event_id'   => 65, // Rueda de Negocios
                'program_id' => 1, // Software
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'uuid' => Str::uuid(),
                'event_id'   => 66, // Feria Cultural
                'program_id' => 2, // Turismo
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
           /*  [
                'uuid' => Str::uuid(),
                'event_id'   => 67, // Fiesta de Cierre
                'program_id' => 2, // Turismo
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], */
        ];

        foreach ($eventPrograms as $eventProgram) {
            DB::table('event_program')->insert($eventProgram);
        }

        $this->command->info('Relaciones entre eventos y programas creadas exitosamente!');
    }
}
