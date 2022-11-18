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
        \App\Models\Farmer::factory(20)->create();
        \App\Models\Admin::factory(10)->create();
        \App\Models\Car::factory(100)->create();
        \App\Models\Worker::factory(15)->create();
        \App\Models\Loan::factory(10)->create();
        \App\Models\Purchase::factory(10)->create();
        \App\Models\Sale::factory(10)->create();
        \App\Models\Fuel::factory(10)->create();
        \App\Models\Repair::factory(10)->create();

        User::create([
            'name' => 'Jack Ramadhan',
            'email' =>'admin@gmail.com',
            'password' => bcrypt('12345')
        ]);

    }
}
