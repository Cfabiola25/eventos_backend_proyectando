<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\CityTour;    
use Carbon\Carbon; 

class CityToursSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cityTours = [ 
            [
                'uuid'         => Str::uuid(),
                'name'         => 'City Tour: Cúcuta - Destino Fronterizo e Histórico',
                'tour_date'    => '2025-10-23',     // Jueves 23 de octubre de 2025
                'tour_time'    => '17:00:00',       // Inicio 17:00 (fin 19:00 va en la descripción)
                'max_capacity' => null,             // No definido oficialmente en el brochure
                'description'  => 'Recorrido guiado por sitios representativos de la historia y cultura de la zona de frontera: Centro Cultural Quinta Teresa, Cristo Rey, Biblioteca Pública Julio Pérez Ferrero, Parque La Victoria, Cúpula Chata (Gobernación de Norte de Santander), Catedral de San José, Torre del Reloj, Complejo Histórico Villa del Rosario, Puente Internacional Simón Bolívar, Puente Internacional Tienditas y C.C. a cielo abierto Jardín Plaza. Horario: 17:00 a 19:00.',
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
        ];

        foreach ($cityTours as $citytour) {        
            CityTour::create($citytour);  
        }

        $this->command->info('City Tours creados exitosamente!');
    }
}
