<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Event;
use Carbon\Carbon; 

class EventsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

         $events = [
         // LUNES 20 - PANEL INAUGURAL
            [
                'uuid' => Str::uuid(),
                'title' => 'Panel Inaugural: Tendencias Mundiales en Innovación, Tecnología e Investigación, Aportándole al Desarrollo Turístico y Productivo de la Región',
                'image' => null,
                'description' => 'La experiencia de expertos Nacionales e Internacionales con perspectivas globales que contribuyen al desarrollo turístico y productivo de Norte de Santander.',
                'max_capacity' => 500,
                'virtual_link' => null,
                'modality_id' => 1,
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            
            // MARTES 21 - MAÑANA (CONFERENCIAS)
            [
                'uuid' => Str::uuid(),
                'title' => 'Datos, Experiencias y Decisiones: Cómo la IA está Transformando el Turismo',
                'image' => null,
                'description' => 'Conferencia que analiza el impacto de la inteligencia artificial en la toma de decisiones dentro del sector turístico.',
                'max_capacity' => 150,
                'virtual_link' => null,
                'modality_id' => 1,
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'uuid' => Str::uuid(),
                'title' => 'Sesión 1. Colección Cápsula Efectiva',
                'image' => null,
                'description' => 'Presentación enfocada en el diseño y desarrollo de una colección cápsula como estrategia innovadora dentro de la industria de la moda.',
                'max_capacity' => 80,
                'virtual_link' => null,
                'modality_id' => 1,
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'uuid' => Str::uuid(),
                'title' => 'Soluciones Digitales para la Gestión Productiva del Departamento',
                'image' => null,
                'description' => 'Conferencia sobre soluciones digitales para gestión productiva.',
                'max_capacity' => 150,
                'virtual_link' => 'https://meet.fesc.edu.co/panel-inaugural-innovacion-2024',
                'modality_id' => 1,
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'uuid' => Str::uuid(),
                'title' => 'Preservación de la Cocina Tradicional: Fotografía de Producto Gastronómico',
                'image' => null,
                'description' => 'Conferencia sobre preservación de cocina tradicional.',
                'max_capacity' => 250,
                'virtual_link' => null,
                'modality_id' => 1,
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'uuid' => Str::uuid(),
                'title' => 'Innovación Turística y Sostenible',
                'image' => null,
                'description' => 'Conferencia enfocada en la aplicación de modelos innovadores para el turismo sostenible.',
                'max_capacity' => 150,
                'virtual_link' => null,
                'modality_id' => 1,
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'uuid' => Str::uuid(),
                'title' => 'Panel: Dinámicas Mundiales que Transforman Nuestra Industria Turística',
                'image' => null,
                'description' => 'Espacio de diálogo con expertos internacionales que analizan las tendencias globales del turismo.',
                'max_capacity' => 150,
                'virtual_link' => null,
                'modality_id' => 1,
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'uuid' => Str::uuid(),
                'title' => 'Marketing Promocional de Destinos Turísticos Como Idea de Negocio',
                'image' => null,
                'description' => 'Conferencia sobre marketing promocional de destinos turísticos.',
                'max_capacity' => 150,
                'virtual_link' => null,
                'modality_id' => 1,
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'uuid' => Str::uuid(),
                'title' => 'El Poder de WayFinding: Experiencia Ciudades Legibles',
                'image' => null,
                'description' => 'Conferencia sobre WayFinding y ciudades legibles.',
                'max_capacity' => 250,
                'virtual_link' => null,
                'modality_id' => 1,
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'uuid' => Str::uuid(),
                'title' => 'Sesión 1. La Neuro Artesanía y su Incidencia en la Economía Circular',
                'image' => null,
                'description' => 'Conferencia sobre neuro artesanía y economía circular.',
                'max_capacity' => 80,
                'virtual_link' => null,
                'modality_id' => 1,
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            // MARTES 21 - TARDE (WORKSHOPS)
            [
                'uuid' => Str::uuid(),
                'title' => 'IA para la Generación Gráfica',
                'image' => null,
                'description' => 'Taller sobre inteligencia artificial para generación gráfica.',
                'max_capacity' => 30,
                'virtual_link' => null,
                'modality_id' => 1,
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'uuid' => Str::uuid(),
                'title' => 'Fotografía de Producto',
                'image' => null,
                'description' => 'Taller de fotografía de producto.',
                'max_capacity' => 30,
                'virtual_link' => null,
                'modality_id' => 1,
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'uuid' => Str::uuid(),
                'title' => 'Fase 1. Prototipado y Validación de Soluciones Empresariales',
                'image' => null,
                'description' => 'Taller sobre validación de soluciones empresariales.',
                'max_capacity' => 30,
                'virtual_link' => null,
                'modality_id' => 1,
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'uuid' => Str::uuid(),
                'title' => 'Despertando la Mentalidad Innovadora',
                'image' => null,
                'description' => 'Taller sobre mentalidad innovadora.',
                'max_capacity' => 30,
                'virtual_link' => null,
                'modality_id' => 1,
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'uuid' => Str::uuid(),
                'title' => 'Narrativas de Región',
                'image' => null,
                'description' => 'Taller sobre narrativas de región.',
                'max_capacity' => 30,
                'virtual_link' => null,
                'modality_id' => 1,
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'uuid' => Str::uuid(),
                'title' => 'Desarrollo de Capacidades de Innovación en las Empresas Turísticas',
                'image' => null,
                'description' => 'Taller sobre desarrollo de capacidades de innovación.',
                'max_capacity' => 30,
                'virtual_link' => null,
                'modality_id' => 1,
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            // MARTES 21 - TARDE (CONFERENCIAS)
            [
                'uuid' => Str::uuid(),
                'title' => 'Automatización y Talento Humano: ¿Cómo Preparar el Mercado Laboral Turístico para la Transformación Digital?',
                'image' => null,
                'description' => 'Conferencia sobre automatización y talento humano en el sector turístico.',
                'max_capacity' => 80,
                'virtual_link' => null,
                'modality_id' => 1,
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'uuid' => Str::uuid(),
                'title' => 'Rentabilidad de las Empresas Turísticas',
                'image' => null,
                'description' => 'Conferencia sobre rentabilidad en empresas turísticas.',
                'max_capacity' => 150,
                'virtual_link' => null,
                'modality_id' => 1,
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            // MARTES 21 - VIRTUALES
            [
                'uuid' => Str::uuid(),
                'title' => 'Logística de Eventos',
                'image' => null,
                'description' => 'Conferencia virtual sobre logística de eventos.',
                'max_capacity' => null,
                'virtual_link' => null,
                'modality_id' => 2,
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'uuid' => Str::uuid(),
                'title' => 'Estrategias Comerciales para el Impulso de Productos Turísticos',
                'image' => null,
                'description' => 'Conferencia virtual sobre estrategias comerciales.',
                'max_capacity' => null,
                'virtual_link' => null,
                'modality_id' => 2,
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            // MARTES 21 - EVENTOS CULTURALES
            [
                'uuid' => Str::uuid(),
                'title' => '4º FESCtival Internacional de Cine Universitario de Cúcuta - Proyección de Cortometrajes',
                'image' => null,
                'description' => 'Proyección de cortometrajes del festival de cine universitario.',
                'max_capacity' => null,
                'virtual_link' => null,
                'modality_id' => 1,
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'uuid' => Str::uuid(),
                'title' => 'Gala Inaugural - 4º FESCtival Internacional de Cine Universitario de Cúcuta',
                'image' => null,
                'description' => 'Gala inaugural del festival de cine universitario.',
                'max_capacity' => null,
                'virtual_link' => null,
                'modality_id' => 1,
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            // MIÉRCOLES 22 - MAÑANA (CONFERENCIAS)
            [
                'uuid' => Str::uuid(),
                'title' => 'Generación Gráfica con IA para la Divulgación Turística',
                'image' => null,
                'description' => 'Conferencia sobre generación gráfica con IA para turismo.',
                'max_capacity' => 250,
                'virtual_link' => null,
                'modality_id' => 1,
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'uuid' => Str::uuid(),
                'title' => 'Entornos Mediáticos Expandidos: Prácticas Sociales y Digitales',
                'image' => null,
                'description' => 'Conferencia sobre entornos mediáticos expandidos.',
                'max_capacity' => 150,
                'virtual_link' => null,
                'modality_id' => 1,
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'uuid' => Str::uuid(),
                'title' => 'Modelos de Desarrollo Turístico Rentables y Sostenibles, Caso Sierra Nevada de Santamarta',
                'image' => null,
                'description' => 'Conferencia sobre modelos de desarrollo turístico.',
                'max_capacity' => 80,
                'virtual_link' => null,
                'modality_id' => 1,
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'uuid' => Str::uuid(),
                'title' => 'Sesión 2. Destino Moda: Exploración Socio Cultural a través del Diseño Comercial',
                'image' => null,
                'description' => 'Conferencia sobre destino moda y diseño comercial.',
                'max_capacity' => 150,
                'virtual_link' => null,
                'modality_id' => 1,
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'uuid' => Str::uuid(),
                'title' => 'La Infografía como Herramienta de Divulgación para Souvenirs Autóctonos en Locaciones Turísticas',
                'image' => null,
                'description' => 'Conferencia sobre integración de souvenirs autóctonos.',
                'max_capacity' => 250,
                'virtual_link' => null,
                'modality_id' => 1,
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'uuid' => Str::uuid(),
                'title' => 'Identificación de Productos Exportables',
                'image' => null,
                'description' => 'Conferencia sobre identificación de productos exportables.',
                'max_capacity' => 150,
                'virtual_link' => null,
                'modality_id' => 1,
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'uuid' => Str::uuid(),
                'title' => 'Turismo Rural Sostenible: Casos de Impacto y Oportunidades Reales',
                'image' => null,
                'description' => 'Conferencia sobre turismo rural sostenible.',
                'max_capacity' => 80,
                'virtual_link' => null,
                'modality_id' => 1,
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'uuid' => Str::uuid(),
                'title' => 'Sesión 2. La Neuro Artesanía y su Incidencia en la Economía Circular',
                'image' => null,
                'description' => 'Conferencia sobre neuro artesanía y economía circular.',
                'max_capacity' => 150,
                'virtual_link' => null,
                'modality_id' => 1,
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'uuid' => Str::uuid(),
                'title' => 'Panel: Modelos Globales que Potencializan el Desarrollo Económico de la Región',
                'image' => null,
                'description' => 'Diálogo con expertos internacionales sobre estrategias innovadoras para el desarrollo económico regional.',
                'max_capacity' => 150,
                'virtual_link' => null,
                'modality_id' => 1,
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            // MIÉRCOLES 22 - TARDE (WORKSHOPS)
            [
                'uuid' => Str::uuid(),
                'title' => 'Taller con Diseñador Invitado',
                'image' => null,
                'description' => 'Taller especializado con diseñador invitado.',
                'max_capacity' => 30,
                'virtual_link' => null,
                'modality_id' => 1,
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'uuid' => Str::uuid(),
                'title' => 'Taller de Diseño de Experiencias Turísticas',
                'image' => null,
                'description' => 'Taller sobre diseño de experiencias turísticas.',
                'max_capacity' => 30,
                'virtual_link' => null,
                'modality_id' => 1,
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'uuid' => Str::uuid(),
                'title' => 'Herramientas Tecnológicas de Acceso Libre para el Diseño Integráfico',
                'image' => null,
                'description' => 'Taller sobre herramientas tecnológicas para diseño.',
                'max_capacity' => 30,
                'virtual_link' => null,
                'modality_id' => 1,
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'uuid' => Str::uuid(),
                'title' => 'Componentes Financieros para los Convocatorios de Fondos de Financiación',
                'image' => null,
                'description' => 'Taller sobre componentes financieros en proyectos.',
                'max_capacity' => 30,
                'virtual_link' => null,
                'modality_id' => 1,
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'uuid' => Str::uuid(),
                'title' => 'Fase 2. Prototipado y Validación de Soluciones Empresariales',
                'image' => null,
                'description' => 'Taller sobre prototipado y validación de soluciones empresariales.',
                'max_capacity' => 30,
                'virtual_link' => null,
                'modality_id' => 1,
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            // MIÉRCOLES 22 - TARDE (CONFERENCIAS)
            [
                'uuid' => Str::uuid(),
                'title' => 'Estrategias Trasmedia para impulsar el Turismo del Futuro',
                'image' => null,
                'description' => 'Conferencia sobre estrategias trasmedia para turismo.',
                'max_capacity' => 80,
                'virtual_link' => null,
                'modality_id' => 1,
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'uuid' => Str::uuid(),
                'title' => 'Oportunidades de Financiación para Proyectos Agrosostenibles y el Mercado de Bonos de Carbono',
                'image' => null,
                'description' => 'Conferencia sobre financiación de proyectos agrosostenibles.',
                'max_capacity' => 150,
                'virtual_link' => null,
                'modality_id' => 1,
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'uuid' => Str::uuid(),
                'title' => 'Retail Design para UX en el Sector Gastronómico',
                'image' => null,
                'description' => 'Conferencia sobre retail design para UX en gastronomía.',
                'max_capacity' => 150,
                'virtual_link' => null,
                'modality_id' => 1,
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'uuid' => Str::uuid(),
                'title' => 'Branding Experiencial para el Fortalecimiento de Marcas en el Sector Turístico',
                'image' => null,
                'description' => 'Conferencia sobre branding experiencial en turismo.',
                'max_capacity' => 150,
                'virtual_link' => null,
                'modality_id' => 1,
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            // MIÉRCOLES 22 - VIRTUALES
            [
                'uuid' => Str::uuid(),
                'title' => 'Atracción de Inversión Extranjera en las Apuestas Productivas de Norte de Santander',
                'image' => null,
                'description' => 'Conferencia virtual sobre inversión extranjera.',
                'max_capacity' => null,
                'virtual_link' => null,
                'modality_id' => 2,
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'uuid' => Str::uuid(),
                'title' => 'Impulso a la Competitividad Regional',
                'image' => null,
                'description' => 'Conferencia virtual sobre competitividad regional.',
                'max_capacity' => null,
                'virtual_link' => null,
                'modality_id' => 2,
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'uuid' => Str::uuid(),
                'title' => 'Conecta para Crecer: El Poder de la Asociatividad en el Turismo',
                'image' => null,
                'description' => 'Conferencia virtual sobre asociatividad en turismo.',
                'max_capacity' => null,
                'virtual_link' => null,
                'modality_id' => 2,
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            // MIÉRCOLES 22 - EVENTOS ESPECIALES
            [
                'uuid' => Str::uuid(),
                'title' => 'Mesa Redonda "Hablando con los Alcaldes"',
                'image' => null,
                'description' => 'Mesa redonda con alcaldes de la región.',
                'max_capacity' => 50,
                'virtual_link' => null,
                'modality_id' => 1,
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'uuid' => Str::uuid(),
                'title' => '4º FESCtival Internacional de Cine Universitario de Cúcuta - Proyección de Cortometrajes',
                'image' => null,
                'description' => 'Proyección de cortometrajes del festival de cine universitario.',
                'max_capacity' => null,
                'virtual_link' => null,
                'modality_id' => 1,
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            // JUEVES 23 - MAÑANA (CONFERENCIAS)
            [
                'uuid' => Str::uuid(),
                'title' => 'Innovación en la Industria Calzado Nothink Shoes',
                'image' => null,
                'description' => 'Conferencia sobre innovación en la industria del calzado.',
                'max_capacity' => 150,
                'virtual_link' => null,
                'modality_id' => 1,
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'uuid' => Str::uuid(),
                'title' => 'Retail Design para UX en el Sector Gastronómico',
                'image' => null,
                'description' => 'Conferencia sobre retail design para UX en gastronomía.',
                'max_capacity' => 250,
                'virtual_link' => null,
                'modality_id' => 1,
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'uuid' => Str::uuid(),
                'title' => 'Soluciones Fintech para Empresas Rurales',
                'image' => null,
                'description' => 'Conferencia sobre soluciones fintech para empresas rurales.',
                'max_capacity' => 80,
                'virtual_link' => null,
                'modality_id' => 1,
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'uuid' => Str::uuid(),
                'title' => 'Cerrando Brechas Digitales en el Turismo Colombiano a través de la Educación, la Inclusión y la Conectividad',
                'image' => null,
                'description' => 'Conferencia sobre brechas digitales en turismo.',
                'max_capacity' => 150,
                'virtual_link' => null,
                'modality_id' => 1,
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'uuid' => Str::uuid(),
                'title' => 'Materia Viva: Artesanía, Moda y Sostenibilidad',
                'image' => null,
                'description' => 'Conferencia que explora la relación entre artesanía, moda y sostenibilidad.',
                'max_capacity' => 150,
                'virtual_link' => null,
                'modality_id' => 1,
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'uuid' => Str::uuid(),
                'title' => 'Panel: Impacto de la Investigación y la Tecnología en el Desarrollo Turístico y Productivo de la Región',
                'image' => null,
                'description' => 'Diálogo con expertos sobre investigaciones y avances tecnológicos que transforman el sector.',
                'max_capacity' => 150,
                'virtual_link' => null,
                'modality_id' => 1,
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'uuid' => Str::uuid(),
                'title' => 'Estrategias para la Presentación de Proyectos Turísticos',
                'image' => null,
                'description' => 'Conferencia orientada a fortalecer las capacidades de formulación y presentación de proyectos turísticos.',
                'max_capacity' => 80,
                'virtual_link' => null,
                'modality_id' => 1,
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'uuid' => Str::uuid(),
                'title' => 'E-commerce de Productos y Servicios + Sostenibilidad, como una Apuesta de Negocio en la Región',
                'image' => null,
                'description' => 'Conferencia sobre e-commerce y sostenibilidad.',
                'max_capacity' => 150,
                'virtual_link' => null,
                'modality_id' => 1,
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            // JUEVES 23 - TARDE (WORKSHOPS)
            [
                'uuid' => Str::uuid(),
                'title' => 'Uso de Tecnologías Financieras que Faciliten el Cierre de Negocios en Ferias y Ruedas de Negocios',
                'image' => null,
                'description' => 'Taller sobre tecnologías financieras para negocios.',
                'max_capacity' => 30,
                'virtual_link' => null,
                'modality_id' => 1,
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'uuid' => Str::uuid(),
                'title' => 'Fase 3 Final: Prototipado y Validación de Soluciones Empresariales',
                'image' => null,
                'description' => 'Taller sobre prototipado y validación de soluciones empresariales.',
                'max_capacity' => 30,
                'virtual_link' => null,
                'modality_id' => 1,
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'uuid' => Str::uuid(),
                'title' => 'Simuladores para la Gestión Aduanera',
                'image' => null,
                'description' => 'Taller sobre simuladores para gestión aduanera.',
                'max_capacity' => 30,
                'virtual_link' => null,
                'modality_id' => 1,
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'uuid' => Str::uuid(),
                'title' => 'De la Idea al Impacto: Fórmula de Proyectos Rentables y Sostenibles',
                'image' => null,
                'description' => 'Taller sobre formulación de proyectos rentables.',
                'max_capacity' => 30,
                'virtual_link' => null,
                'modality_id' => 1,
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            // JUEVES 23 - TARDE (CONFERENCIAS)
            [
                'uuid' => Str::uuid(),
                'title' => 'Proyectos de Innovación en Comunicación y Diseño con Inteligencia Artificial',
                'image' => null,
                'description' => 'Conferencia sobre innovación en comunicación y diseño con IA.',
                'max_capacity' => 150,
                'virtual_link' => null,
                'modality_id' => 1,
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            // JUEVES 23 - VIRTUALES
            [
                'uuid' => Str::uuid(),
                'title' => 'Comercio Electrónico como Mecanismo para el Crecimiento Empresarial de la Región',
                'image' => null,
                'description' => 'Taller virtual sobre comercio electrónico.',
                'max_capacity' => null,
                'virtual_link' => null,
                'modality_id' => 2,
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'uuid' => Str::uuid(),
                'title' => 'Sostenibilidad y Reducción de Impactos',
                'image' => null,
                'description' => 'Taller virtual sobre sostenibilidad y reducción de impactos.',
                'max_capacity' => null,
                'virtual_link' => null,
                'modality_id' => 2,
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            // JUEVES 23 - EVENTOS CULTURALES
            [
                'uuid' => Str::uuid(),
                'title' => 'City Tour: Cúcuta Destino Fronterizo e Histórico',
                'image' => null,
                'description' => 'Recorrido por sitios representativos de la historia y cultura de la zona de frontera.',
                'max_capacity' => null,
                'virtual_link' => null,
                'modality_id' => 1,
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'uuid' => Str::uuid(),
                'title' => 'Desfile de Modas ELEMENTALES: Casa de Duendes',
                'image' => null,
                'description' => 'Desfile de modas con diseños que exaltan la identidad cultural de Norte de Santander.',
                'max_capacity' => null,
                'virtual_link' => null,
                'modality_id' => 1,
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'uuid' => Str::uuid(),
                'title' => '4º FESCtival Internacional de Cine Universitario de Cúcuta - Proyección de Cortometrajes',
                'image' => null,
                'description' => 'Proyección de cortometrajes del festival de cine universitario.',
                'max_capacity' => null,
                'virtual_link' => null,
                'modality_id' => 1,
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            // VIERNES 24 - EVENTOS DE CIERRE
            [
                'uuid' => Str::uuid(),
                'title' => 'Rueda de Negocios: Tejiendo Redes Productivas, Proyectamos Conexiones Comerciales Estratégicas',
                'image' => null,
                'description' => 'Espacio para generar oportunidades de negocios conectando empresarios de la región.',
                'max_capacity' => null,
                'virtual_link' => null,
                'modality_id' => 1,
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'uuid' => Str::uuid(),
                'title' => 'Feria Cultural: Las Riquezas de mi Tierra, Orgullo Nortesantandereano',
                'image' => null,
                'description' => 'Evento para promover la riqueza cultural, turística y productiva de los municipios de Norte de Santander.',
                'max_capacity' => null,
                'virtual_link' => null,
                'modality_id' => 1,
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'uuid' => Str::uuid(),
                'title' => 'Fiesta de Cierre: Destino Norte de Santander',
                'image' => null,
                'description' => 'Fiesta de cierre del congreso.',
                'max_capacity' => null,
                'virtual_link' => null,
                'modality_id' => 1,
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]        
        ];

        foreach ($events as $event) {
            Event::create($event);
        }

        $this->command->info('Eventos creados exitosamente!');

    }
}
