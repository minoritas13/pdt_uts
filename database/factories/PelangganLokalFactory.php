<?php

namespace Database\Factories;

use App\Models\PelangganLokal;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<PelangganLokal>
 */
class PelangganLokalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = PelangganLokal::class;
    public function definition(): array
    {
        return [
            'nama' => $this->faker->name(),
            'no_telp' => $this->faker->unique()->phoneNumber(),
            'poin' => $this->faker->numberBetween(0, 1000)
        ];
    }
}
