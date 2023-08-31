<?php

namespace Database\Factories;

use App\Models\Farm;
use Faker\Provider\Fakecar;
use Illuminate\Database\Eloquent\Factories\Factory;

class PurchaseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $jumlah = $this->faker->randomNumber(4);
        $harga = $this->faker->randomNumber(4);
        $harga_total = $harga * $jumlah;
        $farmer  = mt_rand(1, 10);
        $hektar = Farm::where('id', $farmer)
            ->first();

        return [
            'farm_id'=>$farmer,
            'tgl_beli'=> $this->faker->dateTimeThisYear(),
            'tgl_panen' => $this->faker->dateTimeThisYear(),
            'selisih' => $this->faker->bothify('Telat # Hari # Jam'),
            'jumlah_sawit'=>$jumlah,
            'ton' => number_format(($jumlah / $hektar->luas) / 1000,2),
            'harga'=>$harga,
            'harga_total' => $harga_total,
            'worker_id'=>mt_rand(1,10),
            // 'worker_id2' => mt_rand(1, 10),
            'car_id' => mt_rand(1, 10),
            // 'car_id2' => mt_rand(1, 10),
            'trip' => mt_rand(1, 3),
            'keterangan'=>$this->faker->sentence()
        ];
    }
}
