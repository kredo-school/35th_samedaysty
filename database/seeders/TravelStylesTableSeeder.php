<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TravelStylesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('travel_styles')->insert([
            ['id' => 3, 'Hiking,Diving,Surfing' => 'Adventure style'],
            ['id' => 4, 'Temple,Castles,Museums' => 'Culture style'],
            ['id' => 6, 'Hot springs,Spas,Beach resorts' => 'Relaxation style'],
            ['id' => 8, 'Local cuisine & Michelin restaurants' => 'Foodie style'],
            ['id' => 9, 'World heritage,Parks,Scenic drives' => 'Nature style'],
            ['id' => 10, 'High-end resorts & villas' => 'Luxury style'],
            ['id' => 11, 'Cities,Outlets,Duty-free' => 'Shopping style'],
            ['id' => 12, 'Anime & Idol pilgrimage' => 'Fun-travel style'],
            ['id' => 13, 'Forming & Countryside stays' => 'Rural style'],
            ['id' => 14, 'Guesthouses,Capsule hotels' => 'Budget style'],
            ['id' => 15, 'Eco-friendly & local support' => 'Sustainable style'],
            ['id' => 16, 'Work & travel combined' => 'Workation style'],
            ['id' => 17, 'Go with the flow' => 'Spontaneous style'],
            ['id' => 18, 'Any journey you like' => 'Travel style'],
            ['id' => 19, 'Beautiful drives & views' => 'Scenic style']
        ]);
        
    }
}
