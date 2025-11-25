<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Theme;
use Carbon\Carbon;  

class ThemesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $themes = [
              // Lunes 20 - Panel Inaugural
            [
                'uuid'        => Str::uuid(),
                'name'        => 'Inauguración y Perspectivas Globales',
                'start_date'  => '2025-10-20',
                'description' => 'Panel inaugural con expertos nacionales e internacionales sobre tendencias de Colombia y el mundo en innovación, tecnología e investigación, como apertura del congreso.',
                'agenda_id'   => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            // Martes 21 - Eje 1
            [
                'uuid'        => Str::uuid(),
                'name'        => 'Dinámicas Mundiales que Transforman Nuestra Industria Turística',
                'start_date'  => '2025-10-21',
                'description' => 'Eje temático del día martes: tendencias globales, innovación y sostenibilidad aplicadas al turismo regional.',
                'agenda_id'   => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            // Miércoles 22 - Eje 2
            [
                'uuid'        => Str::uuid(),
                'name'        => 'Modelos Globales que Potencializan el Desarrollo Económico de la Región',
                'start_date'  => '2025-10-22',
                'description' => 'Eje temático del día miércoles: modelos de negocio y estrategias que fortalecen el tejido productivo.',
                'agenda_id'   => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            // Jueves 23 - Eje 3
            [
                'uuid'        => Str::uuid(),
                'name'        => 'Impacto de la Investigación y la Tecnología en el Desarrollo Turístico y Productivo de la Región',
                'start_date'  => '2025-10-23',
                'description' => 'Eje temático del día jueves: adopción de tecnologías e investigación para impulsar competitividad.',
                'agenda_id'   => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            // Viernes 24 - Cierre
            [
                'uuid'        => Str::uuid(),
                'name'        => 'Cierre: Networking, Negocios y Cultura',
                'start_date'  => '2025-10-24',
                'description' => 'Jornada de clausura con la Rueda de Negocios, la Feria Cultural y la Fiesta de Cierre, integrando espacios empresariales, artísticos y de identidad regional.',
                'agenda_id'   => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]

        ];

        foreach ($themes as $theme) {
            Theme::create($theme);
        }

        $this->command->info('Ejes temáticos creados exitosamente!');
    }
}
