<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FarmerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "nama" => $this->faker->name(),
            "nik_farmer" => $this->faker->unique()->randomNumber(9, true),
            "alamat" => $this->faker->address(),
            "no_wa" => $this->faker->phoneNumber(),
            "luas" => mt_rand(1,5),
            "jarak" => $this->faker->randomNumber(2,true),
            "umur" => mt_rand(1,35),
        ];
    }
}
