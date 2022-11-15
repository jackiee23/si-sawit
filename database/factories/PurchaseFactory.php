<?php

namespace Database\Factories;

use Faker\Provider\Fakecar;
use Illuminate\Database\Eloquent\Factories\Factory;

class PurchaseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'farmer_id'=>mt_rand(1,10),
            'tgl_beli'=>$this->faker->date(),
            'jumlah_sawit'=>$this->faker->randomNumber(3),
            'harga'=>$this->faker->randomNumber(6),
            'worker_id'=>mt_rand(1,5),
            'keterangan'=>$this->faker->sentence()
        ];
    }
}
