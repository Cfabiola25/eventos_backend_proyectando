<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CityTourStop;
use Illuminate\Support\Str;
use Carbon\Carbon;

class CityTourStopsSeeder extends Seeder
{
    /**
     * ===================================
     * SEEDER: ESCALAS DE CITY TOURS
     * ===================================
     * Función: Inserta las paradas o escalas de un recorrido turístico.
     * Ejemplo: "FESC → Cristo Rey → Terminal → Malecón".
     */
    public function run(): void
    {
        $cityTourStops = [
            [
                'uuid' => Str::uuid(),
                'city_tour_id' => 1,
                'order' => 1,
                'name' => 'Centro Cultural Quinta Teresa',
                'description' => 'Punto de encuentro - Emblemático centro cultural y patrimonial de la ciudad.',
                'arrival_time' => '17:00:00',
                'departure_time' => '17:15:00',
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid' => Str::uuid(),
                'city_tour_id' => 1,
                'order' => 2,
                'name' => 'Cristo Rey',
                'description' => 'Monumento religioso con vista panorámica de la ciudad.',
                'arrival_time' => '17:25:00',
                'departure_time' => '17:40:00',
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid' => Str::uuid(),
                'city_tour_id' => 1,
                'order' => 3,
                'name' => 'Biblioteca Pública Julio Pérez Ferrero',
                'description' => 'Biblioteca central de Cúcuta, referente histórico y cultural.',
                'arrival_time' => '17:50:00',
                'departure_time' => '18:05:00',
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid' => Str::uuid(),
                'city_tour_id' => 1,
                'order' => 4,
                'name' => 'Parque La Victoria',
                'description' => 'Parque histórico con monumentos conmemorativos.',
                'arrival_time' => '18:10:00',
                'departure_time' => '18:20:00',
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid' => Str::uuid(),
                'city_tour_id' => 1,
                'order' => 5,
                'name' => 'Cúpula Chata - Gobernación de Norte de Santander',
                'description' => 'Sede de la gobernación, edificio icónico de la ciudad.',
                'arrival_time' => '18:25:00',
                'departure_time' => '18:35:00',
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid' => Str::uuid(),
                'city_tour_id' => 1,
                'order' => 6,
                'name' => 'Catedral de San José',
                'description' => 'Templo principal de la diócesis de Cúcuta.',
                'arrival_time' => '18:40:00',
                'departure_time' => '18:50:00',
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid' => Str::uuid(),
                'city_tour_id' => 1,
                'order' => 7,
                'name' => 'Torre del Reloj',
                'description' => 'Icono del centro histórico de Cúcuta en el Parque Santander.',
                'arrival_time' => '18:55:00',
                'departure_time' => '19:05:00',
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid' => Str::uuid(),
                'city_tour_id' => 1,
                'order' => 8,
                'name' => 'Complejo Histórico Villa del Rosario',
                'description' => 'Lugar donde se firmó la Constitución de 1821.',
                'arrival_time' => '19:10:00',
                'departure_time' => '19:25:00',
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid' => Str::uuid(),
                'city_tour_id' => 1,
                'order' => 9,
                'name' => 'Puente Internacional Simón Bolívar',
                'description' => 'Paso fronterizo histórico entre Colombia y Venezuela.',
                'arrival_time' => '19:30:00',
                'departure_time' => '19:40:00',
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid' => Str::uuid(),
                'city_tour_id' => 1,
                'order' => 10,
                'name' => 'Puente Internacional Tienditas',
                'description' => 'Puente moderno de conexión fronteriza.',
                'arrival_time' => '19:45:00',
                'departure_time' => '19:55:00',
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid' => Str::uuid(),
                'city_tour_id' => 1,
                'order' => 11,
                'name' => 'C.C. Jardín Plaza',
                'description' => 'Centro comercial a cielo abierto - Punto final del recorrido.',
                'arrival_time' => '20:00:00',
                'departure_time' => '20:00:00',
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ];


        foreach ($cityTourStops as $cityTourStop) {
            CityTourStop::create($cityTourStop);
        }

        $this->command->info('Paradas del City Tours creados exitosamente!');
    }
}
