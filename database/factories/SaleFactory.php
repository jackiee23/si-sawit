<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SaleFactory extends Factory
{
    /**
     * Define the model's default state.
     * @return array
     */
    public function definition()
    {
        return [
            'tgl_jual' => $this->faker->date(),
            'jumlah' => $this->faker->randomNumber(3),
            'harga_pabrik' => $this->faker->randomNumber(3),
            'worker_id' => mt_rand(1,10),
            'keterangan' => $this->faker->sentence()
        ];
    }
}
