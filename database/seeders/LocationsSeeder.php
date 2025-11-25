<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Location;
use Carbon\Carbon;

class LocationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $locations = [
            // 1 - PANEL INAUGURAL
            [
                'uuid' => Str::uuid(),
                'name' => 'Teatro Zulima',
                'room' => 'Auditorio Principal',
                'address' => 'Calle 10 #0-45, Cúcuta, Norte de Santander',
                'image' => 'teatro-zulima.jpg',
                'reference_point' => 'Teatro principal de Cúcuta, zona centro',
                'latitude' => '7.8939',
                'longitude' => '-72.5078',
                'google_maps_link' => null,
                'country' => 'Colombia',
                'city' => 'Cúcuta',
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            // 2 - HOTEL CASABLANCA - Salón Cian
            [
                'uuid' => Str::uuid(),
                'name' => 'Hotel CasaBlanca',
                'room' => 'Salón Cian',
                'address' => 'Av. Libertadores #15-23, Cúcuta, Norte de Santander',
                'image' => 'hotel-casablanca-cian.jpg',
                'reference_point' => 'Primer piso, ala derecha',
                'latitude' => '7.8952',
                'longitude' => '-72.5092',
                'google_maps_link' => null,
                'country' => 'Colombia',
                'city' => 'Cúcuta',
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            // 3 - HOTEL CASABLANCA - Salón Rubí
            [
                'uuid' => Str::uuid(),
                'name' => 'Hotel CasaBlanca',
                'room' => 'Salón Rubí',
                'address' => 'Av. Libertadores #15-23, Cúcuta, Norte de Santander',
                'image' => 'hotel-casablanca-rubi.jpg',
                'reference_point' => 'Primer piso, ala izquierda',
                'latitude' => '7.8953',
                'longitude' => '-72.5093',
                'google_maps_link' => null,
                'country' => 'Colombia',
                'city' => 'Cúcuta',
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            // 4 - HOTEL CASABLANCA - Salón Terracota
            [
                'uuid' => Str::uuid(),
                'name' => 'Hotel CasaBlanca',
                'room' => 'Salón Terracota',
                'address' => 'Av. Libertadores #15-23, Cúcuta, Norte de Santander',
                'image' => 'hotel-casablanca-terracota.jpg',
                'reference_point' => 'Segundo piso, salón principal',
                'latitude' => '7.8954',
                'longitude' => '-72.5094',
                'google_maps_link' => null,
                'country' => 'Colombia',
                'city' => 'Cúcuta',
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            // 5 - HOTEL CASABLANCA - Salón Coral
            [
                'uuid' => Str::uuid(),
                'name' => 'Hotel CasaBlanca',
                'room' => 'Salón Coral',
                'address' => 'Av. Libertadores #15-23, Cúcuta, Norte de Santander',
                'image' => 'hotel-casablanca-coral.jpg',
                'reference_point' => 'Segundo piso, ala norte',
                'latitude' => '7.8955',
                'longitude' => '-72.5095',
                'google_maps_link' => null,
                'country' => 'Colombia',
                'city' => 'Cúcuta',
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            // 6 - FESC - Auditorio 5ta Avenida
            [
                'uuid' => Str::uuid(),
                'name' => 'FESC',
                'room' => 'Auditorio 5ta Avenida',
                'address' => 'Avenida 5ta #14-34, Cúcuta, Norte de Santander',
                'image' => 'fesc-auditorio-5ta.jpg',
                'reference_point' => 'Edificio principal, primer piso',
                'latitude' => '7.8946',
                'longitude' => '-72.5086',
                'google_maps_link' => null,
                'country' => 'Colombia',
                'city' => 'Cúcuta',
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            // 7 - FESC - Aula C301
            [
                'uuid' => Str::uuid(),
                'name' => 'FESC',
                'room' => 'Aula C301',
                'address' => 'Avenida 5ta #14-34, Cúcuta, Norte de Santander',
                'image' => 'fesc-aula-c301.jpg',
                'reference_point' => 'Edificio C, tercer piso',
                'latitude' => '7.8947',
                'longitude' => '-72.5087',
                'google_maps_link' => null,
                'country' => 'Colombia',
                'city' => 'Cúcuta',
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            // 8 - FESC - Aula C401
            [
                'uuid' => Str::uuid(),
                'name' => 'FESC',
                'room' => 'Aula C401',
                'address' => 'Avenida 5ta #14-34, Cúcuta, Norte de Santander',
                'image' => 'fesc-aula-c401.jpg',
                'reference_point' => 'Edificio C, cuarto piso',
                'latitude' => '7.8948',
                'longitude' => '-72.5088',
                'google_maps_link' => null,
                'country' => 'Colombia',
                'city' => 'Cúcuta',
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            // 9 - FESC - Aula A104
            [
                'uuid' => Str::uuid(),
                'name' => 'FESC',
                'room' => 'Aula A104',
                'address' => 'Avenida 5ta #14-34, Cúcuta, Norte de Santander',
                'image' => 'fesc-aula-a104.jpg',
                'reference_point' => 'Edificio A, primer piso',
                'latitude' => '7.8949',
                'longitude' => '-72.5089',
                'google_maps_link' => null,
                'country' => 'Colombia',
                'city' => 'Cúcuta',
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            // 10 - CENTRO CULTURAL QUINTA TERESA
            [
                'uuid' => Str::uuid(),
                'name' => 'Centro Cultural Quinta Teresa',
                'room' => 'Sala de Proyección',
                'address' => 'Av 4 entre Calle 15 y 16, Cúcuta, Norte de Santander',
                'image' => 'quinta-teresa.jpg',
                'reference_point' => 'Centro cultural, zona norte de Cúcuta',
                'latitude' => '7.8960',
                'longitude' => '-72.5100',
                'google_maps_link' => null,
                'country' => 'Colombia',
                'city' => 'Cúcuta',
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            // 11 - ECOPARQUE COMFANORTE
            [
                'uuid' => Str::uuid(),
                'name' => 'Ecoparque Comfanorte',
                'room' => 'Área de Eventos',
                'address' => 'Kilómetro 2 vía a San Cayetano, Cúcuta, Norte de Santander',
                'image' => 'ecoparque-comfanorte.jpg',
                'reference_point' => 'Parque recreacional y de eventos',
                'latitude' => '7.8970',
                'longitude' => '-72.5110',
                'google_maps_link' => null,
                'country' => 'Colombia',
                'city' => 'Cúcuta',
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            // 12 - CENTRO COMERCIAL JARDÍN PLAZA
            [
                'uuid' => Str::uuid(),
                'name' => 'C.C. Jardín Plaza',
                'room' => 'Plaza Central',
                'address' => 'Av. Los Libertadores #12-34, Cúcuta, Norte de Santander',
                'image' => 'jardin-plaza.jpg',
                'reference_point' => 'Centro comercial, área de eventos central',
                'latitude' => '7.8980',
                'longitude' => '-72.5120',
                'google_maps_link' => null,
                'country' => 'Colombia',
                'city' => 'Cúcuta',
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            // 13 - VIRTUAL
            [
                'uuid' => Str::uuid(),
                'name' => 'Virtual',
                'room' => 'Plataforma Online',
                'address' => 'Acceso remoto por internet',
                'image' => 'virtual.jpg',
                'reference_point' => 'Transmisión en línea',
                'latitude' => null,
                'longitude' => null,
                'google_maps_link' => null,
                'country' => null,
                'city' => null,
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            // 14 - CITY TOUR
            [
                'uuid' => Str::uuid(),
                'name' => 'City Tour Cúcuta',
                'room' => 'Ruta Histórica y Cultural',
                'address' => 'Puntos emblemáticos de Cúcuta y Villa del Rosario',
                'image' => 'city-tour-cucuta.jpg',
                'reference_point' => 'Punto de encuentro: Centro Cultural Quinta Teresa',
                'latitude' => '7.8960',
                'longitude' => '-72.5100',
                'google_maps_link' => null,
                'country' => 'Colombia',
                'city' => 'Cúcuta',
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        foreach ($locations as $location) {
            Location::create($location);
        }

        $this->command->info('Ubicaciones creadas exitosamente!');
    }
}
