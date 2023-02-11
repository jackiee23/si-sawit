<?php

namespace Database\Factories;

use App\Models\Farmer;
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
        $id = mt_rand(1,10);
        $nama = Farmer::where('id', $id)->first();
        return [
            'tgl'=> $this->faker->dateTimeThisYear(),
            'nama' => $nama->nama,
            'nik' => $nama->nik,
            'bagian' => 1,
            'jenis_pinjaman' => $this->faker->word(),
            'nilai' => $this->faker->randomNumber(6),
            'keterangan' => $this->faker->sentence()
        ];
    }
}
