<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FarmFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $array = ["Tanah Keras", "Gambut"];
        return [
            "nama_kebun" => $this->faker->numerify('Kebun-###'),
            // "alamat" => $this->faker->address(),
            "luas" => mt_rand(1, 5),
            "farmer_id" => mt_rand(1, 5),
            "jarak" => $this->faker->randomNumber(2, true),
            "umur" => mt_rand(1, 35),
            "jenis_tanah" => $array[mt_rand(0, 1)],
        ];
    }
}
