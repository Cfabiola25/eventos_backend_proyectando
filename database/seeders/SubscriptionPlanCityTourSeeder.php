<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon; 

class SubscriptionPlanCityTourSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subscriptionPlanCityTours = [
             // Plan Full Presencial - Familia FESC → Incluye City Tour
            [
                'uuid'                 => Str::uuid(),
                'subscription_plan_id' => 1,   // Full PRESENCIAL - Familia FESC
                'city_tour_id'         => 1,   // Cúcuta: Destino Fronterizo e Histórico
                'included'             => false,
                'discount_percentage'  => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            // Plan Full Virtual - Familia FESC → sin incluir, con descuento opcional
            [
                'uuid'                 => Str::uuid(),
                'subscription_plan_id' => 2,   // Full VIRTUAL - Familia FESC
                'city_tour_id'         => 1,
                'included'             => false,
                'discount_percentage'  => 10.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            // Planes Particulares - Full
            [
                'uuid'                 => Str::uuid(),
                'subscription_plan_id' => 3,   // Full PRESENCIAL - Particulares
                'city_tour_id'         => 1,
                'included'             => false,
                'discount_percentage'  => 25.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid'                 => Str::uuid(),
                'subscription_plan_id' => 4,   // Full VIRTUAL - Particulares
                'city_tour_id'         => 1,
                'included'             => false,
                'discount_percentage'  => 15.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            // Planes Particulares - Estándar / Básico / Básico Virtual
            [
                'uuid'                 => Str::uuid(),
                'subscription_plan_id' => 5,   // Estándar PRESENCIAL - Particulares
                'city_tour_id'         => 1,
                'included'             => false,
                'discount_percentage'  => 15.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid'                 => Str::uuid(),
                'subscription_plan_id' => 6,   // Básico PRESENCIAL - Particulares
                'city_tour_id'         => 1,
                'included'             => false,
                'discount_percentage'  => 10.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid'                 => Str::uuid(),
                'subscription_plan_id' => 7,   // Básico VIRTUAL - Particulares
                'city_tour_id'         => 1,
                'included'             => false,
                'discount_percentage'  => 5.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'uuid'                 => Str::uuid(),
                'subscription_plan_id' => 8,  //CityTour FESC
                'city_tour_id'         => 1,
                'included'             => true,
                'discount_percentage'  => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid'                 => Str::uuid(),
                'subscription_plan_id' => 9,   //CityTour Particulares
                'city_tour_id'         => 1,
                'included'             => true,
                'discount_percentage'  => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],       
         ];

        foreach ($subscriptionPlanCityTours as $subscriptionPlanCityTour) {
            DB::table('subscription_plan_city_tour')->insert($subscriptionPlanCityTour);
        }

         $this->command->info('Subscription Plan City Tours creados exitosamente!');

    }
}
