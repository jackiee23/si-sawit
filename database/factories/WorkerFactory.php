<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class WorkerFactory extends Factory
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
            "nik_worker" => $this->faker->unique()->randomNumber(9, true),
            "alamat" => $this->faker->address(),
            "no_wa" => $this->faker->phoneNumber(),
            "jenis" => $this->faker->jobTitle()
        ];
    }
}
