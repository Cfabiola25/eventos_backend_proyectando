<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EventScheduleLocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $eventScheduleLocations = [
            // ======================================================
            // LUNES 20 DE OCTUBRE - PANEL INAUGURAL
            // ======================================================
            [
                'uuid' => Str::uuid(),
                'event_id' => 1, // Panel Inaugural
                'schedule_id' => 1, // 18:00 horas (Lunes)
                'location_id' => 1, // Teatro Zulima
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            // ======================================================
            // MARTES 21 DE OCTUBRE - MAÑANA
            // ======================================================

            // 08:00 - 09:00 horas
            [
                'uuid' => Str::uuid(),
                'event_id' => 2, // Datos, Experiencias y Decisiones: Cómo la IA está Transformando el Turismo
                'schedule_id' => 2, // 08:00-09:00 (Martes)
                'location_id' => 4, // Salón Terracota
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid' => Str::uuid(),
                'event_id' => 3, // Sesión 1. Colección Cápsula Efectiva
                'schedule_id' => 2, // 08:00-09:00 (Martes)
                'location_id' => 3, // Salón Rubí
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            // 09:00 - 09:30 horas (BREAK) - ID 3

            // 09:30 - 10:30 horas
            [
                'uuid' => Str::uuid(),
                'event_id' => 4, // Soluciones Digitales para la Gestión Productiva del Departamento
                'schedule_id' => 4, // 09:30-10:30 (Martes) - CORREGIDO: era 3
                'location_id' => 6, // Auditorio 5ta Avenida
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid' => Str::uuid(),
                'event_id' => 5, // Preservación de la Cocina Tradicional: Fotografía de Producto Gastronómico
                'schedule_id' => 4, // 09:30-10:30 (Martes) - CORREGIDO: era 3
                'location_id' => 4, // Salón Terracota
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid' => Str::uuid(),
                'event_id' => 6, // Innovación Turística y Sostenible
                'schedule_id' => 4, // 09:30-10:30 (Martes) - CORREGIDO: era 3
                'location_id' => 2, // Salón Cian
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            // 10:30 - 11:30 horas
            [
                'uuid' => Str::uuid(),
                'event_id' => 7, // Panel: Dinámicas Mundiales que Transforman Nuestra Industria Turística
                'schedule_id' => 5, // 10:30-11:30 (Martes) - CORREGIDO: era 4
                'location_id' => 4, // Salón Terracota
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid' => Str::uuid(),
                'event_id' => 8, // Marketing Promocional de Destinos Turísticos Como Idea de Negocio
                'schedule_id' => 5, // 10:30-11:30 (Martes) - CORREGIDO: era 4
                'location_id' => 2, // Salón Cian
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid' => Str::uuid(),
                'event_id' => 9, // El Poder de WayFinding: Experiencia Ciudades Legibles
                'schedule_id' => 5, // 10:30-11:30 (Martes) - CORREGIDO: era 4
                'location_id' => 3, // Salón Rubí
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid' => Str::uuid(),
                'event_id' => 10, // Sesión 1. La Neuro Artesanía y su Incidencia en la Economía Circular
                'schedule_id' => 5, // 10:30-11:30 (Martes) - CORREGIDO: era 4
                'location_id' => 6, // Auditorio 5ta Avenida
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            // ======================================================
            // MARTES 21 DE OCTUBRE - TARDE (WORKSHOPS)
            // ======================================================
            [
                'uuid' => Str::uuid(),
                'event_id' => 11, // IA para la Generación Gráfica
                'schedule_id' => 7, // 14:00-18:00 (Martes) - CORREGIDO: era 5
                'location_id' => 9, // Aula A104 (FESC)
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid' => Str::uuid(),
                'event_id' => 12, // Fotografía de Producto
                'schedule_id' => 7, // 14:00-18:00 (Martes) - CORREGIDO: era 5
                'location_id' => 7, // Aula (FESC)
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid' => Str::uuid(),
                'event_id' => 13, // Fase 1. Prototipado y Validación de Soluciones Empresariales
                'schedule_id' => 7, // 14:00-18:00 (Martes) - CORREGIDO: era 5
                'location_id' => 7, // Aula (FESC)
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid' => Str::uuid(),
                'event_id' => 14, // Despertando la Mentalidad Innovadora
                'schedule_id' => 7, // 14:00-18:00 (Martes) - CORREGIDO: era 5
                'location_id' => 8, // Aula C401 (FESC)
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid' => Str::uuid(),
                'event_id' => 15, // Narrativas de Región
                'schedule_id' => 7, // 14:00-18:00 (Martes) - CORREGIDO: era 5
                'location_id' => 7, // Aula (FESC)
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid' => Str::uuid(),
                'event_id' => 16, // Desarrollo de Capacidades de Innovación en las Empresas Turísticas
                'schedule_id' => 7, // 14:00-18:00 (Martes) - CORREGIDO: era 5
                'location_id' => 7, // Aula C301 (FESC)
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            // ======================================================
            // MARTES 21 DE OCTUBRE - TARDE (CONFERENCIAS)
            // ======================================================
            [
                'uuid' => Str::uuid(),
                'event_id' => 17, // Automatización y Talento Humano
                'schedule_id' => 8, // 17:00-18:00 (Martes) - CORREGIDO: era 6
                'location_id' => 3, // Salón Rubí
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid' => Str::uuid(),
                'event_id' => 18, // Rentabilidad de las Empresas Turísticas
                'schedule_id' => 8, // 17:00-18:00 (Martes) - CORREGIDO: era 6
                'location_id' => 4, // Salón Terracota
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            // ======================================================
            // MARTES 21 DE OCTUBRE - VIRTUALES
            // ======================================================
            [
                'uuid' => Str::uuid(),
                'event_id' => 19, // Logística de Eventos
                'schedule_id' => 9, // Virtual (Martes) - CORREGIDO: era 7
                'location_id' => 13, // Virtual
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid' => Str::uuid(),
                'event_id' => 20, // Estrategias Comerciales para el Impulso de Productos Turísticos
                'schedule_id' => 9, // Virtual (Martes) - CORREGIDO: era 7
                'location_id' => 13, // Virtual
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            // ======================================================
            // MARTES 21 DE OCTUBRE - CULTURAL
            // ======================================================
            [
                'uuid' => Str::uuid(),
                'event_id' => 21, // 4º FESCtival Internacional de Cine Universitario - Proyección
                'schedule_id' => 6, // 08:00-12:00 (Martes) - CORREGIDO: era 8
                'location_id' => 10, // Centro Cultural Quinta Teresa
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid' => Str::uuid(),
                'event_id' => 22, // Gala Inaugural - 4º FESCtival
                'schedule_id' => 10, // 19:00-21:00 (Martes) - CORREGIDO: era 9
                'location_id' => 10, // Centro Cultural Quinta Teresa
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            // ======================================================
            // MIÉRCOLES 22 DE OCTUBRE - MAÑANA
            // ======================================================

            // 08:00 - 09:00 horas
            [
                'uuid' => Str::uuid(),
                'event_id' => 23, // Generación Gráfica con IA para la Divulgación Turística
                'schedule_id' => 11, // 08:00-09:00 (Miércoles) - CORREGIDO: era 10
                'location_id' => 4, // Salón Terracota
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid' => Str::uuid(),
                'event_id' => 24, // Entornos Mediáticos Expandidos: Prácticas Sociales y Digitales
                'schedule_id' => 11, // 08:00-09:00 (Miércoles) - CORREGIDO: era 10
                'location_id' => 3, // Salón Rubí
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            // 09:00 - 09:30 horas (BREAK) - ID 12

            // 09:30 - 10:30 horas
            [
                'uuid' => Str::uuid(),
                'event_id' => 25, // Modelos de Desarrollo Turístico Rentables y Sostenibles
                'schedule_id' => 13, // 09:30-10:30 (Miércoles) - CORREGIDO: era 11
                'location_id' => 6, // Auditorio 5ta Avenida
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid' => Str::uuid(),
                'event_id' => 26, // Sesión 2. Destino Moda: Exploración Socio Cultural a través del Diseño Comercial
                'schedule_id' => 13, // 09:30-10:30 (Miércoles) - CORREGIDO: era 11
                'location_id' => 6, // Auditorio 5ta Avenida
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid' => Str::uuid(),
                'event_id' => 27, // La Infografía como Herramienta de Divulgación para Souvenirs Autóctonos
                'schedule_id' => 13, // 09:30-10:30 (Miércoles) - CORREGIDO: era 11
                'location_id' => 4, // Salón Terracota
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            // 10:30 - 11:30 horas
            [
                'uuid' => Str::uuid(),
                'event_id' => 28, // Identificación de Productos Exportables
                'schedule_id' => 14, // 10:30-11:30 (Miércoles) - CORREGIDO: era 12
                'location_id' => 3, // Salón Rubí
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid' => Str::uuid(),
                'event_id' => 29, // Turismo Rural Sostenible: Casos de Impacto y Oportunidades Reales
                'schedule_id' => 14, // 10:30-11:30 (Miércoles) - CORREGIDO: era 12
                'location_id' => 2, // Salón Cian
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid' => Str::uuid(),
                'event_id' => 30, // Sesión 2. La Neuro Artesanía y su Incidencia en la Economía Circular
                'schedule_id' => 14, // 10:30-11:30 (Miércoles) - CORREGIDO: era 12
                'location_id' => 2, // Salón Cian
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid' => Str::uuid(),
                'event_id' => 31, // Panel: Modelos Globales que Potencializan el Desarrollo Económico de la Región
                'schedule_id' => 14, // 10:30-11:30 (Miércoles) - CORREGIDO: era 12
                'location_id' => 4, // Salón Terracota
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            // ======================================================
            // MIÉRCOLES 22 DE OCTUBRE - TARDE (WORKSHOPS)
            // ======================================================
            [
                'uuid' => Str::uuid(),
                'event_id' => 32, // Taller con Diseñador Invitado
                'schedule_id' => 16, // 14:00-18:00 (Miércoles) - CORREGIDO: era 13
                'location_id' => 7, // Aula (FESC)
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid' => Str::uuid(),
                'event_id' => 33, // Taller de Diseño de Experiencias Turísticas
                'schedule_id' => 16, // 14:00-18:00 (Miércoles) - CORREGIDO: era 13
                'location_id' => 8, // Aula C401 (FESC)
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid' => Str::uuid(),
                'event_id' => 34, // Herramientas Tecnológicas de Acceso Libre para el Diseño Integráfico
                'schedule_id' => 16, // 14:00-18:00 (Miércoles) - CORREGIDO: era 13
                'location_id' => 7, // Aula C301 (FESC)
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid' => Str::uuid(),
                'event_id' => 35, // Componentes Financieros para los Convocatorios de Fondos de Financiación
                'schedule_id' => 16, // 14:00-18:00 (Miércoles) - CORREGIDO: era 13
                'location_id' => 7, // Aula (FESC)
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid' => Str::uuid(),
                'event_id' => 36, // Fase 2. Prototipado y Validación de Soluciones Empresariales
                'schedule_id' => 16, // 14:00-18:00 (Miércoles) - CORREGIDO: era 13
                'location_id' => 5, // Salón Coral
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            // ======================================================
            // MIÉRCOLES 22 DE OCTUBRE - TARDE (CONFERENCIAS)
            // ======================================================
            [
                'uuid' => Str::uuid(),
                'event_id' => 37, // Estrategias Trasmedia para impulsar el Turismo del Futuro
                'schedule_id' => 17, // 17:00-18:00 (Miércoles) - CORREGIDO: era 14
                'location_id' => 3, // Salón Rubí
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid' => Str::uuid(),
                'event_id' => 38, // Oportunidades de Financiación para Proyectos Agrosostenibles
                'schedule_id' => 17, // 17:00-18:00 (Miércoles) - CORREGIDO: era 14
                'location_id' => 4, // Salón Terracota
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid' => Str::uuid(),
                'event_id' => 39, // Retail Design para UX en el Sector Gastronómico
                'schedule_id' => 17, // 17:00-18:00 (Miércoles) - CORREGIDO: era 14
                'location_id' => 6, // Auditorio 5ta Avenida
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid' => Str::uuid(),
                'event_id' => 40, // Branding Experiencial para el Fortalecimiento de Marcas en el Sector Turístico
                'schedule_id' => 18, // 20:00-20:30 (Miércoles) - CORREGIDO: era 14
                'location_id' => 6, // Auditorio 5ta Avenida
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            // ======================================================
            // MIÉRCOLES 22 DE OCTUBRE - VIRTUALES
            // ======================================================
            [
                'uuid' => Str::uuid(),
                'event_id' => 41, // Atracción de Inversión Extranjera en las Apuestas Productivas
                'schedule_id' => 19, // Virtual (Miércoles) - CORREGIDO: era 15
                'location_id' => 13, // Virtual
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid' => Str::uuid(),
                'event_id' => 42, // Impulso a la Competitividad Regional
                'schedule_id' => 19, // Virtual (Miércoles) - CORREGIDO: era 15
                'location_id' => 13, // Virtual
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid' => Str::uuid(),
                'event_id' => 43, // Conecta para Crecer: El Poder de la Asociatividad en el Turismo
                'schedule_id' => 19, // Virtual (Miércoles) - CORREGIDO: era 15
                'location_id' => 13, // Virtual
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            // ======================================================
            // MIÉRCOLES 22 DE OCTUBRE - EVENTOS ESPECIALES
            // ======================================================
            [
                'uuid' => Str::uuid(),
                'event_id' => 44, // Mesa Redonda "Hablando con los Alcaldes"
                'schedule_id' => 16, // 14:00-18:00 (Miércoles) - CORREGIDO: era 13
                'location_id' => 5, // Salón Coral
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid' => Str::uuid(),
                'event_id' => 45, // 4º FESCtival Internacional de Cine - Proyección
                'schedule_id' => 15, // 08:00-12:00 (Miércoles) - CORREGIDO: era 13
                'location_id' => 10, // Centro Cultural Quinta Teresa
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            // ======================================================
            // JUEVES 23 DE OCTUBRE - MAÑANA
            // ======================================================

            // 08:00 - 09:00 horas
            [
                'uuid' => Str::uuid(),
                'event_id' => 46, // Innovación en la Industria Calzado Nothink Shoes
                'schedule_id' => 20, // 08:00-09:00 (Jueves) - CORREGIDO: era 16
                'location_id' => 4, // Salón Terracota
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid' => Str::uuid(),
                'event_id' => 47, // Retail Design para UX en el Sector Gastronómico
                'schedule_id' => 20, // 08:00-09:00 (Jueves) - CORREGIDO: era 16
                'location_id' => 3, // Salón Rubí
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            // 09:00 - 09:30 horas (BREAK) - ID 21

            // 09:30 - 10:30 horas
            [
                'uuid' => Str::uuid(),
                'event_id' => 48, // Soluciones Fintech para Empresas Rurales
                'schedule_id' => 22, // 09:30-10:30 (Jueves) - CORREGIDO: era 17
                'location_id' => 6, // Auditorio 5ta Avenida
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid' => Str::uuid(),
                'event_id' => 49, // Cerrando Brechas Digitales en el Turismo Colombiano
                'schedule_id' => 22, // 09:30-10:30 (Jueves) - CORREGIDO: era 17
                'location_id' => 2, // Salón Cian
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid' => Str::uuid(),
                'event_id' => 50, // Materia Viva: Artesanía, Moda y Sostenibilidad
                'schedule_id' => 22, // 09:30-10:30 (Jueves) - CORREGIDO: era 17
                'location_id' => 2, // Salón Cian
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            // 10:30 - 11:30 horas
            [
                'uuid' => Str::uuid(),
                'event_id' => 51, // Panel: Impacto de la Investigación y la Tecnología
                'schedule_id' => 23, // 10:30-11:30 (Jueves) - CORREGIDO: era 18
                'location_id' => 4, // Salón Terracota
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid' => Str::uuid(),
                'event_id' => 52, // Branding Experiencial para el Fortalecimiento de Marcas
                'schedule_id' => 23, // 10:30-11:30 (Jueves) - CORREGIDO: era 18
                'location_id' => 4, // Salón Terracota
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid' => Str::uuid(),
                'event_id' => 53, // Estrategias para la Presentación de Proyectos Turísticos
                'schedule_id' => 23, // 10:30-11:30 (Jueves) - CORREGIDO: era 18
                'location_id' => 3, // Salón Rubí
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid' => Str::uuid(),
                'event_id' => 54, // E-commerce de Productos y Servicios + Sostenibilidad
                'schedule_id' => 23, // 10:30-11:30 (Jueves) - CORREGIDO: era 18
                'location_id' => 6, // Auditorio 5ta Avenida
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            // ======================================================
            // JUEVES 23 DE OCTUBRE - TARDE (WORKSHOPS)
            // ======================================================
            [
                'uuid' => Str::uuid(),
                'event_id' => 55, // Uso de Tecnologías Financieras que Faciliten el Cierre de Negocios
                'schedule_id' => 25, // 14:00-18:00 (Jueves) - CORREGIDO: era 19
                'location_id' => 7, // Aula C301 (FESC)
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid' => Str::uuid(),
                'event_id' => 56, // Fase 3 Final: Prototipado y Validación de Soluciones Empresariales
                'schedule_id' => 25, // 14:00-18:00 (Jueves) - CORREGIDO: era 19
                'location_id' => 7, // Aula (FESC)
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid' => Str::uuid(),
                'event_id' => 57, // Simuladores para la Gestión Aduanera
                'schedule_id' => 25, // 14:00-18:00 (Jueves) - CORREGIDO: era 19
                'location_id' => 7, // Aula (FESC)
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid' => Str::uuid(),
                'event_id' => 58, // De la Idea al Impacto: Fórmula de Proyectos Rentables y Sostenibles
                'schedule_id' => 25, // 14:00-18:00 (Jueves) - CORREGIDO: era 19
                'location_id' => 8, // Aula C401 (FESC)
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            // ======================================================
            // JUEVES 23 DE OCTUBRE - TARDE (CONFERENCIAS)
            // ======================================================
            [
                'uuid' => Str::uuid(),
                'event_id' => 59, // Proyectos de Innovación en Comunicación y Diseño con Inteligencia Artificial
                'schedule_id' => 26, // 17:00-18:00 (Jueves) - CORREGIDO: era 20
                'location_id' => 6, // Auditorio 5ta Avenida
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            // ======================================================
            // JUEVES 23 DE OCTUBRE - VIRTUALES
            // ======================================================
            [
                'uuid' => Str::uuid(),
                'event_id' => 60, // Comercio Electrónico como Mecanismo para el Crecimiento Empresarial
                'schedule_id' => 29, // Virtual (Jueves) - CORREGIDO: era 21
                'location_id' => 13, // Virtual
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid' => Str::uuid(),
                'event_id' => 61, // Sostenibilidad y Reducción de Impactos
                'schedule_id' => 29, // Virtual (Jueves) - CORREGIDO: era 21
                'location_id' => 13, // Virtual
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            // ======================================================
            // JUEVES 23 DE OCTUBRE - CULTURAL
            // ======================================================
            [
                'uuid' => Str::uuid(),
                'event_id' => 62, // 4º FESCtival Internacional de Cine - Proyección
                'schedule_id' => 24, // 08:00-12:00 (Jueves) - CORREGIDO: era 19
                'location_id' => 10, // Centro Cultural Quinta Teresa
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid' => Str::uuid(),
                'event_id' => 63, // City Tour: Cúcuta Destino Fronterizo e Histórico
                'schedule_id' => 27, // 17:00-19:00 (Jueves) - CORREGIDO: era 22
                'location_id' => 14, // City Tour
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid' => Str::uuid(),
                'event_id' => 64, // Desfile de Modas ELEMENTALES: Casa de Duendes
                'schedule_id' => 28, // 20:00-23:00 (Jueves) - CORREGIDO: era 23
                'location_id' => 12, // C.C. Jardín Plaza
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            // ======================================================
            // VIERNES 24 DE OCTUBRE - CORREGIDO
            // ======================================================
            [
                'uuid' => Str::uuid(),
                'event_id' => 65, // ✅ Rueda de Negocios (event_id CORREGIDO)
                'schedule_id' => 30, // Viernes 08:00-12:00
                'location_id' => 10, // Centro Cultural Quinta Teresa
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid' => Str::uuid(),
                'event_id' => 65, // Feria Cultural
                'schedule_id' => 31, // CORREGIDO: Viernes 08:00-18:00 (era 30)
                'location_id' => 11, // Ecoparque Comfanorte
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid' => Str::uuid(),
                'event_id' => 66, // Fiesta de Cierre
                'schedule_id' => 32, // CORREGIDO: Viernes 20:00-23:00 (era 31)
                'location_id' => 11, // Ecoparque Comfanorte
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

        ];

        foreach ($eventScheduleLocations as $eventScheduleLocation) {
            DB::table('event_schedule_location')->insert($eventScheduleLocation);
        }

        $this->command->info('Relaciones evento-horario-ubicación creadas exitosamente!');
    }
}
