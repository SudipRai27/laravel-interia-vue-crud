<?php

namespace Database\Seeders;

use App\Models\AggregateCustomer;
use App\Models\AggregateSale;
use App\Models\AggregateTraffic;
use App\Models\Department;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        Department::factory(120)->create();
        $this->call([
            AggregateSaleSeeder::class,
            AggregateCustomer::class,
            AggregateTraffic::class
        ]);
    }
}