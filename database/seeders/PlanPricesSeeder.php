<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\PlanPrice;
use Carbon\Carbon;  


class PlanPricesSeeder extends Seeder
{
    /**
     * Run the database seeds. 
     */
    public function run(): void
    {
         $planPrices = [
              // ==================== FAMILIA FESC ====================
            [
                'uuid'                => Str::uuid(),
                'subscription_plan_id'=> 1,   // Plan Full PRESENCIAL - Familia FESC
                'user_type_id'        => 1,   // Familia FESC
                'price'               => 180000.00,
                'currency'            => 'COP',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'uuid'                => Str::uuid(),
                'subscription_plan_id'=> 2,   // Plan Full VIRTUAL - Familia FESC
                'user_type_id'        => 1,   // Familia FESC
                'price'               => 80000.00,
                'currency'            => 'COP',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            // ==================== PARTICULARES (FULL / ESTÁNDAR / BÁSICO) ====================
            [
                'uuid'                => Str::uuid(),
                'subscription_plan_id'=> 3,   // Plan Full PRESENCIAL - Particulares
                'user_type_id'        => 6,   // Particulares / Público general
                'price'               => 200000.00,
                'currency'            => 'COP',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'uuid'                => Str::uuid(),
                'subscription_plan_id'=> 4,   // Plan Full VIRTUAL - Particulares
                'user_type_id'        => 6,
                'price'               => 100000.00,
                'currency'            => 'COP',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'uuid'                => Str::uuid(),
                'subscription_plan_id'=> 5,   // Plan Estándar PRESENCIAL - Particulares
                'user_type_id'        => 6,
                'price'               => 100000.00,
                'currency'            => 'COP',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'uuid'                => Str::uuid(),
                'subscription_plan_id'=> 6,   // Plan Básico PRESENCIAL - Particulares
                'user_type_id'        => 6,
                'price'               => 50000.00,
                'currency'            => 'COP',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'uuid'                => Str::uuid(),
                'subscription_plan_id'=> 7,   // Plan Básico VIRTUAL - Particulares
                'user_type_id'        => 6,
                'price'               => 50000.00,
                'currency'            => 'COP',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        foreach ($planPrices as $planPrice) {
            PlanPrice::create($planPrice);
        }

         $this->command->info('precios creadas exitosamente!');
    }
}
