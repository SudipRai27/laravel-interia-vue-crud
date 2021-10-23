<?php

namespace Database\Seeders;

use App\Models\AggregateTraffic;
use Illuminate\Database\Seeder;

class AggregateTrafficSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $startDate = now();

        for ($i = 0; $i < 30; $i++) {
            $date = $startDate->subDay()->format('Y-m-d');
            AggregateTraffic::factory()->create(['date' => $date]);
        }
    }
}