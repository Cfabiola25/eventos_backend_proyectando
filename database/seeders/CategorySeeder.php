<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Category;
use Carbon\Carbon;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'uuid' => Str::uuid(),
                'name' => 'Conferencias',
                'description' => 'Sesiones expositivas dictadas por expertos nacionales e internacionales.',
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid' => Str::uuid(),
                'name' => 'Workshops',
                'description' => 'Talleres prácticos sobre turismo, sostenibilidad, innovación, moda, entre otros.',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'uuid' => Str::uuid(),
                'name' => 'Paneles',
                'description' => 'Espacios de diálogo entre expertos sobre temas clave del desarrollo regional.',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'uuid' => Str::uuid(),
                'name' => 'Mesas Redondas',
                'description' => 'Discusiones especializadas con participación de múltiples actores regionales.',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'uuid' => Str::uuid(),
                'name' => 'Eventos Virtuales',
                'description' => 'Conferencias y talleres transmitidos en línea para acceso remoto.',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'uuid' => Str::uuid(),
                'name' => 'Eventos Culturales',
                'description' => 'FESCtival de Cine, desfiles de moda, ferias culturales y actividades artísticas.',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'uuid' => Str::uuid(),
                'name' => 'Eventos de Networking',
                'description' => 'Rueda de negocios, fiestas de cierre y espacios de conexión empresarial.',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        $this->command->info('Categorias creadas exitosamente!');
    }
}
