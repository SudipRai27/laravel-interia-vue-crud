<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Department;
use App\Models\AggregateSale;
use Illuminate\Database\Seeder;
use App\Models\AggregateTraffic;
use App\Models\AggregateCustomer;
use Database\Factories\PostFactory;

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
        Blog::factory(100)->create();
        Department::factory(120)->create();
        $this->call([
            AggregateSaleSeeder::class,
            AggregateCustomer::class,
            AggregateTraffic::class
        ]);
    }
}