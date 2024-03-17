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
        \App\Models\MUserType::create([
            'name' => 'User'
        ]);
        \App\Models\MUserType::create([
            'name' => 'Admin'
        ]);

        \App\Models\MEventsOrdersStatus::create([
            'events_orders_status_name' => 'Pending'
        ]);
        \App\Models\MEventsOrdersStatus::create([
            'events_orders_status_name' => 'Booked'
        ]);
        \App\Models\MEventsOrdersStatus::create([
            'events_orders_status_name' => 'Scanned'
        ]);
    }
}
