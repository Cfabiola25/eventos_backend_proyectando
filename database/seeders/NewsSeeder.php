<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\News;
use Carbon\Carbon; 

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $news = [
            [
                'uuid' => Str::uuid(),
                'title' => 'Una oportunidad para ampliar tus conocimientos e intercambiar cultura',
                'content' => 'Bienvenido, aquí encontrarás eventos para promover el aprendizaje y compartir experiencias. 
                              Descubre las actividades más destacadas que tiene para ti la universidad FESC. 
                              Inscríbete y forma parte de una experiencia única. 
                              Contaremos con expertos regionales, nacionales e internacionales con perspectivas globales que contribuyen al crecimiento y desarrollo de la región.',
                'is_published' => true,
                'published_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'uuid' => Str::uuid(),
                'title' => '¿Qué buscamos? - Congreso Internacional Proyectando 2025',
                'content' => 'En el marco de los 30 años de trayectoria institucional de nuestra institución, 
                              este año entregaremos a la región y al país, la 5° versión del Congreso Internacional Proyectando 2025. 
                              Nuestro objetivo es contribuir al fortalecimiento del sector turístico y productivo de Norte de Santander, 
                              a través de aportes académicos, que propendan la organización, promoción y el posicionamiento de los municipios 
                              con vocación turística y apuestas productivas, para impulsarlos como destinos atractivos y competitivos de la región.',
                'is_published' => true,
                'published_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'uuid' => Str::uuid(),
                'title' => 'Nuestra Experiencia - Trayectoria del Congreso Internacional',
                'content' => 'Desde el 2012 asumimos el reto de organizar un evento de alto impacto académico con el que contribuimos, 
                              a través de aportes de expertos al desarrollo de la región. 
                              Hemos pasado por diferentes enfoques que promueven la visión, el crecimiento, la innovación y el desarrollo.',
                'is_published' => true,
                'published_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        
        foreach ($news as $new) {
            News::create($new);
        }

        $this->command->info('Noticias creadas exitosamente!');
    }
}
