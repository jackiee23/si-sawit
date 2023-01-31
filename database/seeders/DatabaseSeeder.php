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
        \App\Models\Farmer::factory(10)->create();
        \App\Models\Admin::factory(10)->create();
        \App\Models\Car::factory(10)->create();
        \App\Models\Worker::factory(10)->create();
        \App\Models\Loan::factory(10)->create();
        \App\Models\Purchase::factory(50)->create();
        \App\Models\Sale::factory(10)->create();
        \App\Models\Fuel::factory(30)->create();
        \App\Models\Repair::factory(10)->create();
        \App\Models\User::factory(4)->create();
        \App\Models\Type::factory(5)->create();
        \App\Models\Repayment::factory(5)->create();


        User::create([
            'nama' => 'Jack Ramadhan',
            'email' =>'admin@gmail.com',
            'no_wa' => '085161230906',
            'jenis' => 'Programmer',
            'password' => bcrypt('12345')
        ]);

        User::create([
            'nama' => 'Ramadhan',
            'email' => 'hisana@gmail.com',
            'no_wa' => '085161230906',
            'jenis' => 'Programmer',
            'password' => bcrypt('12345')
        ]);

    }
}
