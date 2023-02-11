<?php

namespace Database\Factories;

use App\Models\Loan;
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
        $id = mt_rand(1, 10);
        $loan = Loan::where('id', $id)->first();
        $jenis = $loan->jenis_pinjaman;
        $nik = $loan->nik;
        return [
            'loan_id'=> $id,
            'loan_nik' => $nik,
            'tgl'=> $this->faker->dateTimeThisYear(),
            'nilai' => $this->faker->randomNumber(6),
            'jenis_pinjaman' => $jenis,
        ];
    }
}
