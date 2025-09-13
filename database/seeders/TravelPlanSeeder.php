<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TravelPlan;

class TravelPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        TravelPlan::create([
            'title' => 'Bali Relaxation Trip',
            'user_id' => 1,
            'country_id' => 101,
            'start_date' => '2025-09-20',
            'end_date' => '2025-09-25',
            'description' => 'A relaxing trip to Bali',
            'max_participants' => 5,
        ]);

        TravelPlan::create([
            'title' => 'Bangkok Adventure',
            'user_id' => 1,
            'country_id' => 102,
            'start_date' => '2025-09-28',
            'end_date' => '2025-10-03',
            'description' => 'Adventure trip to Bangkok',
            'max_participants' => 6,
        ]);

        TravelPlan::create([
            'title' => 'Kyoto & Nara Historical Tour',
            'user_id' => 2,
            'country_id' => 103,
            'start_date' => '2025-10-05',
            'end_date' => '2025-10-10',
            'description' => 'Explore temples and historical sites in Kyoto and Nara',
            'max_participants' => 8,
        ]);

        TravelPlan::create([
            'title' => 'Tokyo Food Experience',
            'user_id' => 2,
            'country_id' => 103,
            'start_date' => '2025-10-12',
            'end_date' => '2025-10-15',
            'description' => 'Taste local food and explore Tokyo\'s culinary spots',
            'max_participants' => 4,
        ]);

        TravelPlan::create([
            'title' => 'Vietnam Beach Holiday',
            'user_id' => 3,
            'country_id' => 104,
            'start_date' => '2025-10-20',
            'end_date' => '2025-10-25',
            'description' => 'Relax on the beautiful beaches of Vietnam',
            'max_participants' => 6,
        ]);
    }
}
