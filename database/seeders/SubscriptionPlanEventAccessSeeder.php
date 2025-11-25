<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Carbon\Carbon; 

class SubscriptionPlanEventAccessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subscriptionPlanEventAccess = [
            // ==================== PLAN FULL PRESENCIAL FAMILIA FESC ====================
            [
                'uuid' => Str::uuid(),
                'subscription_plan_id' => 1, // Full Presencial Familia FESC
                'category_id' => null,
                'event_id' => null,
                'mode' => 'permitir',
                'quota' => null,
                'notes' => 'Acceso completo a todas las conferencias presenciales',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid' => Str::uuid(),
                'subscription_plan_id' => 1,
                'category_id' => 2, // Workshops
                'event_id' => null,
                'mode' => 'permitir',
                'quota' => null,
                'notes' => 'Acceso a workshops presenciales sujeto a aforo',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
                    
            ],
            [
                'uuid' => 'ff0e8400-e29b-41d4-a716-446655440003',
                'subscription_plan_id' => 1,
                'category_id' => 4, // Eventos Especiales
                'event_id' => null,
                'mode' => 'permitir',
                'quota' => null,
                'notes' => 'Acceso a todos los eventos especiales',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            // ==================== PLAN FULL PRESENCIAL PARTICULARES ====================
            [
                'uuid' => Str::uuid(),
                'subscription_plan_id' => 1,
                'category_id' => 4, // Eventos Especiales
                'event_id' => null,
                'mode' => 'permitir',
                'quota' => null,
                'notes' => 'Incluye Panel Inaugural, FESCtival, Desfile, Feria, Fiesta de Cierre',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid' => Str::uuid(),
                'subscription_plan_id' => 1,
                'category_id' => null,
                'event_id' => 59, // Rueda de Negocios
                'mode' => 'permitir',
                'quota' => null,
                'notes' => 'Acceso a Rueda de Negocios',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid' => Str::uuid(),
                'subscription_plan_id' => 2,
                'category_id' => 1,
                'event_id' => null,
                'mode' => 'permitir',
                'quota' => null,
                'notes' => 'Acceso a todas las conferencias presenciales',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            // ==================== PLAN FULL VIRTUAL FAMILIA FESC ====================
            [
                'uuid' => Str::uuid(),
                'subscription_plan_id' => 2,
                'category_id' => 2,
                'event_id' => null,
                'mode' => 'permitir',
                'quota' => null,
                'notes' => 'Acceso a workshops presenciales sujeto a aforo',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid' => Str::uuid(),
                'subscription_plan_id' => 2,
                'category_id' => 4,
                'event_id' => null,
                'mode' => 'permitir',
                'quota' => null,
                'notes' => 'Incluye Panel Inaugural, FESCtival, Desfile, Feria, Fiesta de Cierre',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid' => Str::uuid(),
                'subscription_plan_id' => 2,
                'category_id' => null,
                'event_id' => 59,
                'mode' => 'permitir',
                'quota' => null,
                'notes' => 'Acceso a Rueda de Negocios',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid' => Str::uuid(),
                'subscription_plan_id' => 3,
                'category_id' => 4, // Eventos Especiales presenciales
                'event_id' => null,
                'mode' => 'denegar',
                'quota' => null,
                'notes' => 'Sin acceso a eventos especiales presenciales',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            // ==================== PLAN FULL VIRTUAL PARTICULARES ====================
            [
                'uuid' => Str::uuid(),
                'subscription_plan_id' => 3,
                'category_id' => 1, // Conferencias
                'event_id' => null,
                'mode' => 'permitir',
                'quota' => null,
                'notes' => 'Acceso a conferencias virtuales',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid' => Str::uuid(),
                'subscription_plan_id' => 3,
                'category_id' => null,
                'event_id' => 15, // Logística de Eventos (virtual)
                'mode' => 'permitir',
                'quota' => null,
                'notes' => 'Conferencia virtual incluida',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid' => Str::uuid(),
                'subscription_plan_id' => 3,
                'category_id' => null,
                'event_id' => 16, // Estrategias Comerciales (virtual)
                'mode' => 'permitir',
                'quota' => null,
                'notes' => 'Conferencia virtual incluida',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            // ==================== PLAN ESTÁNDAR PRESENCIAL ====================
            [
                'uuid' => Str::uuid(),
                'subscription_plan_id' => 4,
                'category_id' => 4, // Eventos Especiales presenciales
                'event_id' => null,
                'mode' => 'denegar',
                'quota' => null,
                'notes' => 'Sin acceso a eventos especiales presenciales',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid' => Str::uuid(),
                'subscription_plan_id' => 4,
                'category_id' => 1,
                'event_id' => null,
                'mode' => 'permitir',
                'quota' => null,
                'notes' => 'Acceso a conferencias virtuales',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid' => Str::uuid(),
                'subscription_plan_id' => 4,
                'category_id' => null,
                'event_id' => 15,
                'mode' => 'permitir',
                'quota' => null,
                'notes' => 'Conferencia virtual incluida',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            // ==================== PLAN BÁSICO PRESENCIAL ====================
            [
                'uuid' => Str::uuid(),
                'subscription_plan_id' => 4,
                'category_id' => null,
                'event_id' => 16,
                'mode' => 'permitir',
                'quota' => null,
                'notes' => 'Conferencia virtual incluida',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid' => Str::uuid(),
                'subscription_plan_id' => 5,
                'category_id' => 1, // Conferencias
                'event_id' => null,
                'mode' => 'cuota',
                'quota' => 5,
                'notes' => 'Hasta 5 conferencias presenciales',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid' => Str::uuid(),
                'subscription_plan_id' => 5,
                'category_id' => 2, // Workshops
                'event_id' => null,
                'mode' => 'cuota',
                'quota' => 1,
                'notes' => 'Hasta 1 workshop presencial',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            // ==================== PLAN BÁSICO VIRTUAL ====================
            [
                'uuid' => Str::uuid(),
                'subscription_plan_id' => 5,
                'category_id' => 4, // Eventos Especiales
                'event_id' => null,
                'mode' => 'permitir',
                'quota' => null,
                'notes' => 'Incluye Panel, FESCtival, Desfile, Feria, Fiesta de Cierre',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid' => Str::uuid(),
                'subscription_plan_id' => 6,
                'category_id' => 1, // Conferencias
                'event_id' => null,
                'mode' => 'cuota',
                'quota' => 1,
                'notes' => 'Una (1) conferencia presencial',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
                
            ],

            // ==================== PLAN PREMIUM ====================
            [
                'uuid' => Str::uuid(),
                'subscription_plan_id' => 6,
                'category_id' => 2, // Workshops
                'event_id' => null,
                'mode' => 'denegar',
                'quota' => null,
                'notes' => 'Sin acceso a workshops',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
                
            ],

            // ==================== PLAN EMPRESARIAL ====================
            [
                'uuid' => Str::uuid(),
                'subscription_plan_id' => 6,
                'category_id' => 4, // Eventos Especiales
                'event_id' => null,
                'mode' => 'permitir',
                'quota' => null,
                'notes' => 'Incluye Panel, FESCtival, Desfile, Feria, Fiesta de Cierre',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid' => Str::uuid(),
                'subscription_plan_id' => 6,
                'category_id' => null,
                'event_id' => 59, // Rueda de Negocios
                'mode' => 'denegar',
                'quota' => null,
                'notes' => 'Sin acceso a Rueda de Negocios en Básico',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            // ==================== RESTRICCIONES ESPECÍFICAS POR EVENTO ====================
            // Rueda de Negocios solo para planes completos
            [
                'uuid' => Str::uuid(),
                'subscription_plan_id' => 7,
                'category_id' => 1, // Conferencias
                'event_id' => null,
                'mode' => 'cuota',
                'quota' => 1,
                'notes' => 'Una (1) conferencia virtual',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid' => Str::uuid(),
                'subscription_plan_id' => 7,
                'category_id' => 2, // Workshops
                'event_id' => null,
                'mode' => 'denegar',
                'quota' => null,
                'notes' => 'Sin acceso a workshops virtuales',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid' => Str::uuid(),
                'subscription_plan_id' => 7,
                'category_id' => 4,
                'event_id' => null,
                'mode' => 'denegar',
                'quota' => null,
                'notes' => 'Sin acceso a eventos especiales presenciales',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ];

        foreach ($subscriptionPlanEventAccess as $planEventAccess) {
            DB::table('subscription_plan_event_access')->insert($planEventAccess);
        }

        $this->command->info('Permisos de acceso a eventos por plan creados exitosamente!');
    }
}
