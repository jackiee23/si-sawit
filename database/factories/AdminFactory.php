<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AdminFactory extends Factory
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
            "nik" => $this->faker->unique()->randomNumber(9, true),
            "no_wa" => $this->faker->phoneNumber(),
            "jenis" => $this->faker->jobTitle(),
        ];
    }
}
