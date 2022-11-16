<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class LoanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'tgl'=> $this->faker->dateTimeThisYear(),
            'nama' => $this->faker->name(),
            'jenis_pinjaman' => $this->faker->word(),
            'nilai' => $this->faker->randomNumber(6),
            'keterangan' => $this->faker->sentence()
        ];
    }
}
