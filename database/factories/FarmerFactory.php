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
            "alamat" => $this->faker->address(),
            "no_wa" => $this->faker->phoneNumber(),
            "luas" => $this->faker->randomNumber(2,true),
            "jarak" => $this->faker->randomNumber(2,false),
            "umur" => $this->faker->randomNumber(2, false),

        ];
    }
}
