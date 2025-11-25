<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Carbon\Carbon; 

class CityTourPricesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $cityTourPrices = [
             // ==================== CITY TOUR: Cúcuta – Destino Fronterizo e Histórico ====================
            [
                'uuid'         => Str::uuid(),
                'city_tour_id' => 1, // ID del City Tour creado en CityToursSeeder
                'user_type_id' => 1, // Familia FESC
                'price'        => 30000.00,
                'currency'     => 'COP',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'uuid'         => Str::uuid(),
                'city_tour_id' => 1,
                'user_type_id' => 2, // Particulares
                'price'        => 50000.00,
                'currency'     => 'COP',
                'created_at' => now(),
                'updated_at' => now()
            ],
        
        ];

        foreach ($cityTourPrices as $price) {
            DB::table('city_tour_prices')->insert($price);
        }

        $this->command->info('City Tour Prices creados exitosamente!');
    }
}
