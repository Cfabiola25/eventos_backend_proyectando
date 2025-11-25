<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(GendersSeeder::class);
        $this->call(DocumentTypesSeeder::class);
        $this->call(UsersTypesSeeder::class);
        $this->call(PermissionsSeeder::class);
        $this->call(RolesSeeder::class);
        $this->call(ModalitySeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(AgendasSeeder::class);
        $this->call(SubscriptionPlansSeeder::class);
        $this->call(PlanPricesSeeder::class);
        $this->call(ProgramsSeeder::class);
        $this->call(TagSeeder::class);
        $this->call(LocationsSeeder::class);
        $this->call(SchedulesSeeder::class);
        $this->call(ThemesSeeder::class);
        $this->call(SpeakerSeeder::class);
        $this->call(EventsSeeder::class);
        $this->call(EventProgramSeeder::class); 
        $this->call(CategorySeeder::class); 
        $this->call(CategoryEventSeeder::class); 
        $this->call(EventThemeSeeder::class);
        $this->call(EventScheduleLocationSeeder::class);
        $this->call(EventSpeakerSeeder::class);
        $this->call(CityToursSeeder::class);
        $this->call(CityTourStopsSeeder::class);
        $this->call(CityTourPricesSeeder::class);
        $this->call(SubscriptionPlanCityTourSeeder::class);
        $this->call(EventTagSeeder::class);
        $this->call(SubscriptionPlanEventAccessSeeder::class);
        $this->call(NewsSeeder::class);
    }
}
