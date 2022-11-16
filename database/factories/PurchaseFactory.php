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
        $harga = $this->faker->randomNumber(6);
        $jumlah = $this->faker->randomNumber(3);

        return [
            'farmer_id'=>mt_rand(1,10),
            'tgl_beli'=> $this->faker->dateTimeThisYear(),
            'jumlah_sawit'=>$jumlah,
            'harga'=>$harga,
            'worker_id'=>mt_rand(1,10),
            'car_id' => mt_rand(1, 10),
            'trip' => $this->faker->bothify('# Kali'),
            'keterangan'=>$this->faker->sentence()
        ];
    }
}
