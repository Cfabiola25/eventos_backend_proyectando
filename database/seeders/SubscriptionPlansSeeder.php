<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SubscriptionPlan;
use Illuminate\Support\Str;
use Carbon\Carbon;  

class SubscriptionPlansSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subscriptionsPlans = [
            // ==================== FAMILIA FESC ==================== 
            [
                'uuid'        => Str::uuid(),
                'name'        => 'Plan Full PRESENCIAL - Familia FESC',
                'description' => 'Acceso a todas las conferencias presenciales del congreso (según disponibilidad de aforo). Acceso a conferencias virtuales. Entradas al Panel Inaugural, FESCtival de Cine, Desfile de Modas, Feria Cultural y Fiesta de Cierre.',
                'modality_id' => 1,
                'is_active'   => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid'        => Str::uuid(),
                'name'        => 'Plan Full VIRTUAL - Familia FESC',
                'description' => 'Acceso a todas las conferencias virtuales del congreso. Conexión online al Panel Inaugural, Desfile de Modas y Feria Cultural.',
                'modality_id' => 2,
                'is_active'   => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            // ==================== PARTICULARES (FULL) ====================
            [
                'uuid'        => Str::uuid(),
                'name'        => 'Plan Full PRESENCIAL - Particulares',
                'description' => 'Acceso a todas las conferencias presenciales del congreso (según disponibilidad de aforo). Acceso a conferencias virtuales. Entradas al Panel Inaugural, FESCtival de Cine, Desfile de Modas, Feria Cultural y Fiesta de Cierre.',
                'modality_id' => 1,
                'is_active'   => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid'        => Str::uuid(),
                'name'        => 'Plan Full VIRTUAL - Particulares',
                'description' => 'Acceso a todas las conferencias virtuales del congreso. Conexión online al Panel Inaugural, Desfile de Modas y Feria Cultural.',
                'modality_id' => 2,
                'is_active'   => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            // ==================== PARTICULARES (ESTÁNDAR / BÁSICO) ====================
            [
                'uuid'        => Str::uuid(),
                'name'        => 'Plan Estándar PRESENCIAL - Particulares',
                'description' => 'Acceso a 5 conferencias presenciales del congreso (según disponibilidad de aforo). Acceso a conferencias virtuales. Entradas al Panel Inaugural, FESCtival de Cine, Desfile de Modas, Feria Cultural y Fiesta de Cierre.',
                'modality_id' => 1,
                'is_active'   => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid'        => Str::uuid(),
                'name'        => 'Plan Básico PRESENCIAL - Particulares',
                'description' => 'Acceso a 1 conferencia presencial del congreso (según disponibilidad de aforo). Entradas al Panel Inaugural, FESCtival de Cine, Desfile de Modas, Feria Cultural y Fiesta de Cierre.',
                'modality_id' => 1,
                'is_active'   => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid'        => Str::uuid(),
                'name'        => 'Plan Básico VIRTUAL - Particulares',
                'description' => 'Acceso a 1 conferencia virtual del congreso. Conexión online al Panel Inaugural, Desfile de Modas y Feria Cultural.',
                'modality_id' => 2,
                'is_active'   => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            // ==================== PLANES NO OFICIALES (se mantienen inactivos) ====================
            [
                'uuid'        => Str::uuid(),
                'name'        => 'City Tour - Familia FESC',
                'description' => 'Recorrido turístico por sitios históricos y culturales de la frontera.',
                'modality_id' => 1,
                'is_active'   => false,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid'        => Str::uuid(),
                'name'        => 'City Tour - Particulares',
                'description' => 'Recorrido turístico por sitios históricos y culturales de la frontera.',
                'modality_id' => 1,
                'is_active'   => false,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid'        => Str::uuid(),
                'name'        => 'Plan Invitados Especiales',
                'description' => 'Acceso completo a todas las actividades del congreso, incluyendo eventos especiales y áreas VIP.',
                'modality_id' => 3,
                'is_active'   => false,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid'        => Str::uuid(),
                'name'        => 'Plan Prensa y Medios',
                'description' => 'Acceso especial para medios de comunicación con credenciales de prensa.',
                'modality_id' => 3,
                'is_active'   => false,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid'        => Str::uuid(),
                'name'        => 'Plan Expositores',
                'description' => 'Plan especial para expositores y participantes de la feria cultural y rueda de negocios.',
                'modality_id' => 1,
                'is_active'   => false,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ];

        foreach ($subscriptionsPlans as $subscriptionPlan) {
            SubscriptionPlan::create($subscriptionPlan);
        }

        $this->command->info('Planes de suscripción creados exitosamente!');
    }
}
