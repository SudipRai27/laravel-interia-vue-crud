<?php

namespace Database\Seeders;

use App\Models\AggregateCustomer;
use App\Models\AggregateSale;
use Illuminate\Database\Seeder;

class AggregateCustomerSeeder extends Seeder
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
            AggregateCustomer::factory()->create(['date' => $date]);
        }
    }
}