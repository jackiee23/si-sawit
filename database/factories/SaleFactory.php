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
        $harga = $this->faker->randomNumber(3);
        $jumlah = $this->faker->randomNumber(3);
        $total = $harga * $jumlah;
        $sortasi = mt_rand(1, 10);
        $potongan = $jumlah*$sortasi/100;
        $jumlah_net = $jumlah - $potongan;

        return [
            'tgl_jual' => $this->faker->dateTimeThisYear(),
            'jumlah' => $jumlah,
            'sortasi' => $sortasi,
            'potongan' => $potongan,
            'jumlah_net' => $jumlah_net,
            'harga_pabrik' => $harga,
            'harga_total' => $total,
            'worker_id' => mt_rand(1,10),
            'car_id' => mt_rand(1, 10),
            'pabrik' => $this->faker->company(),
            'keterangan' => $this->faker->sentence()
        ];
    }
}
