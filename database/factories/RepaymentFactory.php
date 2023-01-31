<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RepaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'loan_id'=> mt_rand(1,10),
            'tgl'=> $this->faker->dateTimeThisYear(),
            'nilai' => $this->faker->randomNumber(6),
        ];
    }
}
