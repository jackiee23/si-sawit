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
            'tgl_perbaikan' => $this->faker->dateTimeThisYear(),
            'car_id' => mt_rand(1, 5),
            'type_id' => mt_rand(1, 5),
            'jumlah' => $this->faker->randomNumber(5),
            'keterangan' => $this->faker->sentence()
        ];
    }
}
