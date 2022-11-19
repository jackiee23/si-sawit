<?php

namespace Database\Seeders;

use App\Models\User;
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
        \App\Models\Farmer::factory(20000)->create();
        \App\Models\Admin::factory(10000)->create();
        \App\Models\Car::factory(10000)->create();
        \App\Models\Worker::factory(15000)->create();
        \App\Models\Loan::factory(10000)->create();
        \App\Models\Purchase::factory(10000)->create();
        \App\Models\Sale::factory(10000)->create();
        \App\Models\Fuel::factory(10000)->create();
        \App\Models\Repair::factory(10000)->create();

        User::create([
            'name' => 'Jack Ramadhan',
            'email' =>'admin@gmail.com',
            'password' => bcrypt('12345')
        ]);

    }
}
