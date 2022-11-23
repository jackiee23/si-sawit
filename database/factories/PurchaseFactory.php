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
        $jumlah = $this->faker->randomNumber(3);
        $harga = $this->faker->randomNumber(4);
        $harga_total = $harga * $jumlah;

        return [
            'farmer_id'=>mt_rand(1,10),
            'tgl_beli'=> $this->faker->dateTimeThisYear(),
            'tgl_panen' => $this->faker->dateTimeThisYear(),
            'selisih' => $this->faker->bothify('Telat # Hari # Jam'),
            'jumlah_sawit'=>$jumlah,
            'harga'=>$harga,
            'harga_total' => $harga_total,
            'worker_id'=>mt_rand(1,10),
            'car_id' => mt_rand(1, 10),
            'trip' => $this->faker->randomNumber(1),
            'keterangan'=>$this->faker->sentence()
        ];
    }
}
