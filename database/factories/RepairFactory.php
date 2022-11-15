<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RepairFactory extends Factory
{
    /**
     * Define the model's default state.

     *
     * @return array
     */
    public function definition()
    {
        return [
            'tgl_perbaikan' => $this->faker->date(),
            'car_id' => mt_rand(1, 5),
            'jenis_kerusakan' => $this->faker->sentence(3),
            'jumlah' => $this->faker->randomNumber(5),
            'keterangan' => $this->faker->sentence()
        ];
    }
}
