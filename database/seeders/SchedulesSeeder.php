<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Schedule;
use Carbon\Carbon;


class SchedulesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $schedules = [
           // ======================================================
            // LUNES 20 DE OCTUBRE - PANEL INAUGURAL
            // ======================================================
            [
                'uuid'       => Str::uuid(), // ID 1
                'start_date' => '2025-10-20',
                'end_date'   => '2025-10-20',
                'start_time' => '18:00:00', // 06:00 p.m. según documento
                'end_time'   => '20:00:00',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            // ======================================================
            // MARTES 21 DE OCTUBRE
            // ======================================================
            // MAÑANA - CONFERENCIAS (08:00 a 12:00 según agenda)
            [
                'uuid'       => Str::uuid(), // ID 2 - 08:00-09:00
                'start_date' => '2025-10-21',
                'end_date'   => '2025-10-21',
                'start_time' => '08:00:00',
                'end_time'   => '09:00:00',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid'       => Str::uuid(), // ID 3 - 09:00-09:30 (BREAK)
                'start_date' => '2025-10-21',
                'end_date'   => '2025-10-21',
                'start_time' => '09:00:00',
                'end_time'   => '09:30:00',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid'       => Str::uuid(), // ID 4 - 09:30-10:30
                'start_date' => '2025-10-21',
                'end_date'   => '2025-10-21',
                'start_time' => '09:30:00',
                'end_time'   => '10:30:00',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid'       => Str::uuid(), // ID 5 - 10:30-11:30
                'start_date' => '2025-10-21',
                'end_date'   => '2025-10-21',
                'start_time' => '10:30:00',
                'end_time'   => '11:30:00',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            // FESCtival DE CINE - MAÑANA (08:00 a 12:00 según documento)
            [
                'uuid'       => Str::uuid(), // ID 6
                'start_date' => '2025-10-21',
                'end_date'   => '2025-10-21',
                'start_time' => '08:00:00',
                'end_time'   => '12:00:00',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            // TARDE - WORKSHOPS (14:00 a 18:00 según documento)
            [
                'uuid'       => Str::uuid(), // ID 7
                'start_date' => '2025-10-21',
                'end_date'   => '2025-10-21',
                'start_time' => '14:00:00',
                'end_time'   => '18:00:00',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            // CONFERENCIAS TARDE (17:00 a 18:00 según documento - Automatización y Rentabilidad)
            [
                'uuid'       => Str::uuid(), // ID 8
                'start_date' => '2025-10-21',
                'end_date'   => '2025-10-21',
                'start_time' => '17:00:00',
                'end_time'   => '18:00:00',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            // VIRTUALES (horario flexible)
            [
                'uuid'       => Str::uuid(), // ID 9
                'start_date' => '2025-10-21',
                'end_date'   => '2025-10-21',
                'start_time' => '19:00:00',
                'end_time'   => '20:00:00',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            // GALA INAUGURAL FESCtival (19:00 a 21:00 según documento)
            [
                'uuid'       => Str::uuid(), // ID 10
                'start_date' => '2025-10-21',
                'end_date'   => '2025-10-21',
                'start_time' => '19:00:00',
                'end_time'   => '21:00:00',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            // ======================================================
            // MIÉRCOLES 22 DE OCTUBRE
            // ======================================================
            // MAÑANA - CONFERENCIAS (08:00 a 12:00 según agenda)
            [
                'uuid'       => Str::uuid(), // ID 11 - 08:00-09:00
                'start_date' => '2025-10-22',
                'end_date'   => '2025-10-22',
                'start_time' => '08:00:00',
                'end_time'   => '09:00:00',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid'       => Str::uuid(), // ID 12 - 09:00-09:30 (BREAK)
                'start_date' => '2025-10-22',
                'end_date'   => '2025-10-22',
                'start_time' => '09:00:00',
                'end_time'   => '09:30:00',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid'       => Str::uuid(), // ID 13 - 09:30-10:30
                'start_date' => '2025-10-22',
                'end_date'   => '2025-10-22',
                'start_time' => '09:30:00',
                'end_time'   => '10:30:00',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid'       => Str::uuid(), // ID 14 - 10:30-11:30
                'start_date' => '2025-10-22',
                'end_date'   => '2025-10-22',
                'start_time' => '10:30:00',
                'end_time'   => '11:30:00',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            // FESCtival DE CINE - MAÑANA (08:00 a 12:00 según documento)
            [
                'uuid'       => Str::uuid(), // ID 15
                'start_date' => '2025-10-22',
                'end_date'   => '2025-10-22',
                'start_time' => '08:00:00',
                'end_time'   => '12:00:00',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            // TARDE - WORKSHOPS (14:00 a 18:00 según documento)
            [
                'uuid'       => Str::uuid(), // ID 16
                'start_date' => '2025-10-22',
                'end_date'   => '2025-10-22',
                'start_time' => '14:00:00',
                'end_time'   => '18:00:00',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            // CONFERENCIAS TARDE (17:00 a 18:00 según documento)
            [
                'uuid'       => Str::uuid(), // ID 17
                'start_date' => '2025-10-22',
                'end_date'   => '2025-10-22',
                'start_time' => '17:00:00',
                'end_time'   => '18:00:00',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            // CONFERENCIA NOCTURNA (20:00-20:30 - Branding Experiencial)
            [
                'uuid'       => Str::uuid(), // ID 18
                'start_date' => '2025-10-22',
                'end_date'   => '2025-10-22',
                'start_time' => '20:00:00',
                'end_time'   => '20:30:00',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            // VIRTUALES (horario flexible)
            [
                'uuid'       => Str::uuid(), // ID 19
                'start_date' => '2025-10-22',
                'end_date'   => '2025-10-22',
                'start_time' => '19:00:00',
                'end_time'   => '20:00:00',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            // ======================================================
            // JUEVES 23 DE OCTUBRE
            // ======================================================
            // MAÑANA - CONFERENCIAS (08:00 a 12:00 según agenda)
            [
                'uuid'       => Str::uuid(), // ID 20 - 08:00-09:00
                'start_date' => '2025-10-23',
                'end_date'   => '2025-10-23',
                'start_time' => '08:00:00',
                'end_time'   => '09:00:00',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid'       => Str::uuid(), // ID 21 - 09:00-09:30 (BREAK)
                'start_date' => '2025-10-23',
                'end_date'   => '2025-10-23',
                'start_time' => '09:00:00',
                'end_time'   => '09:30:00',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid'       => Str::uuid(), // ID 22 - 09:30-10:30
                'start_date' => '2025-10-23',
                'end_date'   => '2025-10-23',
                'start_time' => '09:30:00',
                'end_time'   => '10:30:00',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uuid'       => Str::uuid(), // ID 23 - 10:30-11:30
                'start_date' => '2025-10-23',
                'end_date'   => '2025-10-23',
                'start_time' => '10:30:00',
                'end_time'   => '11:30:00',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            // FESCtival DE CINE - MAÑANA (08:00 a 12:00 según documento)
            [
                'uuid'       => Str::uuid(), // ID 24
                'start_date' => '2025-10-23',
                'end_date'   => '2025-10-23',
                'start_time' => '08:00:00',
                'end_time'   => '12:00:00',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            // TARDE - WORKSHOPS (14:00 a 18:00 según documento)
            [
                'uuid'       => Str::uuid(), // ID 25
                'start_date' => '2025-10-23',
                'end_date'   => '2025-10-23',
                'start_time' => '14:00:00',
                'end_time'   => '18:00:00',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            // CONFERENCIAS TARDE (17:00 a 18:00 según documento)
            [
                'uuid'       => Str::uuid(), // ID 26
                'start_date' => '2025-10-23',
                'end_date'   => '2025-10-23',
                'start_time' => '17:00:00',
                'end_time'   => '18:00:00',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            // CITY TOUR (17:00 a 19:00 según documento)
            [
                'uuid'       => Str::uuid(), // ID 27
                'start_date' => '2025-10-23',
                'end_date'   => '2025-10-23',
                'start_time' => '17:00:00',
                'end_time'   => '19:00:00',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            // DESFILE DE MODAS (20:00 a 23:00 según documento)
            [
                'uuid'       => Str::uuid(), // ID 28
                'start_date' => '2025-10-23',
                'end_date'   => '2025-10-23',
                'start_time' => '20:00:00',
                'end_time'   => '23:00:00',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            // VIRTUALES (horario flexible)
            [
                'uuid'       => Str::uuid(), // ID 29
                'start_date' => '2025-10-23',
                'end_date'   => '2025-10-23',
                'start_time' => '19:00:00',
                'end_time'   => '20:00:00',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            // ======================================================
            // VIERNES 24 DE OCTUBRE
            // ======================================================
            // RUEDA DE NEGOCIOS (08:00 a 12:00 según documento)
            [
                'uuid'       => Str::uuid(), // ID 30
                'start_date' => '2025-10-24',
                'end_date'   => '2025-10-24',
                'start_time' => '08:00:00',
                'end_time'   => '12:00:00',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            // FERIA CULTURAL (08:00 a 18:00 según documento)
            [
                'uuid'       => Str::uuid(), // ID 31
                'start_date' => '2025-10-24',
                'end_date'   => '2025-10-24',
                'start_time' => '08:00:00',
                'end_time'   => '18:00:00',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            // FIESTA DE CIERRE (20:00 a 23:00 según documento)
            [
                'uuid'       => Str::uuid(), // ID 32
                'start_date' => '2025-10-24',
                'end_date'   => '2025-10-24',
                'start_time' => '20:00:00',
                'end_time'   => '23:00:00',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ];

        foreach ($schedules as $schedule) {
            Schedule::create($schedule);
        }

        $this->command->info('Horarios creados exitosamente!');
    }
}
