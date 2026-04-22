<?php

namespace Database\Factories;

use App\Models\Penerbit;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Penerbit>
 */
class PenerbitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Penerbit::class;
    public function definition(): array
    {
        return [
            'nama_penerbit' => 'Penerbit ' . $this->faker->company(),
            'kota' => $this->faker->city()
        ];
    }
}
