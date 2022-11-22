<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FuelFactory extends Factory
{
    /**
     * Define the model's default state.

     *
     * @return array
     */
    public function definition()
    {
        $harga = 10000;
        $jumlah = $this->faker->randomNumber(2);
        $total = $harga * $jumlah;

        return [
            'tgl_pengisian' => $this->faker->dateTimeThisYear(),
            'car_id' => mt_rand(1,5),
            'jumlah_liter' => $jumlah,
            'harga' => $harga,
            'harga_total' => $total,
            'keterangan' => $this->faker->sentence()
        ];
    }
}
