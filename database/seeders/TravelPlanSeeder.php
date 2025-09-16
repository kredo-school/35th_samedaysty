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
        // バリ旅行プラン - 複数日程
        TravelPlan::create([
            'title' => 'Bali Relaxation Trip - 1st Week',
            'user_id' => 1,
            'country_id' => 101,
            'start_date' => '2025-09-20',
            'end_date' => '2025-09-25',
            'description' => 'A relaxing trip to Bali - First week',
            'max_participants' => 5,
        ]);

        TravelPlan::create([
            'title' => 'Bali Relaxation Trip - 2nd Week',
            'user_id' => 1,
            'country_id' => 101,
            'start_date' => '2025-09-27',
            'end_date' => '2025-10-02',
            'description' => 'A relaxing trip to Bali - Second week',
            'max_participants' => 5,
        ]);

        TravelPlan::create([
            'title' => 'Bali Relaxation Trip - 3rd Week',
            'user_id' => 1,
            'country_id' => 101,
            'start_date' => '2025-10-04',
            'end_date' => '2025-10-09',
            'description' => 'A relaxing trip to Bali - Third week',
            'max_participants' => 5,
        ]);

        // バンコクアドベンチャー - 複数日程
        TravelPlan::create([
            'title' => 'Bangkok Adventure - Weekend 1',
            'user_id' => 1,
            'country_id' => 102,
            'start_date' => '2025-09-28',
            'end_date' => '2025-10-03',
            'description' => 'Adventure trip to Bangkok - First weekend',
            'max_participants' => 6,
        ]);

        TravelPlan::create([
            'title' => 'Bangkok Adventure - Weekend 2',
            'user_id' => 1,
            'country_id' => 102,
            'start_date' => '2025-10-11',
            'end_date' => '2025-10-16',
            'description' => 'Adventure trip to Bangkok - Second weekend',
            'max_participants' => 6,
        ]);

        // 京都・奈良歴史ツアー - 複数日程
        TravelPlan::create([
            'title' => 'Kyoto & Nara Historical Tour - Spring',
            'user_id' => 2,
            'country_id' => 103,
            'start_date' => '2025-10-05',
            'end_date' => '2025-10-10',
            'description' => 'Explore temples and historical sites in Kyoto and Nara - Spring season',
            'max_participants' => 8,
        ]);

        TravelPlan::create([
            'title' => 'Kyoto & Nara Historical Tour - Autumn',
            'user_id' => 2,
            'country_id' => 103,
            'start_date' => '2025-11-15',
            'end_date' => '2025-11-20',
            'description' => 'Explore temples and historical sites in Kyoto and Nara - Autumn season',
            'max_participants' => 8,
        ]);

        // 東京フード体験 - 複数日程
        TravelPlan::create([
            'title' => 'Tokyo Food Experience - Ramen Tour',
            'user_id' => 2,
            'country_id' => 103,
            'start_date' => '2025-10-12',
            'end_date' => '2025-10-15',
            'description' => 'Taste local ramen and explore Tokyo\'s culinary spots',
            'max_participants' => 4,
        ]);

        TravelPlan::create([
            'title' => 'Tokyo Food Experience - Sushi Tour',
            'user_id' => 2,
            'country_id' => 103,
            'start_date' => '2025-10-19',
            'end_date' => '2025-10-22',
            'description' => 'Taste authentic sushi and explore Tokyo\'s sushi spots',
            'max_participants' => 4,
        ]);

        TravelPlan::create([
            'title' => 'Tokyo Food Experience - Street Food Tour',
            'user_id' => 2,
            'country_id' => 103,
            'start_date' => '2025-10-26',
            'end_date' => '2025-10-29',
            'description' => 'Explore Tokyo\'s street food culture and local markets',
            'max_participants' => 4,
        ]);

        // ベトナムビーチホリデー - 複数日程
        TravelPlan::create([
            'title' => 'Vietnam Beach Holiday - Da Nang',
            'user_id' => 4,
            'country_id' => 104,
            'start_date' => '2025-10-20',
            'end_date' => '2025-10-25',
            'description' => 'Relax on the beautiful beaches of Da Nang, Vietnam',
            'max_participants' => 6,
        ]);

        TravelPlan::create([
            'title' => 'Vietnam Beach Holiday - Phu Quoc',
            'user_id' => 4,
            'country_id' => 104,
            'start_date' => '2025-11-01',
            'end_date' => '2025-11-06',
            'description' => 'Relax on the beautiful beaches of Phu Quoc Island, Vietnam',
            'max_participants' => 6,
        ]);

        TravelPlan::create([
            'title' => 'Vietnam Beach Holiday - Nha Trang',
            'user_id' => 4,
            'country_id' => 104,
            'start_date' => '2025-11-15',
            'end_date' => '2025-11-20',
            'description' => 'Relax on the beautiful beaches of Nha Trang, Vietnam',
            'max_participants' => 6,
        ]);

        // 追加の旅行プラン - 複数日程
        TravelPlan::create([
            'title' => 'European Grand Tour - Paris',
            'user_id' => 4,
            'country_id' => 105,
            'start_date' => '2025-12-01',
            'end_date' => '2025-12-06',
            'description' => 'Explore the romantic city of Paris',
            'max_participants' => 4,
        ]);

        TravelPlan::create([
            'title' => 'European Grand Tour - Rome',
            'user_id' => 4,
            'country_id' => 106,
            'start_date' => '2025-12-08',
            'end_date' => '2025-12-13',
            'description' => 'Discover the ancient history of Rome',
            'max_participants' => 4,
        ]);

        TravelPlan::create([
            'title' => 'European Grand Tour - Barcelona',
            'user_id' => 4,
            'country_id' => 107,
            'start_date' => '2025-12-15',
            'end_date' => '2025-12-20',
            'description' => 'Experience the vibrant culture of Barcelona',
            'max_participants' => 4,
        ]);
    }
}
