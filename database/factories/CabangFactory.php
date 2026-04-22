<?php

namespace Database\Factories;

use App\Models\Cabang;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Cabang>
 */
class CabangFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Cabang::class;
    public function definition(): array
    {
        return [
            'kode_cabang' => 'CBG-' . $this->faker->unique()->numberBetween(10, 99),
            'nama_cabang' => 'Gramedia ' . $this->faker->city(),
            'lokasi' => $this->faker->address()
        ];
    }
}
