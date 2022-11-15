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
        return [
            'tgl_pengisian' => $this->faker->date(),
            'car_id' => mt_rand(1,5),
            'jumlah_liter' => $this->faker->randomNumber(2),
            'harga' => $this->faker->randomNumber(4),
            'keterangan' => $this->faker->sentence()
        ];
    }
}
