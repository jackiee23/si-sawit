<?php

namespace Database\Seeders;

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
        \App\Models\Farmer::factory(20)->create();
        \App\Models\Admin::factory(10)->create();
        \App\Models\Car::factory(10)->create();
        \App\Models\Worker::factory(10)->create();
        \App\Models\Loan::factory(10)->create();
        \App\Models\Purchase::factory(10)->create();
        \App\Models\Sale::factory(10)->create();
        \App\Models\Fuel::factory(10)->create();
        \App\Models\Repair::factory(10)->create();

    }
}
