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
            // $array = ["Tanah Keras", "Gambut"];
        return [
            "nama" => $this->faker->name(),
            "nik" => $this->faker->unique()->randomNumber(9, true),
            "alamat" => $this->faker->address(),
            "no_wa" => $this->faker->phoneNumber(),
        ];
    }
}
