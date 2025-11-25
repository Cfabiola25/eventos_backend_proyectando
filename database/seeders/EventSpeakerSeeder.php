<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EventSpeakerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $eventSpeakers = [

            [
                'uuid' => Str::uuid(),
                'event_id' => 2,   // Datos, Experiencias y Decisiones: Cómo la IA está Transformando el Turismo
                'speaker_id' => 7, // Alberto Mena
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid' => Str::uuid(),
                'event_id' => 3,   // Sesión 1. Colección Cápsula Efectiva
                'speaker_id' => 8, // Juan Carlos León
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid' => Str::uuid(),
                'event_id' => 4,   // Soluciones Digitales para la Gestión Productiva del Departamento
                'speaker_id' => 4, // Andrés Díaz Molina
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid' => Str::uuid(),
                'event_id' => 5,   // Preservación de la Cocina Tradicional: Fotografía de Producto Gastronómico
                'speaker_id' => 2, // Javier Suescún
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid' => Str::uuid(),
                'event_id' => 6,   // Innovación Turística y Sostenible
                'speaker_id' => 1, // Federico De Arteaga Vidiella
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid' => Str::uuid(),
                'event_id' => 8,   // Marketing Promocional de Destinos Turísticos Como Idea de Negocio
                'speaker_id' => 5, // Jhon Faber Giraldo
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid' => Str::uuid(),
                'event_id' => 9,   // El Poder de WayFinding: Experiencia Ciudades Legibles
                'speaker_id' => 6, // Lucas López
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid' => Str::uuid(),
                'event_id' => 10,  // Sesión 1. La Neuro Artesanía y su Incidencia en la Economía Circular
                'speaker_id' => 3, // María Cecilia López
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            // TARDE - WORKSHOPS
            [
                'uuid' => Str::uuid(),
                'event_id' => 11,  // IA para la Generación Gráfica
                'speaker_id' => 10, // Wilfer Montoya Benjumea
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            // Evento 12 - Fotografía de Producto (Por definir) - Sin speaker
            [
                'uuid' => Str::uuid(),
                'event_id' => 13,  // Fase 1. Prototipado y Validación de Soluciones Empresariales
                'speaker_id' => 11, // Otniel Josafat López Altamirano
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid' => Str::uuid(),
                'event_id' => 13,  // Fase 1. Prototipado y Validación de Soluciones Empresariales
                'speaker_id' => 7,  // Alberto Mena
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid' => Str::uuid(),
                'event_id' => 14,  // Despertando la Mentalidad Innovadora
                'speaker_id' => 1, // Federico De Arteaga Vidiella
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid' => Str::uuid(),
                'event_id' => 15,  // Narrativas de Región
                'speaker_id' => 3, // María Cecilia López
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid' => Str::uuid(),
                'event_id' => 16,  // Desarrollo de Capacidades de Innovación en las Empresas Turísticas
                'speaker_id' => 21, // Julio Cesar Acosta Prado
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            // TARDE - CONFERENCIAS
            [
                'uuid' => Str::uuid(),
                'event_id' => 17,  // Automatización y Talento Humano
                'speaker_id' => 7, // Alberto Mena
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid' => Str::uuid(),
                'event_id' => 18,  // Rentabilidad de las Empresas Turísticas
                'speaker_id' => 21, // Julio Cesar Acosta Prado
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            // VIRTUALES
            [
                'uuid' => Str::uuid(),
                'event_id' => 19,  // Logística de Eventos
                'speaker_id' => 22, // Manuel Fernández Vilacañías
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid' => Str::uuid(),
                'event_id' => 20,  // Estrategias Comerciales para el Impulso de Productos Turísticos
                'speaker_id' => 9, // Natalia Bayona
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            // ======================================================
            // MIÉRCOLES 22 DE OCTUBRE
            // ======================================================

            // MAÑANA - CONFERENCIAS
            [
                'uuid' => Str::uuid(),
                'event_id' => 23,  // Generación Gráfica con IA para la Divulgación Turística
                'speaker_id' => 10, // Wilfer Montoya Benjumea
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid' => Str::uuid(),
                'event_id' => 24,  // Entornos Mediáticos Expandidos: Prácticas Sociales y Digitales
                'speaker_id' => 11, // Otniel Josafat López Altamirano
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid' => Str::uuid(),
                'event_id' => 25,  // Modelos de Desarrollo Turístico Rentables y Sostenibles, Caso Sierra Nevada
                'speaker_id' => 16, // Alejandra Izquierdo Cujar
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid' => Str::uuid(),
                'event_id' => 26,  // Sesión 2. Destino Moda: Exploración Socio Cultural a través del Diseño Comercial
                'speaker_id' => 8, // Juan Carlos León
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid' => Str::uuid(),
                'event_id' => 27,  // La Infografía como Herramienta de Divulgación para Souvenirs Autóctonos
                'speaker_id' => 13, // Gerardo Luna Gijón
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid' => Str::uuid(),
                'event_id' => 28,  // Identificación de Productos Exportables
                'speaker_id' => 14, // Miguelina Ruiz Díaz
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid' => Str::uuid(),
                'event_id' => 29,  // Turismo Rural Sostenible: Casos de Impacto y Oportunidades Reales
                'speaker_id' => 15, // Héctor Daniel Martínez
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid' => Str::uuid(),
                'event_id' => 30,  // Sesión 2. La Neuro Artesanía y su Incidencia en la Economía Circular
                'speaker_id' => 3, // María Cecilia López
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            // TARDE - WORKSHOPS
            [
                'uuid' => Str::uuid(),
                'event_id' => 32,  // Taller con Diseñador Invitado
                'speaker_id' => 8, // Juan Carlos León
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid' => Str::uuid(),
                'event_id' => 33,  // Taller de Diseño de Experiencias Turísticas
                'speaker_id' => 15, // Héctor Daniel Martínez
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid' => Str::uuid(),
                'event_id' => 34,  // Herramientas Tecnológicas de Acceso Libre para el Diseño Integráfico
                'speaker_id' => 13, // Gerardo Luna Gijón
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid' => Str::uuid(),
                'event_id' => 35,  // Componentes Financieros para los Convocatorios de Fondos de Financiación
                'speaker_id' => 12, // Ricardo Alexis López Gallego
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid' => Str::uuid(),
                'event_id' => 36,  // Fase 2. Prototipado y Validación de Soluciones Empresariales
                'speaker_id' => 11, // Otniel Josafat López Altamirano
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            // TARDE - CONFERENCIAS
            [
                'uuid' => Str::uuid(),
                'event_id' => 37,  // Estrategias Trasmedia para impulsar el Turismo del Futuro
                'speaker_id' => 11, // Otniel Josafat López Altamirano
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid' => Str::uuid(),
                'event_id' => 38,  // Oportunidades de Financiación para Proyectos Agrosostenibles
                'speaker_id' => 12, // Ricardo Alexis López Gallego
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid' => Str::uuid(),
                'event_id' => 39,  // Retail Design para UX en el Sector Gastronómico
                'speaker_id' => 23, // Lucía Corali Nelly Risco Mc Gregor
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            // VIRTUALES
            [
                'uuid' => Str::uuid(),
                'event_id' => 40,  // Atracción de Inversión Extranjera en las Apuestas Productivas
                'speaker_id' => 17, // Andrea Paola Santanilla Narvaez
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid' => Str::uuid(),
                'event_id' => 41,  // Impulso a la Competitividad Regional
                'speaker_id' => 18, // Luis Aníbal Mora García
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid' => Str::uuid(),
                'event_id' => 43,  // Conecta para Crecer: El Poder de la Asociatividad en el Turismo
                'speaker_id' => 19, // Angela Pantoja
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            // ======================================================
            // JUEVES 23 DE OCTUBRE
            // ======================================================

            // MAÑANA - CONFERENCIAS
            [
                'uuid' => Str::uuid(),
                'event_id' => 46,  // Innovación en la Industria Calzado Nothink Shoes
                'speaker_id' => 26, // Asia Pellegrini
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid' => Str::uuid(),
                'event_id' => 46,  // Innovación en la Industria Calzado Nothink Shoes
                'speaker_id' => 27, // Luna T. García
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid' => Str::uuid(),
                'event_id' => 47,  // Retail Design para UX en el Sector Gastronómico
                'speaker_id' => 23, // Lucía Corali Nelly Risco Mc Gregor
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid' => Str::uuid(),
                'event_id' => 48,  // Soluciones Fintech para Empresas Rurales
                'speaker_id' => 25, // Magreth Gutiérrez Vargas
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid' => Str::uuid(),
                'event_id' => 49,  // Cerrando Brechas Digitales en el Turismo Colombiano
                'speaker_id' => 24, // Karina Vélez Gómez
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid' => Str::uuid(),
                'event_id' => 50,  // Materia Viva: Artesanía, Moda y Sostenibilidad
                'speaker_id' => 30, // Ángela María Galindo Cañon
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid' => Str::uuid(),
                'event_id' => 53,  // Estrategias para la Presentación de Proyectos Turísticos
                'speaker_id' => 29, // Alejandro Fajardo
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid' => Str::uuid(),
                'event_id' => 54,  // E-commerce de Productos y Servicios + Sostenibilidad
                'speaker_id' => 28, // Juan Carlos Peña Castro
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            // TARDE - WORKSHOPS
            [
                'uuid' => Str::uuid(),
                'event_id' => 55,  // Uso de Tecnologías Financieras que Faciliten el Cierre de Negocios
                'speaker_id' => 25, // Magreth Gutiérrez Vargas
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid' => Str::uuid(),
                'event_id' => 56,  // Fase 3 Final: Prototipado y Validación de Soluciones Empresariales
                'speaker_id' => 11, // Otniel Josafat López Altamirano
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid' => Str::uuid(),
                'event_id' => 56,  // Fase 3 Final: Prototipado y Validación de Soluciones Empresariales
                'speaker_id' => 7,  // Alberto Mena
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid' => Str::uuid(),
                'event_id' => 56,  // Fase 3 Final: Prototipado y Validación de Soluciones Empresariales
                'speaker_id' => 24, // Karina Vélez Gómez
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid' => Str::uuid(),
                'event_id' => 58,  // De la Idea al Impacto: Fórmula de Proyectos Rentables y Sostenibles
                'speaker_id' => 29, // Alejandro Fajardo
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            // TARDE - CONFERENCIAS
            [
                'uuid' => Str::uuid(),
                'event_id' => 59,  // Proyectos de Innovación en Comunicación y Diseño con Inteligencia Artificial
                'speaker_id' => 32, // Carlos Enrique Fernández García
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            // VIRTUALES
            [
                'uuid' => Str::uuid(),
                'event_id' => 60,  // Comercio Electrónico como Mecanismo para el Crecimiento Empresarial
                'speaker_id' => 33, // Amalia Aguilar Castillo
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid' => Str::uuid(),
                'event_id' => 61,  // Sostenibilidad y Reducción de Impactos
                'speaker_id' => 34, // Diego Santos González
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ];



        foreach ($eventSpeakers as $eventSpeaker) {
            DB::table('event_speaker')->insert($eventSpeaker);
        }

        $this->command->info('Relaciones entre eventos y ponentes creadas exitosamente!');
    }
}
