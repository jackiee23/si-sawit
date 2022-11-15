<?php

namespace Database\Factories;
use App\Models\Car;
use Faker\Provider\Fakecar;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Validation\Rules\Unique;

class CarFactory extends Factory
{
    protected $model = Car::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $this->faker->addProvider(new Fakecar($this->faker));
        $vehicle = $this->faker->vehicleArray();

        return [
            'nama_kendaraan' => $vehicle['model'],
            'merek' => $vehicle['brand'],
            'tgl_beli' => $this->faker->date(),
            'keadaan_beli' => $this->faker->vehicleFuelType,
            'umur_kendaraan' => $this->faker->bothify('## years')
        ];
    }
}
